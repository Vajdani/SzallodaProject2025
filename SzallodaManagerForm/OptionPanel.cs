using SzallodaManagerForm.ItemPanels;
using SzallodaManagerForm.Models;

namespace SzallodaManagerForm
{
    internal class OptionPanel : Panel
    {
        public enum ItemPanelCategory
        {
            Rooms,
            Employees,
            Services,
        }

        Panel itemPanelCon;
        Button? extraFunctButton;
        public ItemPanelCategory Category { get; private set; }
        
        public OptionPanel(ItemPanelCategory category) 
        {
            Category = category;

            Size = new Size(Main.Instance.ClientSize.Width, Main.Instance.ClientSize.Height-100);
            Location = new Point(0,100);
            Visible = false;

            itemPanelCon = new Panel
            {
                BackColor = Color.Red,
                Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 200)),
                Location = new Point(10, 50),
                AutoScroll = true
            };
            Controls.Add(itemPanelCon);

            if(category == ItemPanelCategory.Employees)
            {
                extraFunctButton = new()
                {
                    Text = "Alkalmazott hozzáadása",
                    Size = new(300, 40),
                    Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 300, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5),
                };
                this.Controls.Add(extraFunctButton);
            }
        }

        public void UpdatePanel(Hotel? hotel)
        {
            itemPanelCon.Controls.Clear();
            ResizePanel();

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
            this.Visible = true;

        }

        public void ResizePanel()
        {
            Size = new Size(Main.Instance.ClientSize.Width, Main.Instance.ClientSize.Height - 100);
            itemPanelCon.Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 200));
            if(extraFunctButton is not null) extraFunctButton.Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 300, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5);

            foreach (ItemPanel ItP in itemPanelCon.Controls)
            {
                ItP.ResizePanel(itemPanelCon.Size);
            }
        }

        void OpenHiringForm()
        {
            new AddEmployeeForm().ShowDialog();
        }
    }
}
