using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm
{
    internal class AddEmployeeForm : Form
    {
        Label lbTitle; 
        UsersPanel Display;

        public AddEmployeeForm()
        {

            this.Size = new(300, 800);
            this.StartPosition = FormStartPosition.CenterParent;

            lbTitle = new()
            {
                Text = "Alkalmazott hozzáadása",
                Location = new(this.ClientSize.Width/2, 30)
            };

            Display = new()
            {
                BackColor = Color.Purple,
            };
        }

    }
}
