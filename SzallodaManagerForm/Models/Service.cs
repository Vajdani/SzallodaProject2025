namespace SzallodaManagerForm.Models
{
    internal class Service
    {
        public int service_id { get; private set; }
        public int hotel_id { get; private set; }
        public string Name { get; private set; }
        public int Price { get; private set; }
        public bool Available { get; private set; }
        public bool AllYear { get; private set; }
        public DateTime StartDate;
        public DateTime EndDate;
        public TimeSpan OpenTime;
        public TimeSpan CloseTime;

        public Service(Database db)
        {
            service_id = db.GetInt("service_id");
            hotel_id = db.GetInt("hotel_id");
            Name = db.GetString("serviceName");
            Price = db.GetInt("price");
            Available = db.GetInt("available") == 1;
            AllYear = db.GetInt("allYear") == 1;

            StartDate = db.GetDateTime("startDate");
            EndDate = db.GetDateTime("endDate");
            OpenTime = db.GetTimeSpan("openTime");
            CloseTime = db.GetTimeSpan("closeTime");
        }

        public void UpdateService(int price, bool available, DateTime[]? dates, TimeSpan[]? times)
        {
            Price = price;
            Available = available;
            if (dates != null) {
                StartDate = dates[0]; 
                EndDate = dates[1];
                AllYear = false;
            }
            else { 
                StartDate = DateTime.MinValue;
                EndDate = DateTime.MinValue;
                AllYear= true;
            }
            if (times != null) { 
                OpenTime = times[0];
                CloseTime = times[1];
            }
            else { 
                OpenTime= TimeSpan.MinValue;
                CloseTime= TimeSpan.MinValue;
            }

            string q = $"UPDATE service SET " +
                $"price = {Price}, " +
                $"available = {(Available ? 1 : 0)}, " +
                $"allYear = {(AllYear ? 1 : 0)}, " +
                $"startDate = {(AllYear ? "NULL" : $"'{StartDate:yyyy-MM-dd}'")}, " +
                $"endDate = {(AllYear ? "NULL" : $"'{EndDate:yyyy-MM-dd}'")}, " +
                $"openTime = {(OpenTime == TimeSpan.Zero ? "'00:00:00'" : $"'{OpenTime:hh\\:mm\\:ss}'")}, " +
                $"closeTime = {(CloseTime == TimeSpan.Zero ? "'00:00:00'" : $"'{CloseTime:hh\\:mm\\:ss}'")} " +
                $"WHERE service_id = {this.service_id};";

            Database ab = new(q);
            ab.Close();

            MessageBox.Show("Sikeres módosítás!","Információ",MessageBoxButtons.OK,MessageBoxIcon.Information);
        }
    }
}
