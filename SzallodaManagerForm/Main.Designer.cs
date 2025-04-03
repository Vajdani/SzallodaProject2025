namespace SzallodaManagerForm
{
    partial class Main
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            panel1 = new Panel();
            label2 = new Label();
            cbModositas = new ComboBox();
            label1 = new Label();
            cbHotelek = new ComboBox();
            lbFelhasznalo = new Label();
            panel1.SuspendLayout();
            SuspendLayout();
            // 
            // panel1
            // 
            panel1.BackColor = SystemColors.ActiveCaption;
            panel1.Controls.Add(label2);
            panel1.Controls.Add(cbModositas);
            panel1.Controls.Add(label1);
            panel1.Controls.Add(cbHotelek);
            panel1.Controls.Add(lbFelhasznalo);
            panel1.Location = new Point(0, 0);
            panel1.Margin = new Padding(3, 4, 3, 4);
            panel1.Name = "panel1";
            panel1.Size = new Size(901, 80);
            panel1.TabIndex = 0;
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Segoe UI", 14F);
            label2.Location = new Point(601, 22);
            label2.Name = "label2";
            label2.Size = new Size(129, 32);
            label2.TabIndex = 4;
            label2.Text = "Módosítás:";
            // 
            // cbModositas
            // 
            cbModositas.AutoCompleteCustomSource.AddRange(new string[] { "Alkalmazottak", "Szolgáltatások", "Szobák" });
            cbModositas.DropDownStyle = ComboBoxStyle.DropDownList;
            cbModositas.FormattingEnabled = true;
            cbModositas.ImeMode = ImeMode.On;
            cbModositas.Items.AddRange(new object[] { "Alkalmazottak", "Szolgáltatások", "Szobák", "Statisztika megtekintése" });
            cbModositas.Location = new Point(736, 28);
            cbModositas.Margin = new Padding(3, 4, 3, 4);
            cbModositas.Name = "cbModositas";
            cbModositas.Size = new Size(138, 28);
            cbModositas.TabIndex = 2;
            cbModositas.SelectedIndexChanged += cbModositas_SelectedIndexChanged;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Segoe UI", 14F);
            label1.Location = new Point(346, 22);
            label1.Name = "label1";
            label1.Size = new Size(77, 32);
            label1.TabIndex = 3;
            label1.Text = "Hotel:";
            // 
            // cbHotelek
            // 
            cbHotelek.DropDownStyle = ComboBoxStyle.DropDownList;
            cbHotelek.FormattingEnabled = true;
            cbHotelek.Location = new Point(429, 28);
            cbHotelek.Margin = new Padding(3, 2, 3, 2);
            cbHotelek.Name = "cbHotelek";
            cbHotelek.Size = new Size(151, 28);
            cbHotelek.TabIndex = 1;
            cbHotelek.SelectedValueChanged += OnHotelSelected;
            // 
            // lbFelhasznalo
            // 
            lbFelhasznalo.AutoSize = true;
            lbFelhasznalo.Font = new Font("Segoe UI", 20F);
            lbFelhasznalo.Location = new Point(13, 8);
            lbFelhasznalo.Name = "lbFelhasznalo";
            lbFelhasznalo.Size = new Size(245, 46);
            lbFelhasznalo.TabIndex = 0;
            lbFelhasznalo.Text = "Felhasználónév";
            // 
            // Main
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(896, 614);
            Controls.Add(panel1);
            Margin = new Padding(3, 4, 3, 4);
            Name = "Main";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Módosítási felület";
            FormClosed += Main_Closed;
            Load += Main_Load;
            panel1.ResumeLayout(false);
            panel1.PerformLayout();
            ResumeLayout(false);
        }

        #endregion

        private Panel panel1;
        private Label lbFelhasznalo;
        private ComboBox cbHotelek;
        private Label lbHotelName;
        private Label lbAddress;
        private Label lbPhoneNumber;
        private Label lbEmail;
        private Label lbCity;
        private Label label2;
        private ComboBox cbModositas;
        private Label label1;
    }
}