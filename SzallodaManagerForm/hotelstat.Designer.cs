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
            lbevsum = new Label();
            cbevek = new ComboBox();
            lbpopular = new Label();
            lbmax = new Label();
            ((System.ComponentModel.ISupportInitialize)dgvadatok).BeginInit();
            SuspendLayout();
            // 
            // lbHotel
            // 
            lbHotel.AutoSize = true;
            lbHotel.Font = new Font("Segoe UI", 20F);
            lbHotel.Location = new Point(35, 52);
            lbHotel.Name = "lbHotel";
            lbHotel.Size = new Size(78, 37);
            lbHotel.TabIndex = 2;
            lbHotel.Text = "hotel";
            // 
            // dgvadatok
            // 
            dgvadatok.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dgvadatok.Columns.AddRange(new DataGridViewColumn[] { Month, count, income });
            dgvadatok.Location = new Point(35, 89);
            dgvadatok.Margin = new Padding(3, 2, 3, 2);
            dgvadatok.Name = "dgvadatok";
            dgvadatok.RowHeadersWidth = 51;
            dgvadatok.Size = new Size(475, 340);
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
            // lbevsum
            // 
            lbevsum.AutoSize = true;
            lbevsum.Location = new Point(534, 102);
            lbevsum.Name = "lbevsum";
            lbevsum.Size = new Size(141, 15);
            lbevsum.TabIndex = 5;
            lbevsum.Text = "Év eddigi összes bevétele:";
            // 
            // cbevek
            // 
            cbevek.FormattingEnabled = true;
            cbevek.Location = new Point(35, 26);
            cbevek.Name = "cbevek";
            cbevek.Size = new Size(121, 23);
            cbevek.TabIndex = 6;
            cbevek.SelectedIndexChanged += cbevek_SelectedIndexChanged;
            // 
            // lbpopular
            // 
            lbpopular.AutoSize = true;
            lbpopular.Location = new Point(534, 162);
            lbpopular.Name = "lbpopular";
            lbpopular.Size = new Size(137, 15);
            lbpopular.TabIndex = 7;
            lbpopular.Text = "legnépszerűbb hónapok:";
            // 
            // lbmax
            // 
            lbmax.AutoSize = true;
            lbmax.Location = new Point(534, 220);
            lbmax.Name = "lbmax";
            lbmax.Size = new Size(147, 15);
            lbmax.TabIndex = 8;
            lbmax.Text = "Legjövedelmezőbb hónap:";
            // 
            // hotelstat
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(838, 510);
            Controls.Add(lbmax);
            Controls.Add(lbpopular);
            Controls.Add(cbevek);
            Controls.Add(lbevsum);
            Controls.Add(dgvadatok);
            Controls.Add(lbHotel);
            Margin = new Padding(3, 2, 3, 2);
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
        private Label lbevsum;
        private ComboBox cbevek;
        private Label lbpopular;
        private Label lbmax;
    }
}