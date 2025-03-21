namespace SzallodaManagerForm.Models
{
    internal class Employee
    {
        public string username { get; private set; }
        public int hotel_id { get; private set; }
        public User.AuthorityLevel AuthorityLevel { get; private set; }

        public Employee(Database DB)
        {
            username = DB.GetString("username");
            hotel_id = DB.GetInt("hotel_id");
            AuthorityLevel = User.GetAuthorityLevel(DB.GetString("userType"));
        }
    }
}
