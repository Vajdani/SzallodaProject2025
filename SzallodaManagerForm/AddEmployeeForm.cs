namespace SzallodaManagerForm
{
    internal class AddEmployeeForm : Form
    {
        Label lbTitle;
        UsersPanel Display;

        public AddEmployeeForm()
        {
            this.Text = "Alkalmazott felvétele";
            this.Size = new(900, 800);
            this.StartPosition = FormStartPosition.CenterParent;

            lbTitle = new()
            {
                Text = "Alkalmazott hozzáadása",
                AutoSize = true,
                Font = new Font("Arial", 20, FontStyle.Bold),
            };

            Display = new();

            Controls.Add(lbTitle);
            Controls.Add(Display);

            Display.UpdatePanel();
            OnSizechange();

            this.Resize += (s, e) => { OnSizechange(); };
            this.FormClosed += (s, e) => { Main.current.UpdatePanel(Main.Instance.GetSelectedHotel()); };
        }

        void OnSizechange()
        {
            lbTitle.Location = new((this.ClientSize.Width - lbTitle.ClientSize.Width) / 2, 30);
            Display.ResizePanel(this.ClientSize);
        }
    }
}
