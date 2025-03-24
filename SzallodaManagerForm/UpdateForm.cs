using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm
{
    public partial class UpdateForm : Form
    {
        public int ServiceID { get; private set; }
        List<InputRow>? InputFields;
        Label Title;
        Button CancelButton;
        Button SaveButton;

        public UpdateForm(string title, List<InputRow>? items = null)
        {
            InputFields = items;
            if (items != null) this.Size = new Size(400, 200 + items.Count * 50);
            else this.Size = new Size(400, 200);

            Title = new()
            {
                Text = title,
            };

            Title.Location = new Point((this.Size.Width - Title.Width) / 2, 20);

            CancelButton = new()
            {
                Text = "Elvet",
                Size = new Size(Convert.ToInt32(this.Size.Width * 0.35), 50)
            };


            SaveButton = new()
            {
                Text = "Mentés",
                Size = new Size(Convert.ToInt32(this.Size.Width * 0.35), 50)
            };

            SaveButton.Location = new Point((Size.Width - CancelButton.Width - SaveButton.Width) / 3, Convert.ToInt32(this.Size.Height * 0.7 - SaveButton.Height / 2));
            CancelButton.Location = new Point(((Size.Width - CancelButton.Width - SaveButton.Width) / 3 * 2) + SaveButton.Width, Convert.ToInt32(this.Size.Height * 0.7 - CancelButton.Height / 2));

            SaveButton.Click += SaveButtonClick;
            CancelButton.Click += CancelConfirmation;

            this.Controls.Add(Title);
            this.Controls.Add(CancelButton);
            this.Controls.Add(SaveButton);

            for (int i = 0; i < InputFields.Count; i++)
            {
                InputFields[i].UpdatePosition(this.Size, (i + 1) * 50);
                InputFields[i].ApplyElements(this.Controls);
            }
        }

        void CancelConfirmation(object sender, EventArgs e)
        {
            DialogResult dialog = MessageBox.Show("Biztos el akarod vetni ezt a szart?", "WARNING", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);
            if (dialog == DialogResult.Yes) Close();
        }

        protected virtual void SaveButtonClick(object sender, EventArgs e)
        {
            MessageBox.Show("Megnyomtaad");
        }
    }

    class UpdateService : UpdateForm
    {
        public UpdateService(List<InputRow> inputs) : base("Szolgáltatás módosítása", inputs)
        {
            
        }
    }

    class UpdateEmployee : UpdateForm
    {
        public UpdateEmployee(List<InputRow> inputs) : base("Szolgáltatás módosítása", inputs)
        {

        }
    }
}
