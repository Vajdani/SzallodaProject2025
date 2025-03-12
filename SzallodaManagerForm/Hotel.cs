using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm
{
    internal class Hotel
    {
        public enum AuthorityLevel
        {
            Employee,
            Owner
        }

        private int hotelID;
        private AuthorityLevel userAuth;

        public string Name { get; private set; }


        public Hotel(int id, AuthorityLevel auth)
        {
            hotelID = id;
            userAuth = auth;

            Database DB = new($"select hotelName from hotel where hotel_id = {hotelID}");
            DB.Dr.Read();

            this.Name = DB.Dr["hotelName"].ToString();
        }

    }
}
