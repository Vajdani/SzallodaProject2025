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
        public enum ItemPanelCategory
        {
            Rooms,
            Employees,
            Services
        }

        Panel itemPanelCon;
        Size parentsize;
        public ItemPanelCategory Category { get; private set; }
        
        public OptionPanel(Size parent, ItemPanelCategory category) 
        {
            this.Category = category;

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
            Database ab;
            string lekerdezes;

            switch (Category)
            {
                case ItemPanelCategory.Employees:
                    lekerdezes = "";
                    ab = new(lekerdezes);
                    while (ab.Reader.Read())
                    {
                        curr = new EmployeePanel(this.Size);
                    }
                    break;
                case ItemPanelCategory.Services:
                    lekerdezes = "";
                    ab = new(lekerdezes);
                    while (ab.Reader.Read())
                    {
                        curr = new ServicePanel(this.Size, ab.Reader["megnevezes"].ToString(), Convert.ToInt32(ab.Reader["elerhetoseg"]) == 1);
                    }
                    break;
                case ItemPanelCategory.Rooms:
                    lekerdezes = "";
                    ab = new(lekerdezes);
                    while (ab.Reader.Read())
                    {
                        curr = new RoomPanel(this.Size, Convert.ToInt32(ab.Reader["szobaszam"]), Convert.ToInt32(ab.Reader["ar"]), Convert.ToInt32(ab.Reader["reserved"]) == 1);
                    }
                    break;
            }
            //scrollability test
            for (int i = 0; i < 20; i++)
            {
                curr = new ServicePanel(this.Size, i.ToString(), i % 10 == 0 ? true : false);
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
