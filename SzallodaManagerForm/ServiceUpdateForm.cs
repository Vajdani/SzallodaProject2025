using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm
{
    public partial class ServiceUpdateForm : Form
    {
        public int ServiceID { get; private set; }
        List<InputRow>? InputFields;
        Label Title;
        Button CancelButton;
        Button SaveButton;

        public ServiceUpdateForm(string title, List<InputRow>? items = null)
        {
            InputFields = items;
            if (items != null) this.Size = new Size(600, 200 + items.Count * 75);
            else this.Size = new Size(400, 200);

            StartPosition = FormStartPosition.CenterParent;
            this.Resize += (s, e) => { ResizeForm(); };

            Title = new()
            {
                Text = title,
                AutoSize = true,
            };

            Title.Location = new Point((this.Size.Width - Title.Width) / 2, 20);

            CancelButton = new()
            {
                Text = "Elvet",
                Size = new Size(Convert.ToInt32(this.ClientSize.Width * 0.35), 50)
            };


            SaveButton = new()
            {
                Text = "Mentés",
                Size = new Size(Convert.ToInt32(this.ClientSize.Width * 0.35), 50)
            };

            SaveButton.Location = new Point((ClientSize.Width - CancelButton.Width - SaveButton.Width) / 3, this.ClientSize.Height - SaveButton.Height - 20);
            CancelButton.Location = new Point(((ClientSize.Width - CancelButton.Width - SaveButton.Width) / 3 * 2) + SaveButton.Width, this.ClientSize.Height - CancelButton.Height - 20);

            SaveButton.Click += SaveButtonClick;
            CancelButton.Click += CancelConfirmation;

            this.Controls.Add(Title);
            this.Controls.Add(CancelButton);
            this.Controls.Add(SaveButton);

            for (int i = 0; i < InputFields.Count; i++)
            {
                InputFields[i].UpdatePosition(this.ClientSize, (i + 1) * 50);
                InputFields[i].ApplyElements(this.Controls);
            }

            ResizeForm();
        }

        void ResizeForm()
        {
            Title.Location = new Point((this.ClientSize.Width - Title.Width) / 2, 10);

            SaveButton.Location = new Point((ClientSize.Width - CancelButton.Width - SaveButton.Width) / 3, this.ClientSize.Height - SaveButton.Height - 20);
            CancelButton.Location = new Point(((ClientSize.Width - CancelButton.Width - SaveButton.Width) / 3 * 2) + SaveButton.Width, this.ClientSize.Height - CancelButton.Height - 20);

            for (int i = 0; i < InputFields.Count; i++)
            {
                InputFields[i].UpdatePosition(this.ClientSize, i >= 1 ? (i + 1) * 50 + InputFields[i-1].BonusBottomSpacing : (i + 1) * 50);
                InputFields[i].ApplyElements(this.Controls);
            }
        }

        void CancelConfirmation(object sender, EventArgs e)
        {
            DialogResult dialog = MessageBox.Show("Biztos el akarod vetni?", "WARNING", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);
            if (dialog == DialogResult.Yes) Close();
        }

        protected virtual void SaveButtonClick(object sender, EventArgs e)
        {
            MessageBox.Show("Megnyomtaad");
        }
    }
}
