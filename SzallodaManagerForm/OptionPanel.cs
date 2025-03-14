using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.CompilerServices;
using System.Text;
using System.Threading.Tasks;
using System.Drawing;

namespace SzallodaManagerForm
{
    internal class OptionPanel : Panel
    {

        Panel itemPanelCon;

        public OptionPanel() 
        {
            this.Size = new Size(880, 500);
            this.Location = new Point(11, 90);
            this.Visible = false;

            itemPanelCon = new Panel();
            itemPanelCon.Size = new Size(870, 420);
            itemPanelCon.Location = new Point(1, 1);
            itemPanelCon.AutoScroll = true;
            this.Controls.Add(itemPanelCon);
        }

        public void UpdateNShow()
        {

            this.itemPanelCon.Controls.Clear();
            ItemPanel curr;
            //scrollability test
            for (int i = 0; i < 20; i++)
            {
                curr = new ItemPanel(i.ToString());
                curr.Location = new Point(0, 50+(i*52));
                
                this.itemPanelCon.Controls.Add(curr);
            }


            this.Visible = true;
        }
    }
}
