namespace SzallodaManagerForm
{
    internal class Hotel
    {
        private int hotel_id;
        public string Name { get; private set; }
        public int city_id { get; private set; }
        public string Address { get; private set; }
        public string PhoneNumber { get; private set; }
        public string Email { get; private set; }

        public static List<Hotel> userHotels = [];

        public Hotel(int id)
        {
            hotel_id = id;

            using Database DB = new($"select * from hotel where hotel_id = {hotel_id}");
            DB.Read();

            city_id = DB.GetInt("city_id");
            Name = DB.GetString("hotelName");
            Address = DB.GetString("address");
            PhoneNumber = DB.GetString("phoneNumber");
            Email = DB.GetString("email");
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

        public static Hotel? GetHotelByName(string name)
        {
            if (userHotels.Count == 0)
            {
                throw new Exception("User hotels list has not been initialised!");
            }

            return userHotels.First(h => h.Name == name);
        }

        public static Hotel? GetHotelById(int hotel_id)
        {
            if (userHotels.Count == 0)
            {
                throw new Exception("User hotels list has not been initialised!");
            }

            return userHotels.First(h => h.hotel_id == hotel_id);
        }
    }
}
