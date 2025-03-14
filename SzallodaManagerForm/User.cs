﻿namespace SzallodaManagerForm
{
    internal class User
    {
        public enum AuthorityLevel
        {
            Employee,
            Manager
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

            User user = new(user_id);
            ActiveUser = user;
        }

        public static void OnUserLogout()
        {
            ActiveUser = null;
        }

        public static AuthorityLevel GetAuthorityLevel(string authLevel)
        {
            return authLevel switch
            {
                "manager" => AuthorityLevel.Manager,
                _ => AuthorityLevel.Employee,
            };
        }
    }
}
