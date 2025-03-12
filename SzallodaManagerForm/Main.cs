using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace SzallodaManagerForm
{
    public partial class Main : Form
    {

        internal User user;

        public Main()
        {
            InitializeComponent();
            
        }

        private void Main_Load(object sender, EventArgs e)
        {
            if (user == null)
            {
                MessageBox.Show("Nincs kiválasztott felhasználó, kérem jelentkezzen be újra", "HIBA", MessageBoxButtons.OK, MessageBoxIcon.Error);
                Close();
            }

            //Jogosultságnak megfelelő dolgok megjelenítése
            //Elérhető hotelek hozzáadása a comboboxhoz

            //cbHotelek.Items.Add
        }
    }
}
