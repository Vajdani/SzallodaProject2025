using System.Collections;
using System.Reflection;
using SzallodaManagerForm.ItemPanels;
using SzallodaManagerForm.Models;



namespace SzallodaManagerForm
{
    internal abstract class OptionPanel : Panel
    {
        public static int selectedYear = DateTime.Now.Year;
        public virtual void UpdatePanel(Hotel? hotel, string filterstring = "") { }
        public virtual void ResizePanel() { }

    }
    internal class OptionPanel<P> : OptionPanel where P : ItemPanel
    {
        Panel itemPanelCon;
        List<Label> Headers = [];
        bool hasSearchbar;

        public OptionPanel(string[]? headertexts = null)
        {

            Size = new Size(Main.Instance.ClientSize.Width, Main.Instance.ClientSize.Height);
            Location = new Point(0, 50);
            Visible = false;

            itemPanelCon = new Panel
            {
                BackColor = Color.Gray,
                Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 150)),
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

            hasSearchbar = typeof(P).GetProperty("SearchCategories", BindingFlags.Public | BindingFlags.Static) != null;

            if (hasSearchbar)
            {
                itemPanelCon.Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 200));
                itemPanelCon.Location = new Point(10, 100);

                Label searchLabel = new()
                {
                    Name = "SearchLabel",
                    Text = "Keresés",
                    AutoSize = true,
                    Font = new Font("arial", 10, FontStyle.Bold)
                };

                TextBox searchbar = new() { Name = "SearchBar" };

                Controls.Add(searchbar);
                Controls.Add(searchLabel);

                searchLabel.Location = new(10, 30);
                searchbar.Location = new(20 + searchLabel.Width, 30);
                searchbar.TextChanged += (s, e) => { UpdatePanel(Main.Instance.GetSelectedHotel(), searchbar.Text); };

                var modelType = typeof(P).GetMethod("GetModelType", BindingFlags.Public | BindingFlags.Static)
                    ?.Invoke(null, null) as Type ?? throw new Exception("GetModelType returned null!");

                var searchCategoriesProp = typeof(P).GetProperty("SearchCategories", BindingFlags.Public | BindingFlags.Static);
                var searchCategoriesObj = searchCategoriesProp?.GetValue(null);

