namespace SzallodaManagerForm
{
    partial class hotelstat
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
            lbHotel = new Label();
            dgvadatok = new DataGridView();
            Month = new DataGridViewTextBoxColumn();
            count = new DataGridViewTextBoxColumn();
            income = new DataGridViewTextBoxColumn();
            ((System.ComponentModel.ISupportInitialize)dgvadatok).BeginInit();
            SuspendLayout();
            // 
            // lbHotel
            // 
            lbHotel.AutoSize = true;
            lbHotel.Font = new Font("Segoe UI", 20F);
            lbHotel.Location = new Point(40, 9);
            lbHotel.Name = "lbHotel";
            lbHotel.Size = new Size(97, 46);
            lbHotel.TabIndex = 2;
            lbHotel.Text = "hotel";
            // 
            // dgvadatok
            // 
            dgvadatok.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dgvadatok.Columns.AddRange(new DataGridViewColumn[] { Month, count, income });
            dgvadatok.Location = new Point(40, 58);
            dgvadatok.Name = "dgvadatok";
            dgvadatok.RowHeadersWidth = 51;
            dgvadatok.Size = new Size(475, 454);
            dgvadatok.TabIndex = 4;
            // 
            // Month
            // 
            Month.HeaderText = "Hónap";
            Month.MinimumWidth = 6;
            Month.Name = "Month";
            Month.ReadOnly = true;
            Month.Width = 125;
            // 
            // count
            // 
            count.HeaderText = "Foglalások száma";
            count.MinimumWidth = 6;
            count.Name = "count";
            count.ReadOnly = true;
            count.Width = 125;
            // 
            // income
            // 
            income.HeaderText = "Bevétel";
            income.MinimumWidth = 6;
            income.Name = "income";
            income.ReadOnly = true;
            income.Width = 125;
            // 
            // hotelstat
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(549, 550);
            Controls.Add(dgvadatok);
            Controls.Add(lbHotel);
            Name = "hotelstat";
            StartPosition = FormStartPosition.CenterParent;
            Text = "Statisztika";
            Load += hotelstat_Load;
            ((System.ComponentModel.ISupportInitialize)dgvadatok).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion
        private Label lbHotel;
        private DataGridView dgvadatok;
        private DataGridViewTextBoxColumn Month;
        private DataGridViewTextBoxColumn count;
        private DataGridViewTextBoxColumn income;
    }
}