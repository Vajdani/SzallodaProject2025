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
        Size parentsize;

        public OptionPanel(Size parent) 
        {
            parentsize = parent;
            this.Size = new Size(parent.Width, parent.Height-70);
            this.Location = new Point(0, 70);
            this.Visible = false;

            itemPanelCon = new Panel();
            itemPanelCon.BackColor = Color.Red;
            itemPanelCon.Size = new Size(this.Size.Width-20, (parent.Height-170));
            itemPanelCon.Location = new Point(0, 50);
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
                curr = new ItemPanel(this.Size);
                curr.ChangeText(i.ToString());
                curr.Location = new Point(0, (i*52));
                
                this.itemPanelCon.Controls.Add(curr);
            }

            
            this.Visible = true;
        }

        public void ResizePanel(Size parent)
        {
            this.Size = new Size(parent.Width, parent.Height - 70);
            itemPanelCon.Size = new Size(this.Size.Width - 20, (parent.Height - 170));

            foreach(var ItP in itemPanelCon.Controls)
            {
                // Ha az aktuális item ItemPanel, resize function meghívása rajta
                if(ItP is ItemPanel) {}
            }
        }
    }
}
