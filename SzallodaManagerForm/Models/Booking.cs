﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm.Models
{
    internal class Booking
    {
        public enum BookingStatus
        {
            Confirmed,
            Cancelled,
            Completed,
            RefundRequested
        }
        public int hotel_id { get; private set; }
        public int booking_id { get; private set; }
        public DateTime bookStart { get; private set; }
        public DateTime bookEnd { get; private set; }
        public int totalPrice { get; private set; }
        public BookingStatus status { get; private set; }

        public Booking(Database DB)
        {
            hotel_id = DB.GetInt("hotel_id");
            booking_id = DB.GetInt("booking_id");
            bookStart = DB.GetDateTime("bookStart");
            bookEnd = DB.GetDateTime("bookEnd");
            totalPrice = DB.GetInt("totalPrice");
            status = GetBookingStatus(DB.GetString("status"));

        }

        public BookingStatus GetBookingStatus(string status)
        {
            return status switch
            {
                "confirmed" => BookingStatus.Confirmed,
                "cancelled" => BookingStatus.Cancelled,
                "completed" => BookingStatus.Completed,
                "refund requested" => BookingStatus.RefundRequested,
                _ => throw new Exception("Invialid booking status.")
            };
        }

        public string GetBookingStatusName(BookingStatus status) {
            return status switch
            {
                BookingStatus.Confirmed => "confirmed",
                BookingStatus.Cancelled => "cancelled",
                BookingStatus.Completed => "completed",
                BookingStatus.RefundRequested => "refund requested",
                _ => throw new Exception("Invalid status")
            };
        }



    }
}
