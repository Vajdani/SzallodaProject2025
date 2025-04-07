using System.Diagnostics;

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

        public virtual bool Validate() { return true; }
        public virtual object? GetValue() { return null; }
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

        public override object GetValue()
        {
            return ItemBox.SelectedIndex;
        }
    }

    class TextBoxRow : InputRow 
    {
        public TextBox ValueTextBox { get; private set; }
        bool numOnly;
        bool IsNullable;
        string? BaseValue;

        public TextBoxRow(string text, string? baseValue = null, bool NumOnly = false, bool canBnull = false) : base(text)
        {
            BonusBottomSpacing = 10;
            ValueTextBox = new TextBox();
            if(baseValue != null)
            {
                ValueTextBox.Text = baseValue;
                BaseValue = baseValue;
            }
            else BaseValue = null;
                ValueTextBox.Size = new Size(200, 50);
            numOnly = NumOnly;
            IsNullable = canBnull;

            ValueTextBox.TextChanged += (s, e) => { ErrorLabel.Visible = false; };
        }

        public override void UpdatePosition(Size parentSize, int y)
        {
            int gap = (parentSize.Width - Text.Width - ValueTextBox.Width) / 3;
            Text.Location = new Point(gap, y);
            ValueTextBox.Location = new Point(gap*2 + Text.Width, y);

            ErrorLabel.Location = new Point(Text.Location.X, Text.Location.Y + ErrorLabel.ClientSize.Height + 20);
        }

        public override void ApplyElements(Control.ControlCollection control)
        {
            base.ApplyElements(control);
            control.Add(ValueTextBox);
        }

        public override bool Validate()
        {
            if(!IsNullable && ValueTextBox.Text.Length == 0)
            {
                ShowError("Nem lehet üres!");
                return false;
            }
            if (numOnly && !int.TryParse(ValueTextBox.Text, out int _))
            {
                ValueTextBox.Clear();
                ShowError("Csak számot lehet megadni!");
                return false;
            }
            return true;
        }

        public override object GetValue()
        {
            return ValueTextBox.Text;
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
        PickMethod Pick;

        public TimePickerRow(string text, PickMethod pick, bool IsLimited, object[]? timeValues = null) : base(text)
        {
            BonusBottomSpacing = 60;
            Pick = pick;

            Start = new()
            {
                Enabled = IsLimited,
                ShowUpDown = pick switch
                {
                    PickMethod.Day => false,
                    PickMethod.Time => true,
                    _ => false
                },
                Format = DateTimePickerFormat.Custom,
                CustomFormat = pick switch
                {
                    PickMethod.Day => "MM-dd",
                    PickMethod.Time => "HH:mm",
                    _ => "MM-dd"
                }
            };
            Start.ValueChanged += (s, e) => { ErrorLabel.Visible = false; };

            Finish = new()
            {
                Enabled = IsLimited,
                ShowUpDown = pick switch
                {
                    PickMethod.Day => false,
                    PickMethod.Time => true,
                    _ => false
                },
                Format = DateTimePickerFormat.Custom,
                CustomFormat = pick switch
                {
                    PickMethod.Day => "MM-dd",
                    PickMethod.Time => "HH:mm",
                    _ => "MM-dd"
                }
            };
            Finish.ValueChanged += (s, e) => { ErrorLabel.Visible = false; };

            cbSetValue = new()
            {
                Items = {
                    pick == PickMethod.Day ? "Egész éves" : "Egész napos",
                    "Ideiglenes"
                },
                SelectedIndex = IsLimited ? 1 : 0,
                DropDownStyle = ComboBoxStyle.DropDownList,
            };

            cbSetValue.SelectedIndexChanged += (s, e) =>
            {
                Start.Enabled = cbSetValue.SelectedIndex == 1;
                Finish.Enabled = cbSetValue.SelectedIndex == 1;
                ErrorLabel.Visible = false;
            };

            Debug.WriteLine($"timeValues[0] = {timeValues[0]?.ToString() ?? "null"}");
            Debug.WriteLine($"timeValues[1] = {timeValues[1]?.ToString() ?? "null"}");

            if (timeValues != null)
            {
                switch (Pick)
                {
                    case PickMethod.Day:
                        var startDate = (DateTime)timeValues[0];
                        var endDate = (DateTime)timeValues[1];

                        if (startDate == DateTime.MinValue)
                            startDate = new DateTime(2000, 1, 1);
                        if (endDate == DateTime.MinValue)
                            endDate = new DateTime(2000, 1, 1);

                        Start.Value = new DateTime(2000, startDate.Month, startDate.Day);
                        Finish.Value = new DateTime(2000, endDate.Month, endDate.Day);
                        break;

                    case PickMethod.Time:
                        var startTime = (TimeSpan)timeValues[0];
                        var endTime = (TimeSpan)timeValues[1];

                        if (startTime == TimeSpan.MinValue)
                            startTime = TimeSpan.Zero;
                        if (endTime == TimeSpan.MinValue)
                            endTime = TimeSpan.Zero;

                        Start.Value = new DateTime(2000, 1, 1, startTime.Hours, startTime.Minutes, 0);
                        Finish.Value = new DateTime(2000, 1, 1, endTime.Hours, endTime.Minutes, 0);
                        break;
                }
            }
            else
            {
                Start.Value = new DateTime(2000, 1, 1, 0, 0, 0);
                Finish.Value = new DateTime(2000, 1, 1, 0, 0, 0);
            }
        }
        

        public override void UpdatePosition(Size parentSize, int y)
        {
            int gap = (parentSize.Width - Text.Width - cbSetValue.Width) / 3;
            Text.Location = new Point(gap, y);
            cbSetValue.Location = new Point(gap * 2 + Text.Width, y);

            gap = (parentSize.Width - Start.Width - Finish.Width) / 3;
            Start.Location = new Point(gap, y+Start.ClientSize.Height+10);
            Finish.Location = new Point(gap * 2 + Start.Width, y+Finish.ClientSize.Height + 10);

            ErrorLabel.Location = new(Start.Location.X, y + Start.ClientSize.Height + ErrorLabel.ClientSize.Height + 20);
        }

        public override void ApplyElements(Control.ControlCollection control)
        {
            base.ApplyElements(control);
            control.Add(Start);
            control.Add(Finish);
            control.Add(cbSetValue);
        }

        public override bool Validate()
        {

            if (Pick == PickMethod.Time && cbSetValue.SelectedIndex == 1)
            {
                if (Start.Value.Minute == Finish.Value.Minute && Start.Value.Hour == Finish.Value.Hour)
                {
                    ShowError("Az időpontok nem egyezhetnek!");
                    return false;
                }
            }

            if (Pick == PickMethod.Day && cbSetValue.SelectedIndex == 1) { 

                if (Start.Value.Day == Finish.Value.Day && Start.Value.Month == Finish.Value.Month)
                {
                    ShowError("A dátumok nem egyezhetnek!");
                    return false;
                }
            }
            return true;
        }

        public override object? GetValue()
        {
            if (cbSetValue.SelectedIndex == 0) { return null; }
            else return Pick switch
            {
                PickMethod.Day => new DateTime[] { new(0100, Start.Value.Month, Start.Value.Day), new(0100, Finish.Value.Month, Finish.Value.Day) },
                PickMethod.Time => new TimeSpan[] { new(Start.Value.Hour, Start.Value.Minute, 0), new(Finish.Value.Hour, Finish.Value.Minute, 0) },
                _ => null
            };
        }
    }
}