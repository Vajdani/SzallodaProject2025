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
        }

        private void Main_Load(object sender, EventArgs e)
        {
            if (User.ActiveUser == null)
            {
                MessageBox.Show("Nincs kiválasztott felhasználó, kérem jelentkezzen be újra!", "Hiba!", MessageBoxButtons.OK, MessageBoxIcon.Error);
                Close();
                return;
            }

            //Jogosultságnak megfelelő dolgok megjelenítése
            //Elérhető hotelek hozzáadása a comboboxhoz

            lbFelhasznalo.Text = User.ActiveUser.username;

            foreach (Hotel hotel in Hotel.userHotels)
            {
                cbHotelek.Items.Add(hotel.Name);
            }


            alkalmazottak = new();
            szobak = new();
            szolgaltatasok = new();

            this.Controls.Add(alkalmazottak);
            this.Controls.Add(szobak);
            this.Controls.Add(szolgaltatasok);


            alkalmazottak.BackColor = Color.RebeccaPurple;
            //Alapbeállítás
            current = alkalmazottak;
            cbModositas.SelectedIndex = 0;
            current.UpdateNShow();
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

            //pHotelInfo.Visible = true;

            //lbHotelName.Text = $"Név: {hotel.Name}";

            //using Database cityName = new($"select cityName from city where city_id = {hotel.city_id}");
            //cityName.Read();
            //lbCity.Text = $"Város: {cityName.GetString("cityName")}";

            //lbAddress.Text = $"Cím: {hotel.Address}";
            //lbPhoneNumber.Text = $"Telefonszám: {hotel.PhoneNumber}";
            //lbEmail.Text = $"E-mail cím: {hotel.Email}";
        }

        private void cbModositas_SelectedIndexChanged(object sender, EventArgs e)
        {
            switch (cbModositas.Text)
            {
                case "Alkalmazottak":
                    current.Visible = false;
                    current = alkalmazottak;
                    current.UpdateNShow();
                    break;

                case "Szobák":
                    current.Visible = false;
                    current = szobak;
                    current.UpdateNShow();
                    break;

                case "Szolgáltatások":
                    current.Visible = false;
                    current = szolgaltatasok;
                    current.UpdateNShow();
                    break;

            }
        }
    }
}
