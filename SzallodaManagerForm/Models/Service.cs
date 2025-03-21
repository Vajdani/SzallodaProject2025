﻿namespace SzallodaManagerForm.Models
{
    internal class Service
    {
        public int service_id { get; private set; }
        public int hotel_id { get; private set; }
        public string Name { get; private set; }
        public int Price { get; private set; }
        public bool Available { get; private set; }
        public bool AllYear { get; private set; }
        public DateTime? StartDate;
        public DateTime? EndDate;
        public TimeSpan? OpenTime;
        public TimeSpan? CloseTime;

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
    }
}
