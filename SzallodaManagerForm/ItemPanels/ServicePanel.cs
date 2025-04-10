using SzallodaManagerForm.Models;

namespace SzallodaManagerForm.ItemPanels
{
    internal class ServicePanel : ItemPanel
    {
        public static Dictionary<string, Delegate> SearchCategories { get; private set; } = new Dictionary<string, Delegate>()
        {
            {"Szolgáltatás", new Func<Service, string>(s => s.Name) },
            {"Állapot", new Func<Service, string>(s => s.Available ? "Elérhető" : "Nem Elérhető") },
        };

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
            List<InputRow> Inputs =
            [
                new TextBoxRow("Ár", service.Price.ToString(), true),
                new ComboBoxRow("Elérhetőség", ["Elérhető", "Üzemen kívül"], service.Available ? 0 : 1),
                new TimePickerRow("Időszak", TimePickerRow.PickMethod.Day, !service.AllYear, [service.StartDate, service.EndDate]),
                new TimePickerRow("Nyitvatartás", TimePickerRow.PickMethod.Time, !(service.OpenTime == service.CloseTime) ,[service.OpenTime, service.CloseTime])
            ];

            new ServiceUpdateForm("Szolgáltatás Módosítása", service, Inputs).ShowDialog();
        }

        public static new List<Service> GetList() => Main.Instance.GetSelectedHotel().Services;
        public static Type GetModelType() => typeof(Service);
    }
}
