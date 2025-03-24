using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SzallodaManagerForm
{
    public class InputRow
    {
        public Label Text { get; private set; }
        public Label ErrorLabel { get; private set; }

        public InputRow(string text)
        {
            Text = new();
            Text.Text = text;

            ErrorLabel = new Label();
            //ErrorLabel.Visible = false;
            ErrorLabel.Text = "ERRORLABELVAGYOK";
            ErrorLabel.ForeColor = Color.DarkRed;
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

        DateTimePicker Timepicker;


        public TimePickerRow(string text, PickMethod pick) : base(text)
        {

            Timepicker = new DateTimePicker();
            Timepicker.Width = Timepicker.Width / 2;
            Timepicker.Format = DateTimePickerFormat.Custom;
            switch (pick)
            {
                case PickMethod.Day: Timepicker.CustomFormat = "MM-dd"; break;
                case PickMethod.Time: Timepicker.CustomFormat = "hh:mm"; break;
            }
        }

        public override void UpdatePosition(Size parentSize, int y)
        {
            int gap = (parentSize.Width - Text.Width - Timepicker.Width) / 3;
            Text.Location = new Point(gap, y);
            Timepicker.Location = new Point(gap * 2 + Text.Width, y);

            ErrorLabel.Location = new Point(Text.Location.X, Text.Location.Y + 20);
        }

        public override void ApplyElements(Control.ControlCollection control)
        {
            base.ApplyElements(control);
            control.Add(Timepicker);
        }
    }

    class MultipleRows : InputRow
    {
        ComboBox Selector;
        Panel ItemPanel;

        public MultipleRows(string basetext, string closedText, string openText, InputRow[] inputs, int baseState = 0) : base(basetext) {

            //Comboboxtól függ hogy látszik-e a többi elem
            Selector = new()
            {
                SelectedIndex = baseState,
                DropDownStyle = ComboBoxStyle.DropDownList,
                Items =
                {
                    closedText,
                    openText
                }
            };
        }
    }
}

// Text, CB, Datetimepicker, timepicker,