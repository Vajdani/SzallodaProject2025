using static Mysqlx.Notice.Warning.Types;

namespace SzallodaManagerForm.Models
{
    internal class Employee
    {
        public int Id { get; private set; }
        public string username { get; private set; }
        public int hotel_id { get; private set; }
        public User.AuthorityLevel AuthorityLevel { get; private set; }

        public Employee(Database DB)
        {
            Id = DB.GetInt("user_id"); // ERRROOOOOOOOOOOOOOOOOOOOOOOOOOR!!!!!!!!!!!!!!!!!!!!!!!, kell a lekérdezésbe az a szar annyi
            username = DB.GetString("username");
            hotel_id = DB.GetInt("hotel_id");
            AuthorityLevel = User.GetAuthorityLevel(DB.GetString("userType"));
        }

        public void ChangeEmployeeAuthority()
        {
            string level;
            if (AuthorityLevel == User.AuthorityLevel.Employee){ level = "manager"; AuthorityLevel = User.AuthorityLevel.Manager; }
            else level = "employee"; AuthorityLevel = User.AuthorityLevel.Employee;
                
            Database ab = new($"UPDATE employee SET userType = '{level}' WHERE user_id = {Id};");
            ab.Close();
        }

        public void FireEmployee()
        {
            Database ab = new($"DELETE FROM employee WHERE user_id = {Id};");
            ab.Close();
        }
    }
}
