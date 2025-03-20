namespace SzallodaManagerForm.Models
{
    internal class Service
    {
        public int service_id { get; private set; }
        public int hotel_id { get; private set; }
        public int CategoryName { get; private set; }
        public int Price { get; private set; }
        public bool Available { get; private set; }
        public bool AllYear { get; private set; }
        public DateTime? StartDate { get; private set; }
        public DateTime? EndDate { get; private set; }
        public DateTime? OpenDate { get; private set; }
        public DateTime? CloseDate { get; private set; }

        public Service(Database db)
        {
            service_id = db.GetInt("service_id");
            hotel_id = db.GetInt("hotel_id");
            CategoryName = db.GetInt("categoryName");
            Price = db.GetInt("price");
            Available = db.GetInt("available") == 1;
            AllYear = db.GetInt("allYear") == 1;

            string startDate = db.GetString("startDate");
            if (startDate != "")
            {
                StartDate = Convert.ToDateTime(startDate);
            }

            string endDate = db.GetString("endDate");
            if (endDate != "")
            {
                EndDate = Convert.ToDateTime(endDate);
            }

            string openDate = db.GetString("openDate");
            if (openDate != "")
            {
                OpenDate = Convert.ToDateTime(openDate);
            }

            string closeDate = db.GetString("closeDate");
            if (closeDate != "")
            {
                CloseDate = Convert.ToDateTime(closeDate);
            }

        }
    }
}
