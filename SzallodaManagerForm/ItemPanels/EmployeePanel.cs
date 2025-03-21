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

            btnEdit = new Button();
            btnEdit.Click += OpenEditForm;
        }

        void OpenEditForm(object? sender, EventArgs e)
        {
            //Alkalmazott adatok form, ha lesz
        }
    }
}
