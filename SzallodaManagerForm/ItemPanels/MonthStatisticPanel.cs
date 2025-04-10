using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using SzallodaManagerForm.Models;

namespace SzallodaManagerForm.ItemPanels
{
    internal class MonthStatisticPanel : ItemPanel
    {
        public StatisticData StatisticData { get; private set; }
        Label MonthName;
        Label NumberOfBookings;
        Label TotalProfit;

        public MonthStatisticPanel(Panel parent, StatisticData stat) : base(parent)
        {
            StatisticData = stat;

            MonthName = new()
            {
                Text = StatisticData.Month,
                AutoSize = true,
            };

            NumberOfBookings = new()
            {
                Text = StatisticData.NumberOfBookings.ToString() + " db",
                AutoSize = true,
            };

            TotalProfit = new(){
                Text = StatisticData.Profit.ToString() + " Ft",
                AutoSize = true,
            };

            this.Controls.Add(MonthName);
            this.Controls.Add(NumberOfBookings);
            this.Controls.Add(TotalProfit);

            AlignElementsHorizontally();
        }
        public static new List<StatisticData> GetList() => Main.Instance.GetSelectedHotel().GetBookingStatistics(OptionPanel.selectedYear).Where(s => s.NumberOfBookings > 0).ToList();
        public static Type GetModelType() => typeof(StatisticData);
    }
}
