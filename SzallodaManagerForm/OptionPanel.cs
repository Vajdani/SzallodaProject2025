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

        public void UpdateNShow(Hotel? hotel)
        {
            itemPanelCon.Controls.Clear();

            if (hotel == null) { return; }

            int hotel_id = hotel.hotel_id;
            switch (Category)
            {
                case ItemPanelCategory.Employees:
                    var employeePanels = Database.ReadAll<EmployeePanel>($"select user.username, employee.userType from employee, user where user.user_id = employee.user_id and userType <> 'owner' and hotel_id = {hotel_id}");
                    foreach(EmployeePanel panel in employeePanels)
                    {
                        itemPanelCon.Controls.Add(panel);
                    }

                    break;
                case ItemPanelCategory.Services:
                    var servicePanels = Database.ReadAll<ServicePanel>($"select service.available, servicecategory.serviceName from service, servicecategory where service.category_id = servicecategory.serviceCategory_id and service.hotel_id = {hotel_id}");
                    foreach (ServicePanel panel in servicePanels)
                    {
                        itemPanelCon.Controls.Add(panel);
                    }

                    break;
                case ItemPanelCategory.Rooms:;
                    foreach (Room room in Hotel.userHotels[hotel_id].Rooms)
                    {
                        itemPanelCon.Controls.Add(new RoomPanel(room));
                    }

                    break;
            }

            //scrollability test
            for (int i = 0; i < 20; i++)
            {
                ServicePanel panel = new(this.Size, i.ToString(), i % 10 == 0)
                {
                    Location = new Point(0, (i * 52))
                };

                itemPanelCon.Controls.Add(panel);
            }

            Visible = true;
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
