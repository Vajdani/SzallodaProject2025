using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm
{
    internal class UsersPanel : Panel
    {
        Panel itemPanelCon;
        Label lbSearch;
        TextBox tbSearchbox;

        public UsersPanel() 
        {
            Size = new Size(Main.Instance.ClientSize.Width, Main.Instance.ClientSize.Height - 100);
            Location = new Point(0, 100);
            Visible = false;

            itemPanelCon = new Panel
            {
                BackColor = Color.Red,
                Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 200)),
                Location = new Point(10, 50),
                AutoScroll = true
            };
            Controls.Add(itemPanelCon);
        }

        public void UpdatePanel()
        {
            itemPanelCon.Controls.Clear();

        }

    }
}
