using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm.ItemPanels
{
    internal class NewEmployeePanel : ItemPanel
    {
        Label lbNev;
        ComboBox cbAuthorityLevel;
        Button btnAddButton;

        public NewEmployeePanel(Panel parent, string n) : base(parent)
        {
            lbNev = new()
            {
                Text = n
            };

            cbAuthorityLevel = new()
            {
                Items = {
                    "Alkalmazott",
                    "Manager"
                },
                SelectedIndex = 0,
            };

            btnAddButton = new()
            {
                 Text = "Felvétel",    
            };
            btnAddButton.Click += (s, e) =>
            {
                Hire();
            };
        }

        void Hire()
        {

        }
    }
}
