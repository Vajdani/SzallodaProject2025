namespace SzallodaManagerForm.Models
{
    internal class Room
    {
        public int room_id { get; private set; }
        public int hotel_id { get; private set; }
        public string RoomNumber { get; private set; }
        public int? Floor { get; private set; }
        public int Capacity { get; private set; }
        public int PricePerNight { get; private set; }
        public bool Reserved { get; private set; }

        public Room(Database db)
        {
            room_id = db.GetInt("room_id");
            hotel_id = db.GetInt("hotel_id");
            RoomNumber = db.GetString("roomNumber");
            Floor = db.GetInt("floor");
            Capacity = db.GetInt("capacity");
            PricePerNight = db.GetInt("pricepernight");
            Reserved = db.GetInt("reserved") == 1;
        }
    }
}
