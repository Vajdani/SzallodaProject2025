using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using SzallodaManagerForm.Models;
using SzallodaManagerForm.ItemPanels;

namespace SzallodaManagerForm
{
    internal class UsersPanel : Panel
    {
        Panel itemPanelCon;
        Label lbSearch;
        TextBox tbSearchbox;
        public static UsersPanel? Instance { get; private set; }

        public UsersPanel() 
        {
            Instance = this;
            Size = new Size(Main.Instance.ClientSize.Width, Main.Instance.ClientSize.Height - 100);
            Location = new Point(0, 100);
            Visible = true;

            lbSearch = new()
            {
                Text = "Keresés",
                Location = new(20, 15),
            };

            tbSearchbox = new()
            {
                Location = new(lbSearch.Location.X + lbSearch.ClientSize.Width + 10, 10),
                Size = new(150, Size.Height)
            };
            tbSearchbox.TextChanged += (s, e) => { UpdatePanel(tbSearchbox.Text); };

            itemPanelCon = new Panel
            {
                BackColor = Color.Red,
                Size = new Size(Size.Width - 20, (Main.Instance.ClientSize.Height - 200)),
                Location = new Point(10, 50),
                AutoScroll = true
            };
            Controls.Add(itemPanelCon);
            Controls.Add(lbSearch);
            Controls.Add(tbSearchbox);
        }

        public void UpdatePanel(string name = "")
        {
            itemPanelCon.Controls.Clear();

            var Users = Database.ReadAll<Models.BaseUser>($"SELECT user_id, username, firstName, lastName FROM user WHERE user_id NOT IN (SELECT user_id FROM employee WHERE hotel_id = {Main.Instance.GetSelectedHotelId()}) and username like '{name}%';");
            foreach (BaseUser user in Users)
            {
                itemPanelCon.Controls.Add(new NewEmployeePanel(itemPanelCon, user));
            }

        }


        public void ResizePanel(Size size)
        {
            Size = new Size(size.Width, size.Height - 100);
            itemPanelCon.Size = new Size(Size.Width - 20, (size.Height - 200));

            foreach (ItemPanel ItP in itemPanelCon.Controls)
            {
                ItP.ResizePanel(itemPanelCon.Size);
            }
        }

    }
}
