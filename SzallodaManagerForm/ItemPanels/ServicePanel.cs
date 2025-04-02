using SzallodaManagerForm.Models;

namespace SzallodaManagerForm.ItemPanels
{
    internal class ServicePanel : ItemPanel
    {

        Service service;
        public Label serviceName { get; private set; }
        public Label Availability { get; private set; }
        Button btnEdit;

        public ServicePanel(Panel parent, Service service) : base(parent)
        {

            this.service = service; 

            serviceName = new Label
            {
                Text = service.Name,
                TextAlign = ContentAlignment.MiddleCenter
            };

            Availability = new Label();
            if (service.Available)
            {
                Availability.Text = "Elérhető";
                Availability.ForeColor = Color.Green;
            }
            else
            {
                Availability.Text = "Nem elérhető";
                Availability.ForeColor = Color.DarkRed;
            }

            btnEdit = new Button
            {
                Text = "Módosítás",
                Size = new((int)Math.Round(Size.Width * 0.24), (int)Math.Round(Size.Height * 0.6))
            };
            btnEdit.Click += OpenEditForm;

            Controls.Add(serviceName);
            Controls.Add(Availability);
            Controls.Add(btnEdit);

            AlignElementsHorizontally();
        }

        void OpenEditForm(object? sender, EventArgs e)
        {
            List<InputRow> test = new List<InputRow>()
            {
                new TextBoxRow("Price", true),
                new ComboBoxRow("Availability", ["Avaible", "Out of order"], service.Available ? 0 : 1),
                new TimePickerRow("Elérhetőség", TimePickerRow.PickMethod.Day, !service.AllYear),
                new TimePickerRow("Nyitás", TimePickerRow.PickMethod.Time,  (service.OpenTime != null && service.CloseTime != null))
            };

            ServiceUpdateForm serviceUpdateForm = new ServiceUpdateForm("Szolgáltatás Módosítása", test);
            serviceUpdateForm.ShowDialog();
        }
    }
}