                if (searchCategoriesObj is IDictionary dict && dict.Count > 1)
                {
                    ComboBox searchCategory = new() { DropDownStyle = ComboBoxStyle.DropDownList, Name = "SearchCategory" };
                    Controls.Add(searchCategory);
                    searchCategory.Location = new(30 + searchLabel.Width + searchbar.Width, 30);
                    searchCategory.SelectedIndexChanged += (s, e) => { searchbar.Clear(); };

                    foreach (DictionaryEntry entry in dict)
                    {
                        searchCategory.Items.Add(entry.Key);
                    }
                    searchCategory.SelectedIndex = 0;
                }

            }

            if (typeof(P) == typeof(EmployeePanel))
            {
                Button NewEmployeeButton = new()
                {
                    Name = "NewEmployeeButton",
                    Text = "Alkalmazott hozzáadása",
                    Size = new(300, 40),
                    Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 300, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5),
                };
                NewEmployeeButton.Click += (s, e) => { OpenHiringForm(); };
                this.Controls.Add(NewEmployeeButton);
            }

            if (typeof(P) == typeof(MonthStatisticPanel))
            {
                ComboBox statisticsYearBox = new()
                {
                    Size = new(120, 40),
                    Name = "YearBox",
                    Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 120, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5),
                    DropDownStyle = ComboBoxStyle.DropDownList,
                };

                foreach (string y in Main.Instance.GetSelectedHotel().GetYears())
                {
                    statisticsYearBox.Items.Add(y);
                }

                statisticsYearBox.SelectedIndex = statisticsYearBox.Items.Count - 1;

                statisticsYearBox.SelectedIndexChanged += (s, e) =>
                {
                    selectedYear = int.Parse(statisticsYearBox.Text);
                    UpdatePanel(Main.Instance.GetSelectedHotel());
                };

                this.Controls.Add(statisticsYearBox);

                Label YearLabel = new()
                {
                    AutoSize = true,
                    Text = "Év:",
                    Name = "BeforeLabel"
                };
                this.Controls.Add(YearLabel);
                YearLabel.Location = new Point(statisticsYearBox.Location.X - YearLabel.Size.Width - 5, statisticsYearBox.Location.Y + YearLabel.Size.Height / 2);

                Label MostPopularMonth = new() { AutoSize = true, Name = "MostPopularM" };
                Label TotalProfitYear = new() { AutoSize = true, Name = "TotalProfitY" };
                Label MostProfitMonth = new() { AutoSize = true, Name = "MostProfitM" };

                this.Controls.Add(MostPopularMonth);
                this.Controls.Add(TotalProfitYear);
                this.Controls.Add(MostProfitMonth);

                MostPopularMonth.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5);
                MostProfitMonth.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + MostProfitMonth.Height + 10);
                TotalProfitYear.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + MostProfitMonth.Height + MostPopularMonth.Height + 15);

            }
        }

        public override void UpdatePanel(Hotel? hotel, string filterString = "")
        {
            itemPanelCon.Controls.Clear();
            ResizePanel();

            if (hotel == null) { return; }

            var staticMethod = typeof(P).GetMethod("GetList", BindingFlags.Public | BindingFlags.Static) ?? throw new Exception("GetList method not found");
            var result = staticMethod.Invoke(null, null);
            var list = result as IList;

            if (hasSearchbar)
            {
                Type modelType = typeof(P).GetMethod("GetModelType", BindingFlags.Public | BindingFlags.Static)?.Invoke(null, null) as Type ?? throw new Exception("modelType returned null");
                var searchCategoriesProp = typeof(P).GetProperty("SearchCategories", BindingFlags.Public | BindingFlags.Static) ?? throw new Exception("SearchCategories property not found");
                var searchCategories = searchCategoriesProp.GetValue(null) as IDictionary<string, Delegate> ?? throw new Exception("SearchCategories is not of the expected type.");

                var searchCategory = this.Controls.Cast<Control>().FirstOrDefault(control => control.Name == "SearchCategory");
                if (searchCategory != null)
                {
                    string selected = ((ComboBox)searchCategory).SelectedItem as string;

                    var func = searchCategories[selected] as Delegate;
                    var methodType = typeof(Func<,>).MakeGenericType(modelType, typeof(string));
                    var typedFunc = Delegate.CreateDelegate(methodType, func.Target, func.Method);
                    var filterMethod = this.GetType().GetMethod("FilterItems");
                    var genericFilterMethod = filterMethod.MakeGenericMethod(modelType);
                    var filteredList = genericFilterMethod.Invoke(this, new object[] { list, filterString, typedFunc });

                    foreach (var item in (System.Collections.IList)filteredList)
                    {
                        itemPanelCon.Controls.Add(CreatePanel(itemPanelCon, item));
                    }
                }
                else
                {
                    var func = searchCategories.Values.First() as Delegate;
                    var methodType = typeof(Func<,>).MakeGenericType(modelType, typeof(string));
                    var typedFunc = Delegate.CreateDelegate(methodType, func.Target, func.Method);
                    var filterMethod = this.GetType().GetMethod("FilterItems");
                    var genericFilterMethod = filterMethod.MakeGenericMethod(modelType);
                    var filteredList = genericFilterMethod.Invoke(this, new object[] { list, filterString, typedFunc });

                    foreach (var item in (System.Collections.IList)filteredList)
                    {
                        itemPanelCon.Controls.Add(CreatePanel(itemPanelCon, item));
                    }
                }
            }
            else
            {
                foreach (var item in list)
                {
                    itemPanelCon.Controls.Add(CreatePanel(itemPanelCon, item));
                }
            }

            if (this.Controls.Cast<Control>().FirstOrDefault(c => c.Name == "MostPopularM") is Label MostPopularM &&
                this.Controls.Cast<Control>().FirstOrDefault(c => c.Name == "TotalProfitY") is Label TotalProfitY &&
                this.Controls.Cast<Control>().FirstOrDefault(c => c.Name == "MostProfitM") is Label MostProfitM)
            {
                var data = MonthStatisticPanel.GetList().Where(m => m.NumberOfBookings > 0).ToList();
                if (data.Count > 0)
                {
                    var mostPopular = data.MaxBy(m => m.NumberOfBookings);
                    MostPopularM.Text = $"Legnépszerűbb hónap: {mostPopular.Month} ({mostPopular.NumberOfBookings} foglalás)";
                    int totalProfit = data.Sum(m => m.Profit);
                    TotalProfitY.Text = $"Év eddigi összes bevétele: {totalProfit} Ft";
                    var mostProfit = data.MaxBy(m => m.Profit);
                    MostProfitM.Text = $"Legjövedelmezőbb hónap: {mostProfit.Month}  ( {mostProfit.Profit} Ft)";
                    MostPopularM.Visible = true;
                    TotalProfitY.Visible = true;
                    MostProfitM.Visible = true;
                }
                else
                {
                    MostPopularM.Visible = false;
                    TotalProfitY.Visible = false;
                    MostProfitM.Visible = false;
                }

            }

            this.Visible = true;

            if (itemPanelCon.Controls.Count == 0)
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
                Headers[i].Location = new Point(points[i], 80);
                this.Controls.Add(Headers[i]);
            }
        }

        public override void ResizePanel()
        {
            Size = new Size(Main.Instance.ClientSize.Width, Main.Instance.ClientSize.Height - 50);
            itemPanelCon.Size = !hasSearchbar ? new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 100)) : new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 150));

            if (typeof(P) == typeof(EmployeePanel)) { itemPanelCon.Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 200)); }
            else if (typeof(P) == typeof(MonthStatisticPanel)) { itemPanelCon.Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 180)); }
            else { itemPanelCon.Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 150)); }

            if (this.Controls.Cast<Control>().FirstOrDefault(c => c.Name == "NewEmployeeButton") is Button employeeButton) employeeButton.Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 300, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5);

            if (this.Controls.Cast<Control>().FirstOrDefault(c => c.Name == "YearBox") is ComboBox cbYear &&
                this.Controls.Cast<Control>().FirstOrDefault(c => c.Name == "BeforeLabel") is Label lbYear)
            {
                cbYear.Location = new Point(itemPanelCon.Location.X + itemPanelCon.Width - 120, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5); ;
                lbYear.Location = new Point(cbYear.Location.X - lbYear.Size.Width - 5, cbYear.Location.Y + lbYear.Size.Height / 2); ;
            }
            if (this.Controls.Cast<Control>().FirstOrDefault(c => c.Name == "MostPopularM") is Label MostPopularM &&
                this.Controls.Cast<Control>().FirstOrDefault(c => c.Name == "TotalProfitY") is Label TotalProfitY &&
                this.Controls.Cast<Control>().FirstOrDefault(c => c.Name == "MostProfitM") is Label MostProfitM)
            {
                MostPopularM.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + 5);
                MostProfitM.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + MostPopularM.Height + 10);
                TotalProfitY.Location = new Point(itemPanelCon.Location.X, itemPanelCon.Location.Y + itemPanelCon.Size.Height + MostPopularM.Height + MostProfitM.Height + 15);

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
            else if (itemPanelCon.Controls.Count >= 1)
            {
                foreach (ItemPanel ItP in itemPanelCon.Controls)
                {
                    ItP.ResizePanel(itemPanelCon.Size);
                }
                DisplayHeaderTexts(((ItemPanel)itemPanelCon.Controls[0]).GetControlPositions());
            }
        }

        public P CreatePanel(params object[] args)
        {
            return (P)Activator.CreateInstance(typeof(P), args)!;
        }

        public List<T> FilterItems<T>(List<T> items, string term, Func<T, string> selector)
        {
            if (term == "") return items;

            return items
                .Where(item => selector(item).StartsWith(term, StringComparison.OrdinalIgnoreCase))
                .ToList();
        }

        void OpenHiringForm()
        {
            new AddEmployeeForm().ShowDialog();
        }
    }
}
