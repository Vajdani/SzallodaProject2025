using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm
{
    public abstract class InputRow
    {
        public Label Text { get; private set; }
        public Label ErrorLabel { get; private set; }
        public int BonusBottomSpacing { get; protected set; } = 20;

        public InputRow(string text)
        {
            Text = new()
            {
                Text = text,
                AutoSize = true,
            };

            ErrorLabel = new()
            {
                Text = "ERRORLABELVAGYOK",
                ForeColor = Color.DarkRed,
                AutoSize = true,
                Visible = false
            };
            //ErrorLabel.Visible = false;

        }

        public virtual void UpdatePosition(Size parentSize, int y)
        {
            Text.Location = new Point((parentSize.Width - Text.Width) / 2, y);
            ErrorLabel.Location = new Point(Text.Location.X, Text.Location.Y + 20);  
        }

        public virtual void ApplyElements(Control.ControlCollection control)
        {
            control.Add(Text);
            control.Add(ErrorLabel);
        }

        public void ShowError(string message)
        {
            ErrorLabel.Text = message;
            ErrorLabel.Visible = true;

        }
    }

    class ComboBoxRow : InputRow
    {
        public ComboBox ItemBox { get; private set; }

        public ComboBoxRow(string text, string[] items, int selected = 0) : base(text)
        {
            ItemBox = new ComboBox();

            foreach (string item in items) { ItemBox.Items.Add(item); }

            ItemBox.DropDownStyle = ComboBoxStyle.DropDownList;
            ItemBox.SelectedIndex = selected;
        }

        public override void UpdatePosition(Size parentSize, int y)
        {
            int gap = (parentSize.Width - Text.Width - ItemBox.Width) / 3;
            Text.Location = new Point(gap, y);
            ItemBox.Location = new Point(gap * 2 + Text.Width, y);

            ErrorLabel.Location = new Point(Text.Location.X, Text.Location.Y + 20);
        }

        public override void ApplyElements(Control.ControlCollection control)
        {
            base.ApplyElements(control);
            control.Add(ItemBox);
        }
    }

    class TextBoxRow : InputRow 
    {
        public TextBox ValueTextBox { get; private set; }
        bool numOnly;
        bool IsNullable;

        public TextBoxRow(string text, bool NumOnly = false, bool canBnull = false) : base(text)
        {
            ValueTextBox = new TextBox();
            ValueTextBox.Size = new Size(200, 50);
            numOnly = NumOnly;
            IsNullable = canBnull; 

            ValueTextBox.TextChanged += NumberValidation;
        }

        public override void UpdatePosition(Size parentSize, int y)
        {
            int gap = (parentSize.Width - Text.Width - ValueTextBox.Width) / 3;
            Text.Location = new Point(gap, y);
            ValueTextBox.Location = new Point(gap*2 + Text.Width, y);

            ErrorLabel.Location = new Point(Text.Location.X, Text.Location.Y + 20);
        }

        public override void ApplyElements(Control.ControlCollection control)
        {
            base.ApplyElements(control);
            control.Add(ValueTextBox);
        }

        void NumberValidation(object sender, EventArgs e)
        {
            ErrorLabel.Visible = false;
            if (numOnly && ValueTextBox.Text.Length > 0)
            {
                try
                {
                    int a = Convert.ToInt32(ValueTextBox.Text);
                }
                catch 
                {
                    this.ShowError("Csak számot szabad megadni!");
                    ValueTextBox.Clear();
                }
            }
        }
    }

    class TimePickerRow : InputRow
    {

        public enum PickMethod {
            Day,
            Time
        }

        DateTimePicker Start;
        DateTimePicker Finish;
        ComboBox cbSetValue;

        public TimePickerRow(string text, PickMethod pick, bool IsLimited) : base(text)
        {
            BonusBottomSpacing = 60;

            Start = new()
            {
                Visible = IsLimited,
                Format = DateTimePickerFormat.Custom,
                CustomFormat = pick switch
                {
                    PickMethod.Day => "MM-dd",
                    PickMethod.Time => "hh:mm"
                }
            };

            Finish = new()
            {
                Visible = IsLimited,
                Format = DateTimePickerFormat.Custom,
                CustomFormat = pick switch
                {
                    PickMethod.Day => "MM-dd",
                    PickMethod.Time => "hh:mm"
                }
            };

            cbSetValue = new()
            {
                Items = {
                    pick == PickMethod.Day ? "All Year" : "All Day",
                    "Limited"
                },
                SelectedIndex = IsLimited ? 1 : 0,
                DropDownStyle = ComboBoxStyle.DropDownList,
            };

            cbSetValue.SelectedIndexChanged += (s, e) =>
            {
                Start.Visible = cbSetValue.SelectedIndex == 1;
                Finish.Visible = cbSetValue.SelectedIndex == 1;

            };
        }

        public override void UpdatePosition(Size parentSize, int y)
        {
            int gap = (parentSize.Width - Text.Width - cbSetValue.Width) / 3;
            Text.Location = new Point(gap, y);
            cbSetValue.Location = new Point(gap * 2 + Text.Width, y);

            gap = (parentSize.Width - Start.Width - Finish.Width) / 3;
            Start.Location = new Point(gap, y+Start.ClientSize.Height+25);
            Finish.Location = new Point(gap * 2 + Start.Width, y+Finish.ClientSize.Height + 25);
        }

        public override void ApplyElements(Control.ControlCollection control)
        {
            base.ApplyElements(control);
            control.Add(Start);
            control.Add(Finish);
            control.Add(cbSetValue);
        }
    }
}