namespace SzallodaManagerForm.Models
{
    class Hotel
    {
        public int hotel_id;
        public string Name { get; private set; }
        public int city_id { get; private set; }
        public string Address { get; private set; }
        public string PhoneNumber { get; private set; }
        public string Email { get; private set; }

        public List<Room> Rooms { get; private set; } = [];
        public List<Service> Services { get; private set; } = [];
        public List<Employee> Employees { get; private set; } = [];


        public static List<Hotel> userHotels = [];

        public Hotel(Database DB, params object?[] args)
        {
            hotel_id    = DB.GetInt("hotel_id");
            city_id     = DB.GetInt("city_id");
            Name        = DB.GetString("hotelName");
            Address     = DB.GetString("address");
            PhoneNumber = DB.GetString("phoneNumber");
            Email       = DB.GetString("email");

            if ((args![0] as Dictionary<int, List<Room>>)!.TryGetValue(hotel_id, out List<Room>? rooms))
            {
                Rooms = rooms;
            }

            if ((args![1] as Dictionary<int, List<Service>>)!.TryGetValue(hotel_id, out List<Service>? services))
            {
                Services = services;
            }

            if ((args![2] as Dictionary<int, List<Employee>>)!.TryGetValue(hotel_id, out List<Employee>? employees))
            {
                Employees = employees;
            }
        }

        public static void OnUserLogin(int user_id)
        {
            var rooms = Database.ReadAll<Room>($"select * from room").GroupBy(r => r.hotel_id).ToDictionary(r => r.Key, r => r.ToList());
            
            var services = Database.ReadAll<Service>(
                "select service.service_id, service.hotel_id, servicecategory.serviceName, service.price, service.available, service.allYear," +
                "service.startDate, service.endDate, service.openTime, service.closeTime " +
                "from service, servicecategory " +
                $"where service.category_id = servicecategory.serviceCategory_id"
            ).GroupBy(s => s.hotel_id).ToDictionary(s => s.Key, s => s.ToList());

            var employees = Database.ReadAll<Employee>(
                "select user.user_id, user.username, employee.hotel_id, employee.userType " +
                "from employee, user " +
                "where user.user_id = employee.user_id and (" +
                    $"(select e.userType from employee e where e.user_id = {user_id} and e.hotel_id = employee.hotel_id) = 'manager' and " +
                    "employee.userType not in ('owner', 'manager') or " +
                    $"(select e.userType from employee e where e.user_id = {user_id} and e.hotel_id = employee.hotel_id) = 'owner' and " +
                    "employee.userType <> 'owner'" +
                ")"
            ).GroupBy(r => r.hotel_id).ToDictionary(r => r.Key, r => r.ToList());

            userHotels = Database.ReadAllWithArgs<Hotel>(
                "select hotel.hotel_id, hotel.city_id, hotel.hotelName, hotel.address, hotel.phoneNumber, hotel.email, hotel.description " +
                "from hotel, employee " +
                $"where hotel.hotel_id = employee.hotel_id and employee.user_id = {user_id};",
                rooms, services, employees
            );
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
