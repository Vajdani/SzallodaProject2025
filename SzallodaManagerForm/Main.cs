using SzallodaManagerForm.Models;
using SzallodaManagerForm.ItemPanels;

namespace SzallodaManagerForm
{
    partial class Main : Form
    {

        Panel Header;

        public static OptionPanel current;
        OptionPanel<EmployeePanel> alkalmazottak;
        OptionPanel<RoomPanel> szobak;
        OptionPanel<ServicePanel> szolgaltatasok;
        OptionPanel<BookingPanel> foglalalsok;
        OptionPanel<MonthStatisticPanel> statisztika;

        public static Main Instance;

        public Main()
        {
            InitializeComponent();

            Instance = this;
            this.Resize += OnSizeChange;

            szobak = new(["Szoba", "Állapot", "Ár"]);
            szolgaltatasok = new(["Név", "Állapot"]);
            alkalmazottak = new(["Felhasználó név", "Rank"]);
            foglalalsok = new(["Kezdés dátuma", "Zárás dátuma", "Ár", "Állapot"]);

            Controls.Add(foglalalsok);
            Controls.Add(szobak);
            Controls.Add(szolgaltatasok);
            Controls.Add(alkalmazottak);

            current = (dynamic)szobak;
        }

        private void Main_Load(object sender, EventArgs e)
        {
            if (User.ActiveUser == null)
            {
                MessageBox.Show("Nincs bejelentkezett felhasználó, kérem jelentkezzen be!", "Hiba!", MessageBoxButtons.OK, MessageBoxIcon.Error);
                Close();
                return;
            }

            lbFelhasznalo.Text = User.ActiveUser.username;

            foreach (Hotel hotel in Hotel.userHotels)
            {
                cbHotelek.Items.Add(hotel.Name);
            }

            cbHotelek.SelectedIndex = 0;

            Header = panel1;
            foreach(Control c in Header.Controls)
            {
                if(c != lbFelhasznalo) c.Anchor = AnchorStyles.Top | AnchorStyles.Right;
            }

            statisztika = new(["Hónap", "Foglalások", "Bevétel"]);
            Controls.Add(statisztika);
        }

        private void Main_Closed(object sender, FormClosedEventArgs e)
        {
            Login.OnUserLogout();
        }

        private void OnHotelSelected(object sender, EventArgs e)
        {
            Hotel? hotel = Hotel.GetHotelByName(cbHotelek.SelectedItem!.ToString()!);
            if (hotel == null) { return; }

            cbModositas.Items.Clear();
            cbModositas.Items.Add("Szobák");
            cbModositas.Items.Add("Szolgáltatások");
            cbModositas.Items.Add("Foglalások");

            int level = (int)User.GetHotelAuthorityLevel(hotel.hotel_id);
            if (level >= 1) //Manager vagy Owner
            {
                cbModositas.Items.Add("Statisztika");
                cbModositas.Items.Add("Alkalmazottak");
            }

            cbModositas.SelectedIndex = 0;
        }

        private void OptionPanelSelected(object sender, EventArgs e)
        {
            current.Visible = false;

            switch (cbModositas.Text)
            {
                case "Alkalmazottak":
                    current = (dynamic)alkalmazottak;
                    break;
                case "Szobák":
                    current = (dynamic)szobak;
                    break;
                case "Szolgáltatások":
                    current = (dynamic)szolgaltatasok;
                    break;
                case "Foglalások":
                    current = (dynamic)foglalalsok;
                    break;
                case "Statisztika":
                    current = (dynamic)statisztika;
                    break;

            }

            current.UpdatePanel(GetSelectedHotel());
        }

        public Hotel GetSelectedHotel()
        {
            return Hotel.GetHotelByName(cbHotelek.SelectedItem!.ToString()!)!;
        }

        public int GetSelectedHotelId()
        {
            return GetSelectedHotel().hotel_id;
        }

        public void OnSizeChange(object? sender, EventArgs e)
        {
            if(this.Size.Width > 700)
            {
                current.ResizePanel();
                ResizeHeader();
            }
        }

        public void ResizeHeader()
        {
            Header.Size = new Size(this.ClientSize.Width, Header.Size.Height);
        }
    }
}
