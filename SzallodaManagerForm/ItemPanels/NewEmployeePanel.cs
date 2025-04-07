using SzallodaManagerForm.Models;

namespace SzallodaManagerForm.ItemPanels
{
    internal class NewEmployeePanel : ItemPanel
    {
        BaseUser user;
        Label lbUsername;
        Label lbFullname;
        ComboBox cbAuthorityLevel;
        Button btnAddButton;

        public NewEmployeePanel(Panel parent, BaseUser user) : base(parent)
        {
            this.user = user;
            lbUsername = new()
            {
                Text = user.username
            };

            lbFullname = new()
            {
                Text = $"{user.firstname} {user.lastname}",
            };

            cbAuthorityLevel = new()
            {
                Items = {
                    "Alkalmazott",
                    "Manager"
                },
                SelectedIndex = 0,
                DropDownStyle = ComboBoxStyle.DropDownList
            };
            cbAuthorityLevel.MouseWheel += (s, e) => { ((HandledMouseEventArgs)e).Handled = true; };

            btnAddButton = new()
            {
                Text = "Felvétel",
                Size = new Size(150, 40)
            };

            btnAddButton.Click += (s, e) =>
            {
                DialogResult result = MessageBox.Show($"Biztod fel szeretnéd venni {lbFullname.Text}-t a {Main.Instance.GetSelectedHotel().Name} hotelhez {cbAuthorityLevel.Text}ként?", "Megerősítés", MessageBoxButtons.YesNo, MessageBoxIcon.Question);
                if (result == DialogResult.Yes) 
                {
                    user.HireUser(cbAuthorityLevel.SelectedIndex);
                    if (UsersPanel.Instance != null)
                    {
                        UsersPanel.Instance.UpdatePanel();
                        UsersPanel.Instance.tbSearchbox.Clear();
                    }
                }
            };

            Controls.Add(lbUsername);
            Controls.Add(lbFullname);
            if(User.GetHotelAuthorityLevel(Main.Instance.GetSelectedHotelId()) == User.AuthorityLevel.Owner) Controls.Add(cbAuthorityLevel);
            Controls.Add(btnAddButton);

            AlignElementsHorizontally();
        }
    }
}
