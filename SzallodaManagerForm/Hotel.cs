namespace SzallodaManagerForm
{
    internal class Hotel
    {
        private int hotel_id;
        public string Name { get; private set; }

        public static List<Hotel> userHotels = [];

        public Hotel(int id)
        {
            hotel_id = id;

            using Database DB = new($"select hotelName from hotel where hotel_id = {hotel_id}");
            DB.Read();

            Name = DB.GetString("hotelName");
        }

        public static void OnUserLogin(int user_id)
        {
            using Database hotelQuery = new($"select hotel_id, userType from employee where user_id = {user_id}");
            while (hotelQuery.Read())
            {
                userHotels.Add(new(hotelQuery.GetInt("hotel_id")));
            }
        }

        public static void OnUserLogout()
        {
            userHotels = [];
        }
    }
}
