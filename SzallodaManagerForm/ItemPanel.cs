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
        public int ItemID { get; private set; } 
        public ItemPanel(Size parent)
        {

            this.Size = new Size(Convert.ToInt32(Math.Floor(parent.Width * 0.95)), 50);
            this.Location = new Point(10, 50);
            this.BackColor = Color.Aqua;
            this.Visible = true;
        }

        public void ResizePanel(Size parentSize)
        {
            this.Size = new Size(Convert.ToInt32(Math.Floor(parentSize.Width * 0.95)), 50);
        }

        public void PositionElemenet(Control control, int position)
        {
            control.Location = new Point(position, (this.Size.Height/2)-(control.Size.Height/2));
        }

        public void PositionElementsEvenly(List<Control> controls, int sidePadding = 20)
        {
            int width = this.Size.Width-sidePadding*2;
            int elementWidth = controls.Sum(c => c.Size.Width);
            int gapSize = (int)Math.Round((double)((this.Size.Width - sidePadding * 2) - controls.Sum(c => c.Size.Width))/controls.Count);
            int currentX = sidePadding;

            foreach (Control c in controls)
            {
                PositionElemenet(c, currentX);
                currentX = currentX + gapSize + c.Size.Width;
            }

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
        public Label RoomNumber { get; private set; }
        public ComboBox Availability { get; private set; }
        public TextBox Price { get; private set; }

        bool isTaken = false;

        Button btnSave;

        public RoomPanel(Size parentSize, int roomNumber, int price, bool isOccupied) : base(parentSize)
        {
            RoomNumber = new Label();
            RoomNumber.Text = roomNumber.ToString();
            RoomNumber.TextAlign = ContentAlignment.MiddleCenter;

            Availability = new ComboBox();
            Availability.Enabled = !isOccupied;


            Price = new TextBox();
            Price.MaxLength = 6;
            Price.Text = price.ToString();
            Price.Enabled = !isOccupied;

            btnSave = new Button();
            btnSave.Text = "Mentés";
            btnSave.Size = new((int)Math.Round(this.Size.Width * 0.24), (int)Math.Round(this.Size.Height * 0.6));
            btnSave.Click += SaveData;

            PositionElementsEvenly(new() { RoomNumber, Availability, Price, btnSave });
            this.Controls.Add(RoomNumber);
            this.Controls.Add(Availability);
            this.Controls.Add(Price);
            this.Controls.Add(btnSave);
        }

        void SaveData(object sender, EventArgs e)
        {
            // Nem falfejelős tryparse price-ra

            //Adatok feltöltése
        }
    }

    internal class ServicePanel : ItemPanel
    {

        public Label serviceName { get; private set; }
        public Label Availability { get; private set; }
        Button btnEdit;

        public ServicePanel(Size parentSize, string servName, bool isAvaible) : base(parentSize)
        {
            serviceName = new Label();
            serviceName.Text = servName.ToString();
            serviceName.TextAlign = ContentAlignment.MiddleCenter;

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
            btnEdit.Text = "Módosítás";
            btnEdit.Size = new((int)Math.Round(this.Size.Width * 0.24), (int)Math.Round(this.Size.Height * 0.6));

            PositionElementsEvenly(new() { serviceName, Availability, btnEdit});
            this.Controls.Add(serviceName);
            this.Controls.Add(Availability);
            this.Controls.Add(btnEdit);


            btnEdit = new Button();
            btnEdit.Click += OpenEditForm;
        }

        void OpenEditForm(object sender, EventArgs e)
        {
            //Szolgáltatás adatok form, ha lesz
        }
    }
}
