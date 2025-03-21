﻿using SzallodaManagerForm.Models;

namespace SzallodaManagerForm.ItemPanels
{
    internal class RoomPanel : ItemPanel
    {
        public Label RoomNumber { get; private set; }
        public ComboBox Availability { get; private set; }
        public TextBox Price { get; private set; }

        Button btnSave;

        public RoomPanel(Panel parent, Room room) : base(parent)
        {
            RoomNumber = new()
            {
                Text = room.RoomNumber,
                TextAlign = ContentAlignment.MiddleCenter
            };

            Availability = new()
            {
                Enabled = !room.Reserved,
                Items = {
                    "Elérhető",
                    "Nem elérhető"
                },
                SelectedIndex = 0
            };

            Price = new()
            {
                MaxLength = 6,
                Text = room.PricePerNight.ToString(),
                Enabled = !room.Reserved
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
            // Nem falfejelős tryparse price-ra

            //Adatok feltöltése
        }
    }
}
