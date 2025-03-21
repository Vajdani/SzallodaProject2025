using SzallodaManagerForm.Models;

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
        public ItemPanelCategory Category { get; private set; }
        
        public OptionPanel(Size parent, ItemPanelCategory category) 
        {
            Category = category;

            Size = new Size(parent.Width, parent.Height-70);
            Location = new Point(0, 70);
            Visible = false;

            itemPanelCon = new Panel
            {
                BackColor = Color.Red,
                Size = new Size(Size.Width - 20, (parent.Height - 170)),
                Location = new Point(0, 50),
                AutoScroll = true
            };
            Controls.Add(itemPanelCon);
        }

        public void UpdatePanel(Hotel? hotel)
        {
            itemPanelCon.Controls.Clear();

            if (hotel == null) { return; }

            switch (Category)
            {
                case ItemPanelCategory.Employees:
                    foreach (var employee in hotel.Employees)
                    {
                        itemPanelCon.Controls.Add(new EmployeePanel(itemPanelCon, employee));
                    }

                    break;
                case ItemPanelCategory.Services:
                    foreach (Service service in hotel.Services)
                    {
                        itemPanelCon.Controls.Add(new ServicePanel(itemPanelCon, service));
                    }

                    break;
                case ItemPanelCategory.Rooms:
                    foreach (Room room in hotel.Rooms)
                    {
                        itemPanelCon.Controls.Add(new RoomPanel(itemPanelCon, room));
                    }

                    break;
            }

            Visible = true;
        }

        public void ResizePanel(Size parent)
        {
            Size = new Size(parent.Width, parent.Height - 70);
            itemPanelCon.Size = new Size(Size.Width - 20, (parent.Height - 170));

            foreach(var ItP in itemPanelCon.Controls)
            {
                // Ha az aktuális item ItemPanel, resize function meghívása rajta
                if(ItP is ItemPanel) {}
            }
        }
    }
}
