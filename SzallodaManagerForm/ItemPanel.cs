using SzallodaManagerForm.Models;

namespace SzallodaManagerForm
{
    internal class ItemPanel : Panel
    {
        public int ItemID { get; private set; } 
        public ItemPanel(Panel parent, int verticalPadding = 10)
        {
            ResizePanel(parent.Size);
            Location = new Point(10, (50 + verticalPadding) * parent.Controls.Count);
            BackColor = Color.Aqua;
            Visible = true;
        }

        public void ResizePanel(Size parentSize)
        {
            Size = new Size(Convert.ToInt32(Math.Floor(parentSize.Width * 0.95)), 50);
        }

        public void PositionElemenet(Control control, int position)
        {
            control.Location = new Point(position, (Size.Height - control.Size.Height) / 2);
        }

        public void AlignElementsHorizontally(int sidePadding = 20)
        {
            var controls = Controls.Cast<Control>().ToList();

            int width = Size.Width - sidePadding * 2;
            int totalWidth = controls.Sum(c => c.Size.Width);
            int gapSize = (int)Math.Round((double)(Size.Width - sidePadding * 2 - totalWidth) / controls.Count);
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

        public EmployeePanel(Panel parent, Employee employee) : base(parent)
        {
            lbUsername = new()
            {
                Text = employee.username
            };

            lbUserType = new()
            { 
                Text = User.GetAuthorityLevelName(employee.AuthorityLevel)
            };

            btnEdit = new Button();
            btnEdit.Click += OpenEditForm;
        }

        void OpenEditForm(object? sender, EventArgs e)
        {
            //Alkalmazott adatok form, ha lesz
        }
    }

    internal class RoomPanel : ItemPanel
    { 
        public Label RoomNumber { get; private set; }
        public ComboBox Availability { get; private set; }
        public TextBox Price { get; private set; }

        Button btnSave;

        public RoomPanel(Panel parent, Room room) : base(parent)
        {
            RoomNumber = new() { 
                Text = room.RoomNumber,
                TextAlign = ContentAlignment.MiddleCenter
            };

            Availability = new() { 
                Enabled = !room.Reserved,
                Items = {
                    "Elérhető",
                    "Nem elérhető"
                },
                SelectedIndex = 0
            };

            Price = new() {
                MaxLength = 6,
                Text = room.PricePerNight.ToString(),
                Enabled = !room.Reserved
            };

            btnSave = new() { 
                Text = "Mentés",
                Size = new((int)Math.Round(Size.Width * 0.24), (int)Math.Round(Size.Height * 0.6))
            };
            btnSave.Click += SaveData;

            Controls.Add(RoomNumber);
            Controls.Add(Availability);
            Controls.Add(Price);
            Controls.Add(btnSave);

            AlignElementsHorizontally();
        }

        void SaveData(object? sender, EventArgs e)
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

        public ServicePanel(Panel parent, Service service) : base(parent)
        {
            serviceName = new Label
            {
                Text = service.Name,
                TextAlign = ContentAlignment.MiddleCenter
            };

            Availability = new Label();
            if(service.Available)
            {
                Availability.Text = "Elérhető";
                Availability.ForeColor = Color.Green;
            }
            else
            {
                Availability.Text = "Nem elérhető";
                Availability.ForeColor = Color.DarkRed;
            }

            btnEdit = new Button
            {
                Text = "Módosítás",
                Size = new((int)Math.Round(Size.Width * 0.24), (int)Math.Round(Size.Height * 0.6))
            };
            btnEdit.Click += OpenEditForm;

            Controls.Add(serviceName);
            Controls.Add(Availability);
            Controls.Add(btnEdit);

            AlignElementsHorizontally();
        }

        void OpenEditForm(object? sender, EventArgs e)
        {
            //Szolgáltatás adatok form, ha lesz
        }
    }
}
