using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm
{
    internal class StatisticData
    {
        public string Month { get; private set; }
        public int NumberOfBookings { get; private set; }
        public int Profit { get; private set; }

        public StatisticData(string month, int bookings, int profit) {

            Month = month;
            NumberOfBookings = bookings;
            Profit = profit;
        }
    }
}
