using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using SzallodaManagerForm.Models;

namespace SzallodaManagerForm

{
    public partial class hotelstat : Form
    {
        string hotelname;
        public hotelstat(string hname)
        {
            hotelname = hname;
            InitializeComponent();
        }

        public void load()
        {
            dgvadatok.Rows.Clear();
            string[] honapok = ["Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December"];
       
            
            for(int i = 1; i < 13; i++) { 
            
                string leker = $"select sum(b.totalPrice) as sum,Count(b.booking_id) as db " +
                    $"from booking b " +
                    $"inner join room r on b.room_id = r.room_id " +
                    $"inner join hotel h on r.hotel_id = h.hotel_id " +
                    $"where b.bookStart like '____-%{i}-__' " +
                    $"and h.hotelName like \"{hotelname}\"";
                Database ab = new Database(leker);
                ab.Read();
                string sum = "";
                if (ab.Reader["db"].ToString() =="0")
                {
                    sum = "0";
                }
                else
                {
                    sum = ab.Reader["sum"].ToString();
                }
                dgvadatok.Rows.Add(honapok[i-1], ab.Reader["db"], sum+" Ft");
            }
        }

        private void hotelstat_Load(object sender, EventArgs e)
        {
            lbHotel.Text = hotelname;
            load();
        }
    }
}
