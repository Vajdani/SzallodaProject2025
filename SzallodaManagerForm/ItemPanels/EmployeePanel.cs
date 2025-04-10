using SzallodaManagerForm.Models;

namespace SzallodaManagerForm.ItemPanels
{
    internal class EmployeePanel : ItemPanel
    {
        public static Dictionary<string, Delegate> SearchCategories { get; private set; } = new Dictionary<string, Delegate>()
        {
            {"Név", new Func<Employee, string>(e => e.username) },
            {"Rank", new Func<Employee, string>(e => e.AuthorityLevel == User.AuthorityLevel.Employee ? "Alkalmazott" : "Manager") },
        };

        Employee employee;
        Label lbUsername;
        Label lbUserType;
        Button btnChangeLevel;
        Button btnFire;

        public EmployeePanel(Panel parent, Employee employee) : base(parent)
        {
            this.employee = employee;
            lbUsername = new()
            {
                Text = employee.username
            };

            lbUserType = new()
            {
                Text = User.GetAuthorityLevelName(employee.AuthorityLevel) == "Employee" ? "Alkalmazott" : "Manager"
            };

            btnChangeLevel = new()
            {
                Text = employee.AuthorityLevel == User.AuthorityLevel.Employee ? "Előléptetés" : "Lefokozás",
                Size = new((int)Math.Round(Size.Width * 0.24), (int)Math.Round(Size.Height * 0.6))
            };
            btnChangeLevel.Click += ChangeLevel;

            btnFire = new()
            {
                Text = "Kirugás",
                Size = new((int)Math.Round(Size.Width * 0.24), (int)Math.Round(Size.Height * 0.6))
            };
            btnFire.Click += Fire;

            Controls.Add(lbUsername);
            Controls.Add(lbUserType);
            if(User.GetHotelAuthorityLevel(Main.Instance.GetSelectedHotelId()) == User.AuthorityLevel.Owner) Controls.Add(btnChangeLevel); 
            Controls.Add(btnFire);

            AlignElementsHorizontally();
        }

        void ChangeLevel(object? sender, EventArgs e)
        {
            string action = employee.AuthorityLevel == User.AuthorityLevel.Employee ? "elő szeretnéd léptetni" : "le szeretnéd fokozni";
            DialogResult result = MessageBox.Show($"Biztos {action} {employee.username}-t?", "Megerősítés", MessageBoxButtons.YesNo, MessageBoxIcon.Question);
            if (result == DialogResult.Yes)
            {
                employee.ChangeEmployeeAuthority();
            }
            Main.current.UpdatePanel(Main.Instance.GetSelectedHotel());
        }

        void Fire(object? sender, EventArgs e)
        {
            DialogResult result = MessageBox.Show($"Biztos ki szeretnéd rugni {employee.username}-t?", "Megerősítés", MessageBoxButtons.YesNo, MessageBoxIcon.Question);
            if (result == DialogResult.Yes)
            {
                employee.FireEmployee();
            }
            Main.current.UpdatePanel(Main.Instance.GetSelectedHotel());
        }

        public static new List<Employee> GetList() => Main.Instance.GetSelectedHotel().Employees;
        public static Type GetModelType() => typeof(Employee);
    }
}
