using System.Security.Cryptography;

namespace SzallodaManagerForm
{
    public partial class Login : Form
    {
        Database DB;

        public Login()
        {
            InitializeComponent();
        }

        public static string StringSha256Hash(string text) =>
        string.IsNullOrEmpty(text) ? string.Empty : BitConverter.ToString(new System.Security.Cryptography.SHA256Managed().ComputeHash(System.Text.Encoding.UTF8.GetBytes(text))).Replace("-", string.Empty);

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
                string lekerdezes = $"select user_id, password from user where username like '{tbUsername}' or email like '{tbUsername}';";
                DB = new(lekerdezes);
                DB.Dr.Read();
                int user_ID = Convert.ToInt32(DB.Dr["user_id"]);
                if (DB.Dr["password"].ToString() == StringSha256Hash(tbPassword.Text))
                {
                    DB.CloseConnection();
                    lekerdezes = $"select hotel_id, userType from employee where user_id = {user_ID}";
                    DB = new(lekerdezes);
                    List<Hotel> hotelek = new List<Hotel>();
                    while (DB.Dr.Read())
                    {
                        hotelek.Add(new(Convert.ToInt32(DB.Dr["hotel_id"]), DB.Dr["userType"].ToString() == "employee" ? Hotel.AuthorityLevel.Employee : Hotel.AuthorityLevel.Owner));
                    }

                    Main main = new Main();
                    main.user = new(user_ID, hotelek);
                    Hide();
                    main.ShowDialog();
                }
                else 
                {
                    ThrowError(lbPasswordError, "Hibás jelszó!");
                }
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
    }
}
