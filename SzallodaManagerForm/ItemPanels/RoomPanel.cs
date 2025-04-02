using SzallodaManagerForm.Models;

namespace SzallodaManagerForm.ItemPanels
{
    internal class RoomPanel : ItemPanel
    {

        public Room Room { get; set; }
        public Label RoomNumber { get; private set; }
        public ComboBox Availability { get; private set; }
        public TextBox Price { get; private set; }

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
                MaxLength = 6,
                Text = room.PricePerNight.ToString(),
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
            Controls.Add(btnSave);

            AlignElementsHorizontally();
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
