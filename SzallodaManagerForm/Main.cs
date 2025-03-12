namespace SzallodaManagerForm
{
    public partial class Main : Form
    {
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
        }

        private void Main_Closed(object sender, FormClosedEventArgs e)
        {
            Login.OnUserLogout();
        }
    }
}
