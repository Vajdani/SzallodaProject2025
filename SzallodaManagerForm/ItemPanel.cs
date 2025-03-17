using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using static System.Windows.Forms.VisualStyles.VisualStyleElement.TextBox;

namespace SzallodaManagerForm
{
    internal class ItemPanel : Panel
    {
        private Label lbDisplayName;
        private Button btnEdit;

        public ItemPanel(Size parent)
        {

            this.Size = new Size(Convert.ToInt32(Math.Floor(parent.Width*0.95)), 50);
            this.Location = new Point(10, 50);
            this.BackColor = Color.Aqua;
            this.Visible = true;

            lbDisplayName = new Label();
            lbDisplayName.Location = new Point(30, (this.Size.Height / 2)-(lbDisplayName.Height / 2));

            btnEdit = new Button();
            btnEdit.Text = "Módosítás";
            btnEdit.Location = new Point(650, (this.Size.Height / 2)-(btnEdit.Height / 2));
            btnEdit.Click += ButtonClick;

            this.Controls.Add(lbDisplayName);
            this.Controls.Add(btnEdit);
        }

        public void ResizePanel(Size parentSize)
        {
            this.Size = new Size(Convert.ToInt32(Math.Floor(parentSize.Width * 0.95)), 50);
        }

        private void ButtonClick(object sender, EventArgs e)
        {
            
        }

        public void ChangeText(string aaa)
        {
            lbDisplayName.Text = aaa;
        }
    }

    internal class EmployeePanel : ItemPanel
    {
        Label lbUsername;
        Label lbUserType;
        Button btnEdit;

        public EmployeePanel(Size parentSize) : base(parentSize)
        {
            lbUsername = new Label();
            lbUserType = new Label();

            btnEdit = new Button();
            btnEdit.Click += OpenEditForm;
        }

        void OpenEditForm(object sender, EventArgs e)
        {
            //Alkalmazott adatok form, ha lesz
        }
    }

    internal class RoomPanel : ItemPanel
    {
        Label roomNumber;
        ComboBox Availability;
        TextBox Price;

        bool isTaken = false;

        Button btnSave;

        public RoomPanel(Size parentSize) : base(parentSize)
        {
            roomNumber = new Label();

            Availability = new ComboBox();

            Price = new TextBox();
            Price.MaxLength = 6;

            btnSave = new Button();
            btnSave.Click += SaveData;
        }

        void SaveData(object sender, EventArgs e)
        {
            // Nem falfejelős tryparse price-ra

            //Adatok feltöltése
        }
    }

    internal class ServicePanel : ItemPanel
    {

        Label serviceName;
        Label Availability;

        Button btnEdit;

        public ServicePanel(Size parentSize, string servName, bool isAvaible) : base(parentSize)
        {
            serviceName = new Label();


            Availability = new Label();
            if(isAvaible)
            {
                Availability.Text = "Elérhető";
                Availability.ForeColor = Color.Green;
            }
            else
            {
                Availability.Text = "Nem elérhető";
                Availability.ForeColor = Color.DarkRed;
            }

            btnEdit = new Button();
            btnEdit.Click += OpenEditForm;
        }

        void OpenEditForm(object sender, EventArgs e)
        {
            //Szolgáltatás adatok form, ha lesz
        }
    }
}
