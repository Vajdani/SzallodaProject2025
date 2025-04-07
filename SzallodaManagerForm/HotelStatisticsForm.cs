namespace SzallodaManagerForm
{
    public partial class HotelStatisticsForm : Form
    {
        private static string[] Months = [
            "Január",
            "Február",
            "Március",
            "Április",
            "Május",
            "Június",
            "Július",
            "Augusztus",
            "Szeptember",
            "Október",
            "November",
            "December"
        ];

        string hotelName;
        public HotelStatisticsForm(string hname)
        {
            hotelName = hname;
            InitializeComponent();
        }

        public void Year()
        {
            cbevek.Items.Clear();
            string leker =
                $"select distinct year(b.bookStart) as ev from booking b " +
                $"inner join room r on b.room_id = r.room_id " +
                $"inner join hotel h on r.hotel_id = h.hotel_id " + 
                $" where h.hotelName like \"{hotelName}\" order by ev desc";

            using Database ab = new(leker);
            while (ab.Read())
            {
                cbevek.Items.Add(ab.GetString("ev"));
            }

            cbevek.SelectedIndex = 0;
        }

        public void LoadStatistics(int ev)
        {
            dgvadatok.Rows.Clear();

            //int jelenleg = DateTime.Now.Month;
            int evesosszeg = 0;
            int maxdb = 0;
            int maxft = 0;
            string maxfthonap = "";
            List<string> maxhonap = [];
            for (int i = 1; i < 13; i++)
            {
                string honap = i.ToString("D2");

                string leker =
                    $"select sum(b.totalPrice) as sum, count(b.booking_id) as db " +
                    $"from booking b " +
                    $"inner join room r on b.room_id = r.room_id " +
                    $"inner join hotel h on r.hotel_id = h.hotel_id " +
                    $"where b.bookStart like '{ev}-{honap}-__' " +
                    $"and h.hotelName like \"{hotelName}\"";
         
                Database ab = new(leker);
                ab.Read();
                int db = ab.GetInt("db");
                if (db == maxdb)
                {
                    maxhonap.Add(Months[i-1]);
                    maxdb = db;
                }
                else if (db > maxdb)
                {
                    maxhonap.Clear();
                    maxhonap.Add(Months[i - 1]);
                    maxdb = db;
                }

                int sum;
                if (db == 0)
                {
                    sum = 0;
                }
                else
                {
                    sum = ab.GetInt("sum");
                }

                if (sum != 0 && sum> maxft)
                {
                    maxft = sum;
                    maxfthonap = Months[i - 1];
                }

                evesosszeg += sum;
                dgvadatok.Rows.Add(Months[i - 1], db, sum + " Ft");
                ab.Close();
            }
  
            if (ev >= DateTime.Now.Year)
            {
                lbevsum.Text = $"Az év eddigi teljes bevétele: {evesosszeg} forint";
            }
            else if (ev < DateTime.Now.Year)
            {
                lbevsum.Text = $"Az év teljes bevétele: {evesosszeg} forint";
            }
            if (maxhonap.Count == 1)
            {
                lbpopular.Text = $"Legnépszerűbb hónap: {maxhonap[0]}, {maxdb} foglalással";
            }
            else {
                lbpopular.Text = $"Legnépszerűbb hónapok: ";
                foreach (var m in maxhonap)
                {
                    lbpopular.Text += m + ", ";   
                }
                lbpopular.Text += $" {maxdb} foglalással";
            }

            lbmax.Text = $"A legjövedelmezőbb hónap: {maxfthonap}, {maxft} forint jövedelemmel";
        }

        private void HotelStatistics_Load(object sender, EventArgs e)
        {
            lbHotel.Text = hotelName;
            LoadStatistics(DateTime.Now.Year);
            Year();
        }

        private void YearSelected(object sender, EventArgs e)
        {
            LoadStatistics(Convert.ToInt32(cbevek.SelectedItem));
        }
    }
}
