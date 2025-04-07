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
        List<Label> Headers = [];

        //Alkalmazottak Extrák
        Button? extraFunctButton;

        //Statisztika extrák
        Label YearLabel;
        ComboBox statisticsYearBox;

        Label MostProfitMonth;
        Label TotalProfitYear;
        Label MostPopularMonth;

        int selectedYear = DateTime.Now.Year;

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

            if (category == ItemPanelCategory.Statistic)
            {
                statisticsYearBox = new()
                {
                    Size = new(120, 40),
                    Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 120, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5),
                    DropDownStyle = ComboBoxStyle.DropDownList,
                };

                foreach (string y in Main.Instance.GetSelectedHotel().GetYears())
                {
                    statisticsYearBox.Items.Add(y);
                }

                statisticsYearBox.SelectedIndex =statisticsYearBox.Items.Count - 1;

                statisticsYearBox.SelectedIndexChanged += (s, e) => 
                { 
                    selectedYear = int.Parse(statisticsYearBox.Text);
                    UpdatePanel(Main.Instance.GetSelectedHotel());
                };

                this.Controls.Add(statisticsYearBox);

                YearLabel = new()
                {
                    AutoSize = true,
                    Text = "Év:"
                };
                this.Controls.Add(YearLabel);
                YearLabel.Location = new Point(statisticsYearBox.Location.X - YearLabel.Size.Width - 5, statisticsYearBox.Location.Y + YearLabel.Size.Height / 2);

                MostPopularMonth = new() { AutoSize = true, };
                TotalProfitYear = new() { AutoSize = true, };
                MostProfitMonth = new() { AutoSize = true, };

                this.Controls.Add(MostPopularMonth);
                this.Controls.Add(TotalProfitYear);
                this.Controls.Add(MostProfitMonth);

                MostPopularMonth.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5);
                MostProfitMonth.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + MostProfitMonth.Height + 10);
                TotalProfitYear.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + MostProfitMonth.Height + MostPopularMonth.Height + 15);

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
                    Dictionary<string, (int, int)> data = Main.Instance.GetSelectedHotel().GetBookingStatistics(selectedYear);
                    foreach (var valuePair in data) 
                    {
                        (int count, int profit) = valuePair.Value;
                        if(count > 0) itemPanelCon.Controls.Add(new MonthStatisticPanel(itemPanelCon, valuePair.Key, count, profit));
                    }

                    if(data.Count > 0)
                    {
                        var mostPopular = data.OrderByDescending(x => x.Value.Item1).FirstOrDefault();
                        MostPopularMonth.Text = $"Legnépszerűbb hónap: {mostPopular.Key} ({mostPopular.Value.Item1} foglalás)";
                        int totalProfit = data.Sum(x => x.Value.Item2);
                        TotalProfitYear.Text = $"Év eddigi összes bevétele: {totalProfit} Ft";
                        var mostProfit = data.OrderByDescending(x => x.Value.Item2).FirstOrDefault();
                        MostProfitMonth.Text = $"Legjövedelmezőbb hónap: {mostProfit.Key} ({mostProfit.Value.Item2} Ft)";
                        MostPopularMonth.Visible = true;
                        TotalProfitYear.Visible = true;
                        MostProfitMonth.Visible = true;
                    }
                    else
                    {
                        MostPopularMonth.Visible = false ;
                        TotalProfitYear.Visible = false ;   
                        MostProfitMonth.Visible = false ;
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
            Size = new Size(Main.Instance.ClientSize.Width, Main.Instance.ClientSize.Height - 50);
            itemPanelCon.Size = Category switch
            {
                ItemPanelCategory.Employees => new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 150)),
                ItemPanelCategory.Statistic => new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 200)),
                _ => new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 100))
            };
            if(extraFunctButton is not null) extraFunctButton.Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 300, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5);
            if(Category == ItemPanelCategory.Statistic)  
            {
                MostPopularMonth.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5);
                MostProfitMonth.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + MostProfitMonth.Height + 10);
                TotalProfitYear.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + MostProfitMonth.Height + MostPopularMonth.Height + 15);

                statisticsYearBox.Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 120, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5);
                YearLabel.Location = new Point(statisticsYearBox.Location.X - YearLabel.Size.Width - 5, statisticsYearBox.Location.Y + YearLabel.Size.Height / 2);
            }

            if (itemPanelCon.Controls.Count == 1 && itemPanelCon.Controls[0] is Label noitems)
            {
                noitems.Location = new Point(
                    (itemPanelCon.ClientSize.Width - noitems.Width) / 2,
                    (itemPanelCon.ClientSize.Height - noitems.Height) / 2
                );
                foreach (Label ht in Headers)
                {
                    ht.Visible = false;
                }
            }
            else if (itemPanelCon.Controls.Count > 1) 
            {
                foreach (ItemPanel ItP in itemPanelCon.Controls)
                {
                    ItP.ResizePanel(itemPanelCon.Size);
                }
                DisplayHeaderTexts(((ItemPanel)itemPanelCon.Controls[0]).GetControlPositions());
            }
        }

        void OpenHiringForm()
        {
            new AddEmployeeForm().ShowDialog();
        }
    }
}
