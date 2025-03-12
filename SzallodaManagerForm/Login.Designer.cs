namespace SzallodaManagerForm
{
    partial class Login
    {
        /// <summary>
        ///  Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        ///  Clean up any resources being used.
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
        ///  Required method for Designer support - do not modify
        ///  the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            tbUsername = new TextBox();
            tbPassword = new TextBox();
            label1 = new Label();
            label2 = new Label();
            btnBejelentkezés = new Button();
            panel1 = new Panel();
            lbPasswordError = new Label();
            lbUsernameError = new Label();
            label3 = new Label();
            panel1.SuspendLayout();
            SuspendLayout();
            // 
            // tbUsername
            // 
            tbUsername.Location = new Point(35, 91);
            tbUsername.Name = "tbUsername";
            tbUsername.Size = new Size(165, 23);
            tbUsername.TabIndex = 0;
            // 
            // tbPassword
            // 
            tbPassword.Location = new Point(35, 169);
            tbPassword.Name = "tbPassword";
            tbPassword.Size = new Size(165, 23);
            tbPassword.TabIndex = 1;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Location = new Point(18, 73);
            label1.Name = "label1";
            label1.Size = new Size(150, 15);
            label1.TabIndex = 2;
            label1.Text = "Felhasználónév vagy email:";
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Location = new Point(18, 151);
            label2.Name = "label2";
            label2.Size = new Size(40, 15);
            label2.TabIndex = 3;
            label2.Text = "Jelszó:";
            // 
            // btnBejelentkezés
            // 
            btnBejelentkezés.Location = new Point(54, 222);
            btnBejelentkezés.Name = "btnBejelentkezés";
            btnBejelentkezés.Size = new Size(135, 44);
            btnBejelentkezés.TabIndex = 4;
            btnBejelentkezés.Text = "Bejelentkezés";
            btnBejelentkezés.UseVisualStyleBackColor = true;
            btnBejelentkezés.Click += btnBejelentkezés_Click;
            // 
            // panel1
            // 
            panel1.Controls.Add(lbPasswordError);
            panel1.Controls.Add(lbUsernameError);
            panel1.Controls.Add(label3);
            panel1.Controls.Add(btnBejelentkezés);
            panel1.Controls.Add(label2);
            panel1.Controls.Add(tbPassword);
            panel1.Controls.Add(label1);
            panel1.Controls.Add(tbUsername);
            panel1.Location = new Point(50, 57);
            panel1.Name = "panel1";
            panel1.Size = new Size(245, 284);
            panel1.TabIndex = 5;
            // 
            // lbPasswordError
            // 
            lbPasswordError.AutoSize = true;
            lbPasswordError.Font = new Font("Segoe UI", 9F, FontStyle.Bold);
            lbPasswordError.ForeColor = Color.Red;
            lbPasswordError.Location = new Point(35, 195);
            lbPasswordError.Name = "lbPasswordError";
            lbPasswordError.Size = new Size(97, 15);
            lbPasswordError.TabIndex = 7;
            lbPasswordError.Text = "lbPasswordError";
            // 
            // lbUsernameError
            // 
            lbUsernameError.AutoSize = true;
            lbUsernameError.Font = new Font("Segoe UI", 9F, FontStyle.Bold);
            lbUsernameError.ForeColor = Color.Red;
            lbUsernameError.Location = new Point(35, 117);
            lbUsernameError.Name = "lbUsernameError";
            lbUsernameError.Size = new Size(102, 15);
            lbUsernameError.TabIndex = 6;
            lbUsernameError.Text = "lbUsernameError";
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Font = new Font("Segoe UI", 20F);
            label3.Location = new Point(35, 20);
            label3.Name = "label3";
            label3.Size = new Size(176, 37);
            label3.TabIndex = 5;
            label3.Text = "Bejelentkezés";
            // 
            // Login
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(350, 399);
            Controls.Add(panel1);
            Name = "Login";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Bejelentkezés";
            Load += Login_Load;
            panel1.ResumeLayout(false);
            panel1.PerformLayout();
            ResumeLayout(false);
        }

        #endregion

        private TextBox tbUsername;
        private TextBox tbPassword;
        private Label label1;
        private Label label2;
        private Button btnBejelentkezés;
        private Panel panel1;
        private Label label3;
        private Label lbPasswordError;
        private Label lbUsernameError;
    }
}
