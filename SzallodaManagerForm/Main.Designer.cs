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
            lbFelhasznalo = new Label();
            panel2 = new Panel();
            label2 = new Label();
            cbHotelek = new ComboBox();
            panel1.SuspendLayout();
            panel2.SuspendLayout();
            SuspendLayout();
            // 
            // panel1
            // 
            panel1.Controls.Add(cbHotelek);
            panel1.Controls.Add(lbFelhasznalo);
            panel1.Location = new Point(0, 1);
            panel1.Margin = new Padding(3, 4, 3, 4);
            panel1.Name = "panel1";
            panel1.Size = new Size(912, 77);
            panel1.TabIndex = 0;
            // 
            // lbFelhasznalo
            // 
            lbFelhasznalo.AutoSize = true;
            lbFelhasznalo.Font = new Font("Segoe UI", 20F);
            lbFelhasznalo.Location = new Point(14, 8);
            lbFelhasznalo.Name = "lbFelhasznalo";
            lbFelhasznalo.Size = new Size(245, 46);
            lbFelhasznalo.TabIndex = 0;
            lbFelhasznalo.Text = "Felhasználónév";
            // 
            // panel2
            // 
            panel2.Controls.Add(label2);
            panel2.Location = new Point(0, 87);
            panel2.Margin = new Padding(3, 4, 3, 4);
            panel2.Name = "panel2";
            panel2.Size = new Size(123, 512);
            panel2.TabIndex = 1;
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Segoe UI", 12F);
            label2.Location = new Point(14, 13);
            label2.Name = "label2";
            label2.Size = new Size(60, 28);
            label2.TabIndex = 0;
            label2.Text = "Hotel";
            // 
            // cbHotelek
            // 
            cbHotelek.FormattingEnabled = true;
            cbHotelek.Location = new Point(751, 25);
            cbHotelek.Name = "cbHotelek";
            cbHotelek.Size = new Size(151, 28);
            cbHotelek.TabIndex = 1;
            // 
            // Main
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(914, 600);
            Controls.Add(panel2);
            Controls.Add(panel1);
            Margin = new Padding(3, 4, 3, 4);
            Name = "Main";
            Text = "Main";
            Load += Main_Load;
            panel1.ResumeLayout(false);
            panel1.PerformLayout();
            panel2.ResumeLayout(false);
            panel2.PerformLayout();
            ResumeLayout(false);
        }

        #endregion

        private Panel panel1;
        private Panel panel2;
        private Label lbFelhasznalo;
        private Label label2;
        private ComboBox cbHotelek;
    }
}