using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using SzallodaManagerForm.Models;
using static SzallodaManagerForm.Models.User;

namespace SzallodaManagerForm.ItemPanels
{
    internal class BookingPanel : ItemPanel
    {
        public Booking Booking { get; private set; }

        Label lbStartDate;
        Label lbEndDate;
        ComboBox cbStatus;
        TextBox tbPrice;

        public BookingPanel(Panel parent, Booking booking) : base(parent) {

            Booking = booking;

            lbStartDate = new()
            {
                Text = Booking.bookStart.ToString(),
            };

            lbEndDate = new()
            {
                Text = Booking.bookEnd.ToString(),
            };

            cbStatus = new()
            {
                Items =
                {
                    "Megerősítve",
                    "Megszakítva",
                    "Kész",
                    "Visszafizetés igényelve"
                },
                DropDownStyle = ComboBoxStyle.DropDownList,
                SelectedIndex = (int)booking.status
            };
            cbStatus.MouseWheel += (s, e) => { ((HandledMouseEventArgs)e).Handled = true; };

            tbPrice = new()
            {
                Text = booking.totalPrice.ToString(),
            };


            this.Controls.Add(lbStartDate);
            this.Controls.Add(lbEndDate);
            this.Controls.Add(cbStatus);
            this.Controls.Add(tbPrice);

            AlignElementsHorizontally();

        }

    }
}
