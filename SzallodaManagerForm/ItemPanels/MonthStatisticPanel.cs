using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm.ItemPanels
{
    internal class MonthStatisticPanel : ItemPanel
    {
        Label MonthName;
        Label NumberOfBookings;
        Label TotalProfit;

        public MonthStatisticPanel(Panel parent, string month, int bookings, int profit) : base(parent)
        {
            MonthName = new()
            {
                Text = month,
                AutoSize = true,
            };

            NumberOfBookings = new()
            {
                Text = bookings.ToString() + " db",
                AutoSize = true,
            };

            TotalProfit = new(){
                Text = profit.ToString() + " Ft",
                AutoSize = true,
            };

            this.Controls.Add(MonthName);
            this.Controls.Add(NumberOfBookings);
            this.Controls.Add(TotalProfit);

            AlignElementsHorizontally();
        }
    }
}
