using SzallodaManagerForm.Models;

namespace SzallodaManagerForm
{
    public partial class Main : Form
    {
        OptionPanel current;
        OptionPanel alkalmazottak;
        OptionPanel szobak;
        OptionPanel szolgaltatasok;

        public static Main Instance { get; private set; }

        public Main()
        {
            Instance = this;

            InitializeComponent();
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
        }

        private void Main_Closed(object sender, FormClosedEventArgs e)
        {
            Login.OnUserLogout();
        }

        private void OnHotelSelected(object sender, EventArgs e)
        {
            Hotel? hotel = Hotel.GetHotelByName(cbHotelek.SelectedItem!.ToString()!);
            if (hotel == null) { return; }

            alkalmazottak?.Dispose();
            szobak?.Dispose();
            szolgaltatasok?.Dispose();


            szobak = new(this.Size, OptionPanel.ItemPanelCategory.Rooms);
            szolgaltatasok = new(this.Size, OptionPanel.ItemPanelCategory.Services);

            szolgaltatasok.BackColor = Color.RebeccaPurple;

            this.Controls.Add(szobak);
            this.Controls.Add(szolgaltatasok);

            cbModositas.Items.Clear();
            cbModositas.Items.Add("Szobák");
            cbModositas.Items.Add("Szolgáltatások");

            int level = (int)User.GetHotelAuthorityLevel(hotel.hotel_id);
            if (level >= 2) //Manager vagy Owner
            {
                alkalmazottak = new(this.Size, OptionPanel.ItemPanelCategory.Employees);
                this.Controls.Add(alkalmazottak);
                alkalmazottak.BackColor = Color.RebeccaPurple;

                cbModositas.Items.Add("Alkalmazottak");
                current = alkalmazottak;
            }
            else
            {
                current = szobak;
            }

            current.UpdateNShow(Hotel.GetHotelByName(cbHotelek.SelectedItem!.ToString()!));
            cbModositas.SelectedIndex = 0;
        }

        private void cbModositas_SelectedIndexChanged(object sender, EventArgs e)
        {
            current.Visible = false;

            switch (cbModositas.Text)
            {
                case "Alkalmazottak":
                    current = alkalmazottak;
                    break;
                case "Szobák":
                    current = szobak;
                    break;
                case "Szolgáltatások":
                    current = szolgaltatasok;
                    break;
            }

            current.UpdateNShow(Hotel.GetHotelByName(cbHotelek.SelectedItem!.ToString()!));
        }
    }
}
