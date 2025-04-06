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
        Label lbPrice;
        Label lbStatus;
        Button btnComplete;
        
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

            lbStatus = new()
            {
                Text = Booking.status switch
                {
                    Booking.BookingStatus.RefundRequested => "Visszatérítés igényelve",
                    Booking.BookingStatus.Confirmed => "Megerősítve",
                    _ => throw new Exception("Invalid status")
                }
            };


            lbPrice = new()
            {
                Text = booking.totalPrice.ToString() + " Ft"
            };

            btnComplete = new()
            {
                Text = Booking.status switch
                {
                    Booking.BookingStatus.RefundRequested => "Visszafizetés",
                    Booking.BookingStatus.Confirmed => "Lezárás",
                    _ => throw new Exception("Invalid status")
                }
            };

            btnComplete.Click += (s, e) => {
                switch (Booking.status)
                {
                    case Booking.BookingStatus.RefundRequested: Booking.ChangeBookingStatus(Booking.BookingStatus.Cancelled); break;
                    case Booking.BookingStatus.Confirmed: Booking.ChangeBookingStatus(Booking.BookingStatus.Completed); break;
                }
                Main.current.UpdatePanel(Main.Instance.GetSelectedHotel());
            };


            this.Controls.Add(lbStartDate);
            this.Controls.Add(lbEndDate);
            this.Controls.Add(lbPrice);
            this.Controls.Add(lbStatus);
            this.Controls.Add(btnComplete);
            

            AlignElementsHorizontally();

        }

    }
}
