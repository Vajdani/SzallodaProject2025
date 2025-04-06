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
            Bookings,
            Statistic
        }

        Panel itemPanelCon;
        List<Label> Headers = new List<Label>();

        Button? extraFunctButton;
        public ItemPanelCategory Category { get; private set; }
        
        public OptionPanel(ItemPanelCategory category, string[]? headertexts = null) 
        {
            Category = category;

            Size = new Size(Main.Instance.ClientSize.Width, Main.Instance.ClientSize.Height);
            Location = new Point(0,50);
            Visible = false;

            itemPanelCon = new Panel
            {
                BackColor = Color.Gray,
                Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 200)),
                Location = new Point(10, 50),
                AutoScroll = true
            };
            Controls.Add(itemPanelCon);

            if (headertexts != null)
            {
                foreach (string text in headertexts)
                {
                    Headers.Add(new Label { Text = text, Visible = false, Font = new("arial", 12, FontStyle.Bold), AutoSize = true }); 
                }
            }

            if(category == ItemPanelCategory.Employees)
            {
                extraFunctButton = new()
                {
                    Text = "Alkalmazott hozzáadása",
                    Size = new(300, 40),
                    Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 300, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5),
                };
                extraFunctButton.Click += (s, e) => { OpenHiringForm(); };
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
                case ItemPanelCategory.Bookings:
                    foreach (Booking booking in hotel.Bookings)
                    {
                        if(booking.status == Booking.BookingStatus.RefundRequested || (booking.status == Booking.BookingStatus.Confirmed && booking.bookEnd.Date < DateTime.Today )) itemPanelCon.Controls.Add(new BookingPanel(itemPanelCon, booking));
                    }
                    break;
                case ItemPanelCategory.Statistic:
                    foreach(var valuePair in Main.Instance.GetSelectedHotel().GetBookingStatistics())
                    {
                        (int count, int profit) = valuePair.Value;
                        if(count > 0) itemPanelCon.Controls.Add(new MonthStatisticPanel(itemPanelCon, valuePair.Key, count, profit));
                    }
                    break;
            }

            this.Visible = true;

            if(itemPanelCon.Controls.Count == 0)
            {
                Label noElementsLabel = new()
                {
                    Text = "Nincsenek elemek",
                    Font = new Font("arial", 20, FontStyle.Bold),
                    AutoSize = true,
                };
                itemPanelCon.Controls.Add(noElementsLabel);
                noElementsLabel.Location = new Point(
                    (itemPanelCon.ClientSize.Width - noElementsLabel.Width) / 2, 
                    (itemPanelCon.ClientSize.Height - noElementsLabel.ClientSize.Height) / 2);
               
            }
            else
            {
                DisplayHeaderTexts(((ItemPanel)itemPanelCon.Controls[0]).GetControlPositions());
            }

        }

        public void DisplayHeaderTexts(List<int> points)
        {
            for (int i = 0; i < Headers.Count && i < points.Count; i++)
            {
                Headers[i].Visible = true;
                Headers[i].Location = new Point(points[i], 30);
                this.Controls.Add(Headers[i]);
            }
        }

        public void ResizePanel()
        {
            Size = new Size(Main.Instance.ClientSize.Width, Main.Instance.ClientSize.Height - 100);
            itemPanelCon.Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 200));
            if(extraFunctButton is not null) extraFunctButton.Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 300, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5);

            if (itemPanelCon.Controls.Count > 1)
            {
                foreach (ItemPanel ItP in itemPanelCon.Controls)
                {
                    ItP.ResizePanel(itemPanelCon.Size);
                }
                DisplayHeaderTexts(((ItemPanel)itemPanelCon.Controls[0]).GetControlPositions());
            }

            if (itemPanelCon.Controls.Count == 1)
            {
                Label noitems = (Label)itemPanelCon.Controls[0];
                noitems.Location = new Point(
                    (itemPanelCon.ClientSize.Width - noitems.Width) / 2,
                    (itemPanelCon.ClientSize.Height - noitems.Height) / 2
                );
                foreach(Label ht in Headers)
                {
                    ht.Visible = false;
                }
            }

        }

        void OpenHiringForm()
        {
            new AddEmployeeForm().ShowDialog();
        }
    }
}
