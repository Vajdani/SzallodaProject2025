using SzallodaManagerForm.Models;

namespace SzallodaManagerForm.ItemPanels
{
    internal class EmployeePanel : ItemPanel
    {
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
                Text = User.GetAuthorityLevelName(employee.AuthorityLevel)
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
            Controls.Add(btnChangeLevel); //Csak owner láthatja TODO
            Controls.Add(btnFire);

            AlignElementsHorizontally();
        }

        void ChangeLevel(object? sender, EventArgs e)
        {
            string aaaaaa = employee.AuthorityLevel == User.AuthorityLevel.Employee ? "elő szeretnéd léptetni" : "le szeretnéd fokozni";
            DialogResult result = MessageBox.Show($"Biztos {aaaaaa} {employee.username}-t?","Megerősítés",MessageBoxButtons.YesNo,MessageBoxIcon.Question);
            if (result == DialogResult.Yes)
            {
                employee.ChangeEmployeeAuthority();
                
            }
        }

        void Fire(object? sender, EventArgs e)
        {
            DialogResult result = MessageBox.Show($"Biztos ki szeretnéd rugni {employee.username}-t?", "Megerősítés", MessageBoxButtons.YesNo, MessageBoxIcon.Question);
            if (result == DialogResult.Yes)
            {
                employee.FireEmployee();
            }
        }
    }
}
