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
        List<InputRow> InputFields;

        public UpdateForm()
        {
            this.Size = new Size(400, 600);

            InputFields = new List<InputRow>();
            InputFields.Add(new ComboBoxRow("AAAAA", ["Alma", "Körte", "Teto"]));
            InputFields.Add(new TextBoxRow("BBBB"));
            InputFields.Add(new TextBoxRow("CCCCC", true));
            InputFields.Add(new TimePickerRow("Elérhetőség", TimePickerRow.PickMethod.Day));
            InputFields.Add(new TimePickerRow("Nyitás", TimePickerRow.PickMethod.Time));

            for (int i = 0; i < InputFields.Count; i++)
            {
                InputFields[i].UpdatePosition(this.Size, (i+1) * 40);
                InputFields[i].ApplyElements(this.Controls);
            }
        }

        void Load(EventArgs e)
        {

        }


    }
}
