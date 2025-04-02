namespace SzallodaManagerForm.Models
{

    internal class BaseUser
    {
        public int user_id { get; protected set; }
        public string username { get; protected set; }
        public string firstname { get; protected set; }
        public string lastname { get; protected set; }

        public BaseUser(Database db)
        {
            user_id = db.GetInt("user_id");
            username = db.GetString("username");
            firstname = db.GetString("firstName");
            lastname = db.GetString("lastName");
        }

        public void HireUser(int authBoxIndex)
        {
            Database ab = authBoxIndex switch
            {
                0 => new($"INSERT INTO employee(hotel_id, user_id, userType) VALUES ({Main.Instance.GetSelectedHotelId()}, {user_id}, 'employee');"),
                1 => new($"INSERT INTO employee(hotel_id, user_id, userType) VALUES ({Main.Instance.GetSelectedHotelId()}, {user_id}, 'manager');"),
                _ => throw new Exception("Invalid value")
            };
            ab.Close();

            Main.Instance.GetSelectedHotel().AddEmployee(new Employee(this, authBoxIndex == 0 ? User.AuthorityLevel.Employee : User.AuthorityLevel.Manager));
        }

    }

    internal class User 
    {
        public enum AuthorityLevel
        {
            Employee,
            Manager,
            Owner
        }

        public static User? ActiveUser;

        public int user_id;
        public string username;

        public TimeOnly lastActivity;
        public Dictionary<int, AuthorityLevel> authorityLevels = [];

        public User(int user_id)
        {
            this.user_id = user_id;

            using Database userData = new($"select * from user where user_id = {user_id}");
            userData.Read();
            username = userData.GetString("username");

            using Database authLevel = new($"select hotel_id, userType from employee where user_id = {user_id}");
            while (authLevel.Read())
            {
                authorityLevels.Add(
                    authLevel.GetInt("hotel_id"),
                    GetAuthorityLevel(authLevel.GetString("userType"))
                );
            }
        }

        public static void OnUserLogin(int user_id)
        {
            if (ActiveUser != null)
            {
                throw new Exception("A user is already logged in!");
            }

            ActiveUser = new(user_id);
        }

        public static void OnUserLogout()
        {
            ActiveUser = null;
        }

        public static AuthorityLevel GetAuthorityLevel(string authLevel)
        {
            return authLevel switch
            {
                "owner" => AuthorityLevel.Owner,
                "manager" => AuthorityLevel.Manager,
                _ => AuthorityLevel.Employee,
            };
        }

        public static AuthorityLevel GetHotelAuthorityLevel(int hotel_id)
        {
            if (ActiveUser == null)
            {
                throw new Exception("User hasn't logged in yet!");
            }

            return ActiveUser.authorityLevels[hotel_id];
        }

        public static string GetAuthorityLevelName(AuthorityLevel level)
        {
            return level switch
            {
                AuthorityLevel.Owner => "Owner",
                AuthorityLevel.Manager => "Manager",
                _ => "Employee",
            };
        }

        public string GetHotelAuthorityLevelName(int hotel_id)
        {
            return authorityLevels[hotel_id] switch
            {
                AuthorityLevel.Owner => "Owner",
                AuthorityLevel.Manager => "Manager",
                _ => "Employee",
            };
        }
    }
}
