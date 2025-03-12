using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm
{
    internal class User
    {

        private int userID;
        private List<Hotel> hotels;
        private TimeOnly lastActivity;
        
        
        public User(int ID, List<Hotel> hotels)
        {
            this.userID = ID;
            this.hotels = hotels;
        }
    }
}
