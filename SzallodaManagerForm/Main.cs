using SzallodaManagerForm.Models;

namespace SzallodaManagerForm
{
    public partial class Main : Form
    {
        OptionPanel current;
        OptionPanel alkalmazottak;
        OptionPanel szobak;
        OptionPanel szolgaltatasok;

        public Main()
        {
            InitializeComponent();

            szobak = new(Size, OptionPanel.ItemPanelCategory.Rooms);
            szolgaltatasok = new(Size, OptionPanel.ItemPanelCategory.Services)
            {
                BackColor = Color.RebeccaPurple
            };
            alkalmazottak = new(Size, OptionPanel.ItemPanelCategory.Employees)
            { 
                BackColor = Color.RebeccaPurple
            };
            
            Controls.Add(szobak);
            Controls.Add(szolgaltatasok);
            Controls.Add(alkalmazottak);

            current = szobak;
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

            cbModositas.Items.Clear();
            cbModositas.Items.Add("Szobák");
            cbModositas.Items.Add("Szolgáltatások");

            int level = (int)User.GetHotelAuthorityLevel(hotel.hotel_id);
            if (level >= 2) //Manager vagy Owner
            {
                cbModositas.Items.Add("Alkalmazottak");
            }

            current = szobak;
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

            current.UpdatePanel(Hotel.GetHotelByName(cbHotelek.SelectedItem!.ToString()!));
        }
    }
}
