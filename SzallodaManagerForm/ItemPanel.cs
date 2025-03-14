using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm
{
    internal class ItemPanel : Panel
    {
        private Label lbDisplayName;
        private Button btnEdit;

        public ItemPanel(string display)
        {

            this.Size = new System.Drawing.Size(750, 50);
            this.Location = new Point(10, 50);
            this.BackColor = Color.Aqua;
            this.Visible = true;

            lbDisplayName = new Label();
            lbDisplayName.Text = display;
            lbDisplayName.Location = new Point(30, (this.Size.Height / 2)-(lbDisplayName.Height / 2));

            btnEdit = new Button();
            btnEdit.Text = "Módosítás";
            btnEdit.Location = new Point(650, (this.Size.Height / 2)-(btnEdit.Height / 2));
            btnEdit.Click += ButtonClick;

            this.Controls.Add(lbDisplayName);
            this.Controls.Add(btnEdit);
        }

        private void ButtonClick(object sender, EventArgs e)
        {
            
        }
    }
}
