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
            Id = DB.GetInt("user_id"); 
            username = DB.GetString("username");
            hotel_id = DB.GetInt("hotel_id");
            AuthorityLevel = User.GetAuthorityLevel(DB.GetString("userType"));
        }

        public Employee(BaseUser user, User.AuthorityLevel auth) {
            Id = user.user_id;
            username = user.username;
            hotel_id = Main.Instance.GetSelectedHotelId();
            AuthorityLevel = auth;
        }

        public void ChangeEmployeeAuthority()
        {
            string level;
            if (AuthorityLevel == User.AuthorityLevel.Employee)
            {
                level = "manager";
                AuthorityLevel = User.AuthorityLevel.Manager;
            }
            else
            {
                level = "employee";
                AuthorityLevel = User.AuthorityLevel.Employee;
            }
   
            Database ab = new($"UPDATE employee SET userType = '{level}' WHERE user_id = {Id};");
            ab.Close();
            MessageBox.Show("Sikeres módosítás", "Információ", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }

        public void FireEmployee()
        {
            Database ab = new($"DELETE FROM employee WHERE user_id = {Id} and hotel_id = {Main.Instance.GetSelectedHotelId()};");
            ab.Close();
            Main.Instance.GetSelectedHotel().RemoveEmployee(Id, Main.Instance.GetSelectedHotelId());
            MessageBox.Show("Sikeres módosítás", "Információ", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }
    }
}
