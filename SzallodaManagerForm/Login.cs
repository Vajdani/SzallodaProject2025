using SzallodaManagerForm.Models;

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
            Database userQuery;
            try
            {
                userQuery = new($"select user.user_id, user.password from user, employee " +
                                $"where (username like '{tbUsername.Text}' or email like '{tbUsername.Text}') and " +
                                $"employee.user_id = user.user_id;");
                if (!userQuery.Read())
                {
                    MessageBox.Show("Sikertelen bejelentkezés! Rossz felhasználónevet vagy jelszavat adott meg!", "Hiba!", MessageBoxButtons.OK, MessageBoxIcon.Error);
                    return;
                }
            }
            catch (Exception)
            {
                MessageBox.Show("Nem elérhetõ a szerver! Próbálja meg késõbb.", "Hiba!", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return;
            }

            if (BCrypt.Net.BCrypt.Verify(tbPassword.Text, userQuery.GetString("password")))
            {
                int user_id = userQuery.GetInt("user_id");
                userQuery.Close();

                User.OnUserLogin(user_id);
                Hotel.OnUserLogin(user_id);

                Hide();
                new Main().ShowDialog();

                tbUsername.Clear();
                tbPassword.Clear();
            }
            else
            {
                userQuery.Close();
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
