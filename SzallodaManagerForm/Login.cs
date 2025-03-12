namespace SzallodaManagerForm
{
    public partial class Login : Form
    {
        public static Login? Instance { get; set; }

        public Login()
        {
            Instance = this;

            InitializeComponent();
        }

        private void btnBejelentkezés_Click(object sender, EventArgs e)
        {
            lbUsernameError.Visible = false;
            lbPasswordError.Visible = false;
            if (tbUsername.Text.Length == 0)
            {
                ThrowError(lbUsernameError, "Kérlek add meg a felhasználóneved!");
                tbUsername.Focus();
            }
            else if (tbUsername.Text.Length < 5)
            {
                ThrowError(lbUsernameError, "A felhasználónév legalább 5 karakter hosszú!");
                tbUsername.Focus();
            }
            else if (tbPassword.Text.Length == 0)
            {
                ThrowError(lbPasswordError, "Kérem adja meg a jelszót!");
            }
            else if (tbPassword.Text.Length < 8)
            {
                ThrowError(lbPasswordError, "A jelszó legalább 8 karakter hosszú");
            }
            else
            {
                HandleLogin();
            }
        }

        void HandleLogin()
        {
            using Database userQuery = new($"select user_id, password from user where username like '{tbUsername.Text}' or email like '{tbUsername.Text}';");
            if (!userQuery.Reader.Read())
            {
                MessageBox.Show("Nincsen ilyen felhasználó! Probáljon meg egy másik felhasználónevet!", "Hiba!", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return;
            }

            if (BCrypt.Net.BCrypt.Verify(tbPassword.Text, userQuery.Reader["password"].ToString()))
            {
                int user_id = Convert.ToInt32(userQuery.Reader["user_id"]);

                User.OnUserLogin(user_id);
                Hotel.OnUserLogin(user_id);

                Hide();
                new Main().ShowDialog();

                tbUsername.Clear();
                tbPassword.Clear();
            }
            else
            {
                ThrowError(lbPasswordError, "Hibás jelszó!");
            }
        }

        private void Login_Load(object sender, EventArgs e)
        {
            lbUsernameError.Visible = false;
            lbPasswordError.Visible = false;
        }

        private void ThrowError(Label target, string message)
        {
            target.Visible = true;
            target.Text = message;
        }

        public static void OnUserLogout()
        {
            if (Instance == null)
            {
                throw new Exception("There is no Login form instance!");
            }

            Instance.Show();
            User.OnUserLogout();
            Hotel.OnUserLogout();
        }
    }
}
