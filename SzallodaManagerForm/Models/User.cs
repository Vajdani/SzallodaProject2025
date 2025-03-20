namespace SzallodaManagerForm.Models
{
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

        public string GetAuthorityLevelName(AuthorityLevel level)
        {
            return level switch
            {
                AuthorityLevel.Owner => "Owner",
                AuthorityLevel.Manager => "Manager",
                _ => "Employee",
            };
        }

        public string GetAuthorityLevelName(int hotel_id)
        {
            return authorityLevels[hotel_id] switch
            {
                AuthorityLevel.Owner => "Owner",
                AuthorityLevel.Manager => "Manager",
                _ => "Employee",
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
    }
}
