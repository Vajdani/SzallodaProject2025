using SzallodaManagerForm.Models;

namespace SzallodaManagerForm.ItemPanels
{
    internal class EmployeePanel : ItemPanel
    {
        Label lbUsername;
        Label lbUserType;
        Button btnEdit;

        public EmployeePanel(Panel parent, Employee employee) : base(parent)
        {
            lbUsername = new()
            {
                Text = employee.username
            };

            lbUserType = new()
            {
                Text = User.GetAuthorityLevelName(employee.AuthorityLevel)
            };

            btnEdit = new()
            {
                Text = "Módosítás",
                Size = new((int)Math.Round(Size.Width * 0.24), (int)Math.Round(Size.Height * 0.6))
            };
            btnEdit.Click += OpenEditForm;
 
            Controls.Add(lbUsername);
            Controls.Add(lbUserType);
            Controls.Add(btnEdit);

            AlignElementsHorizontally();
        }

        void OpenEditForm(object? sender, EventArgs e)
        {
            //Alkalmazott adatok form, ha lesz
        }
    }
}
