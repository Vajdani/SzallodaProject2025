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

        public void year()
        {
            cbevek.Items.Clear();
            string leker = $"select distinct year(b.bookStart) as ev from booking b " +
                    $"inner join room r on b.room_id = r.room_id " +
                    $"inner join hotel h on r.hotel_id = h.hotel_id " + 
                    $" where h.hotelName like \"{hotelname}\" order by ev desc";
            Database ab = new Database(leker);
            while (ab.Read())
            {
                cbevek.Items.Add(ab.Reader["ev"].ToString());
            }
            cbevek.SelectedIndex = 0;
        }

        public void load(int ev)
        {
            dgvadatok.Rows.Clear();
            string[] honapok = ["Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December"];

            //int jelenleg = DateTime.Now.Month;
            int evesosszeg = 0;
            int maxdb = 0;
            int maxft = 0;
            string maxfthonap = "";
            List<string> maxhonap = new List<string>();
            for (int i = 1; i < 13; i++)
            {
                string honap = i.ToString("D2");

                string leker = $"select sum(b.totalPrice) as sum,Count(b.booking_id) as db " +
                    $"from booking b " +
                    $"inner join room r on b.room_id = r.room_id " +
                    $"inner join hotel h on r.hotel_id = h.hotel_id " +
                    $"where b.bookStart like '{ev}-{honap}-__' " +
                    $"and h.hotelName like \"{hotelname}\"";
         
                Database ab = new Database(leker);
                ab.Read();
                string sum = "";
                if (ab.Reader["db"].ToString() == "0")
                {
                    sum = "0";
                }
                else
                {
                    sum = ab.Reader["sum"].ToString();
                }
                
                if (Convert.ToInt32(ab.Reader["db"]) == maxdb)
                {
                    maxhonap.Add(honapok[i-1]);
                    maxdb = Convert.ToInt32(ab.Reader["db"]);
                }
                else if (Convert.ToInt32(ab.Reader["db"]) > maxdb)
                {
                    maxhonap.Clear();
                    maxhonap.Add(honapok[i - 1]);
                    maxdb = Convert.ToInt32(ab.Reader["db"]);
                }
                if (!Convert.IsDBNull(ab.Reader["sum"]))
                {
                    int current = Convert.ToInt32(ab.Reader["sum"]);
                    if (current > maxft)
                    {
                        maxft = Convert.ToInt32(ab.Reader["sum"]);
                        maxfthonap = honapok[i - 1];
                    }
                }
                evesosszeg += Convert.ToInt32(sum);
                dgvadatok.Rows.Add(honapok[i - 1], ab.Reader["db"], sum + " Ft");
                ab.Close();
            }
  
            if (ev >= DateTime.Now.Year)
            {
                lbevsum.Text = "Az év eddigi teljes bevétele: " + evesosszeg+" forint";
            }
            else if (ev < DateTime.Now.Year)
            {
                lbevsum.Text = "Az év teljes bevétele: " + evesosszeg +" forint";
            }
            if (maxhonap.Count() == 1)
            {
                lbpopular.Text = $"Legnépszerűbb hónap: {maxhonap[0]}, {maxdb} foglalással";
            }
            else {
                lbpopular.Text = $"Legnépszerűbb hónapok: ";
                foreach (var m in maxhonap)
                {
                    lbpopular.Text = lbpopular.Text + m+", ";   
                }
                lbpopular.Text = lbpopular.Text + $" {maxdb} foglalással";
            }

            lbmax.Text = $"A legjövedelmezőbb hónap: {maxfthonap}, {maxft} forint jövedelemmel";
  
        }

        private void hotelstat_Load(object sender, EventArgs e)
        {
           
            lbHotel.Text = hotelname;
            load(DateTime.Now.Year);
            year();
        }

        private void cbevek_SelectedIndexChanged(object sender, EventArgs e)
        {
            int ev = Convert.ToInt32(cbevek.SelectedItem);
            load(ev);
        }
    }
}
