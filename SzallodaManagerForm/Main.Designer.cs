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
            cbHotelek = new ComboBox();
            lbFelhasznalo = new Label();
            panel2 = new Panel();
            label2 = new Label();
            lbHotelName = new Label();
            pHotelInfo = new Panel();
            lbCity = new Label();
            lbEmail = new Label();
            lbPhoneNumber = new Label();
            lbAddress = new Label();
            panel1.SuspendLayout();
            panel2.SuspendLayout();
            pHotelInfo.SuspendLayout();
            SuspendLayout();
            // 
            // panel1
            // 
            panel1.Controls.Add(cbHotelek);
            panel1.Controls.Add(lbFelhasznalo);
            panel1.Location = new Point(0, 1);
            panel1.Name = "panel1";
            panel1.Size = new Size(798, 58);
            panel1.TabIndex = 0;
            // 
            // cbHotelek
            // 
            cbHotelek.DropDownStyle = ComboBoxStyle.DropDownList;
            cbHotelek.FormattingEnabled = true;
            cbHotelek.Location = new Point(657, 19);
            cbHotelek.Margin = new Padding(3, 2, 3, 2);
            cbHotelek.Name = "cbHotelek";
            cbHotelek.Size = new Size(133, 23);
            cbHotelek.TabIndex = 1;
            cbHotelek.SelectedValueChanged += OnHotelSelected;
            // 
            // lbFelhasznalo
            // 
            lbFelhasznalo.AutoSize = true;
            lbFelhasznalo.Font = new Font("Segoe UI", 20F);
            lbFelhasznalo.Location = new Point(12, 6);
            lbFelhasznalo.Name = "lbFelhasznalo";
            lbFelhasznalo.Size = new Size(197, 37);
            lbFelhasznalo.TabIndex = 0;
            lbFelhasznalo.Text = "Felhasználónév";
            // 
            // panel2
            // 
            panel2.Controls.Add(label2);
            panel2.Location = new Point(0, 65);
            panel2.Name = "panel2";
            panel2.Size = new Size(108, 384);
            panel2.TabIndex = 1;
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Segoe UI", 12F);
            label2.Location = new Point(12, 10);
            label2.Name = "label2";
            label2.Size = new Size(47, 21);
            label2.TabIndex = 0;
            label2.Text = "Hotel";
            // 
            // lbHotelName
            // 
            lbHotelName.AutoSize = true;
            lbHotelName.Location = new Point(15, 15);
            lbHotelName.Name = "lbHotelName";
            lbHotelName.Size = new Size(78, 15);
            lbHotelName.TabIndex = 2;
            lbHotelName.Text = "lbHotelName";
            // 
            // pHotelInfo
            // 
            pHotelInfo.Controls.Add(lbCity);
            pHotelInfo.Controls.Add(lbEmail);
            pHotelInfo.Controls.Add(lbPhoneNumber);
            pHotelInfo.Controls.Add(lbAddress);
            pHotelInfo.Controls.Add(lbHotelName);
            pHotelInfo.Location = new Point(114, 65);
            pHotelInfo.Name = "pHotelInfo";
            pHotelInfo.Size = new Size(676, 384);
            pHotelInfo.TabIndex = 3;
            pHotelInfo.Visible = false;
            // 
            // lbCity
            // 
            lbCity.AutoSize = true;
            lbCity.Location = new Point(15, 40);
            lbCity.Name = "lbCity";
            lbCity.Size = new Size(38, 15);
            lbCity.TabIndex = 6;
            lbCity.Text = "lbCity";
            // 
            // lbEmail
            // 
            lbEmail.AutoSize = true;
            lbEmail.Location = new Point(15, 115);
            lbEmail.Name = "lbEmail";
            lbEmail.Size = new Size(46, 15);
            lbEmail.TabIndex = 5;
            lbEmail.Text = "lbEmail";
            // 
            // lbPhoneNumber
            // 
            lbPhoneNumber.AutoSize = true;
            lbPhoneNumber.Location = new Point(15, 90);
            lbPhoneNumber.Name = "lbPhoneNumber";
            lbPhoneNumber.Size = new Size(95, 15);
            lbPhoneNumber.TabIndex = 4;
            lbPhoneNumber.Text = "lbPhoneNumber";
            // 
            // lbAddress
            // 
            lbAddress.AutoSize = true;
            lbAddress.Location = new Point(15, 65);
            lbAddress.Name = "lbAddress";
            lbAddress.Size = new Size(59, 15);
            lbAddress.TabIndex = 3;
            lbAddress.Text = "lbAddress";
            // 
            // Main
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(800, 450);
            Controls.Add(pHotelInfo);
            Controls.Add(panel2);
            Controls.Add(panel1);
            Name = "Main";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Main";
            FormClosed += Main_Closed;
            Load += Main_Load;
            panel1.ResumeLayout(false);
            panel1.PerformLayout();
            panel2.ResumeLayout(false);
            panel2.PerformLayout();
            pHotelInfo.ResumeLayout(false);
            pHotelInfo.PerformLayout();
            ResumeLayout(false);
        }

        #endregion

        private Panel panel1;
        private Panel panel2;
        private Label lbFelhasznalo;
        private Label label2;
        private ComboBox cbHotelek;
        private Label lbHotelName;
        private Panel pHotelInfo;
        private Label lbAddress;
        private Label lbPhoneNumber;
        private Label lbEmail;
        private Label lbCity;
    }
}