using SzallodaManagerForm.Models;

namespace SzallodaManagerForm.ItemPanels
{
    internal class RoomPanel : ItemPanel
    {

        public Room Room { get; set; }
        public Label RoomNumber { get; private set; }
        public ComboBox Availability { get; private set; }
        public TextBox Price { get; private set; }

        public static Dictionary<string, Delegate> SearchCategories { get; private set; } = new Dictionary<string, Delegate>()
        {
            {"Szoba", new Func<Room, string>(r => r.RoomNumber) },
            {"Állapot", new Func<Room, string>(r => r.Available ? "Elérhető" : "Nem elérhető") },
            {"Ár", new Func<Room, string>(r => r.PricePerNight.ToString()) },
        };


        Label AfterPriceLabel;
        Button btnSave;

        public RoomPanel(Panel parent, Room room) : base(parent)
        {
            Room = room;
            RoomNumber = new()
            {
                Text = room.RoomNumber,
                TextAlign = ContentAlignment.MiddleCenter
            };

            Availability = new()
            {
                Items = {
                    "Nem elérhető",
                    "Elérhető"
                },
                SelectedIndex = room.Available ? 1 : 0,
                DropDownStyle = ComboBoxStyle.DropDownList,
            };
            Availability.MouseWheel += (s, e) => { ((HandledMouseEventArgs)e).Handled = true; };

            Price = new()
            {
                Name = "Price",
                MaxLength = 6,
                Size = new Size(150, 40),
                Text = room.PricePerNight.ToString(),
            };

            AfterPriceLabel = new()
            {
                Text = "Ft",
                AutoSize = true,
            };

            btnSave = new()
            {
                Text = "Mentés",
                Size = new((int)Math.Round(Size.Width * 0.24), (int)Math.Round(Size.Height * 0.6))
            };
            btnSave.Click += SaveData;

            Controls.Add(RoomNumber);
            Controls.Add(Availability);
            Controls.Add(Price);
            Controls.Add(AfterPriceLabel);
            Controls.Add(btnSave);

            AlignElementsHorizontally();
        }

        public static new List<Room> GetList() => Main.Instance.GetSelectedHotel().Rooms;
        public static Type GetModelType() => typeof(Room);
        //public static Func<Room, string> GetSearchCategory(string key) => SearchCategories[key];

        public override void AlignElementsHorizontally(int sidePadding = 20)
        {
            var controls = Controls.Cast<Control>().Where(c => c != AfterPriceLabel).ToList();

            int width = Size.Width - sidePadding * 2;
            int totalWidth = controls.Sum(c => c.Size.Width);
            int gapSize = (int)Math.Round((double)(Size.Width - sidePadding * 2 - totalWidth) / controls.Count);
            int currentX = sidePadding;

            foreach (Control c in controls)
            {
                PositionElemenet(c, currentX);
                currentX = currentX + gapSize + c.Size.Width;
            }

            var priceBox = Controls.Cast<Control>().FirstOrDefault(c => c.Name == "Price" || c == Price);
            if (priceBox != null)
            {
                int x = priceBox.Location.X + priceBox.Width + 5;
                PositionElemenet(AfterPriceLabel, x);
            }
        }

        void SaveData(object? sender, EventArgs e)
        {
            if(!int.TryParse(Price.Text, out var price))
            {
                MessageBox.Show("Rossz ár adatot adott meg!", "Hiba!", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return;
            }

            Room.UpdateRoomData(price, Availability.SelectedIndex);
            MessageBox.Show("A mentés sikeres volt!", "Információ", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }
    }
}
