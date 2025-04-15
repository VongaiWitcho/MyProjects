namespace tic_tac_toe_official
{
    partial class Form1
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
            R1C1 = new Button();
            R2C1 = new Button();
            R2C2 = new Button();
            R3C1 = new Button();
            R3C2 = new Button();
            R3C3 = new Button();
            R2C3 = new Button();
            R1C2 = new Button();
            R1C3 = new Button();
            menuStrip1 = new MenuStrip();
            toolStripMenuItem1 = new ToolStripMenuItem();
            toolStripTextBox1 = new ToolStripTextBox();
            doubleToolStripMenuItem = new ToolStripMenuItem();
            computerToolStripMenuItem = new ToolStripMenuItem();
            fileOptionsToolStripMenuItem = new ToolStripMenuItem();
            newGameToolStripMenuItem = new ToolStripMenuItem();
            exitToolStripMenuItem = new ToolStripMenuItem();
            menuStrip1.SuspendLayout();
            SuspendLayout();
            // 
            // R1C1
            // 
            R1C1.Location = new Point(48, 81);
            R1C1.Margin = new Padding(6);
            R1C1.Name = "R1C1";
            R1C1.Size = new Size(79, 71);
            R1C1.TabIndex = 0;
            R1C1.UseVisualStyleBackColor = true;
            R1C1.Click += Button_Click;
            // 
            // R2C1
            // 
            R2C1.Location = new Point(48, 164);
            R2C1.Margin = new Padding(6);
            R2C1.Name = "R2C1";
            R2C1.Size = new Size(79, 67);
            R2C1.TabIndex = 3;
            R2C1.UseVisualStyleBackColor = true;
            R2C1.Click += Button_Click;
            // 
            // R2C2
            // 
            R2C2.Location = new Point(139, 164);
            R2C2.Margin = new Padding(6);
            R2C2.Name = "R2C2";
            R2C2.Size = new Size(78, 67);
            R2C2.TabIndex = 4;
            R2C2.UseVisualStyleBackColor = true;
            R2C2.Click += Button_Click;
            // 
            // R3C1
            // 
            R3C1.Location = new Point(48, 243);
            R3C1.Margin = new Padding(6);
            R3C1.Name = "R3C1";
            R3C1.Size = new Size(79, 66);
            R3C1.TabIndex = 6;
            R3C1.UseVisualStyleBackColor = true;
            R3C1.Click += Button_Click;
            // 
            // R3C2
            // 
            R3C2.Location = new Point(139, 243);
            R3C2.Margin = new Padding(6);
            R3C2.Name = "R3C2";
            R3C2.Size = new Size(78, 66);
            R3C2.TabIndex = 7;
            R3C2.UseVisualStyleBackColor = true;
            R3C2.Click += Button_Click;
            // 
            // R3C3
            // 
            R3C3.Location = new Point(229, 243);
            R3C3.Margin = new Padding(6);
            R3C3.Name = "R3C3";
            R3C3.Size = new Size(78, 66);
            R3C3.TabIndex = 8;
            R3C3.UseVisualStyleBackColor = true;
            R3C3.Click += Button_Click;
            // 
            // R2C3
            // 
            R2C3.Location = new Point(229, 164);
            R2C3.Margin = new Padding(6);
            R2C3.Name = "R2C3";
            R2C3.Size = new Size(78, 67);
            R2C3.TabIndex = 9;
            R2C3.UseVisualStyleBackColor = true;
            R2C3.Click += Button_Click;
            // 
            // R1C2
            // 
            R1C2.Location = new Point(139, 81);
            R1C2.Margin = new Padding(6);
            R1C2.Name = "R1C2";
            R1C2.Size = new Size(78, 71);
            R1C2.TabIndex = 10;
            R1C2.UseVisualStyleBackColor = true;
            R1C2.Click += Button_Click;
            // 
            // R1C3
            // 
            R1C3.Location = new Point(229, 81);
            R1C3.Margin = new Padding(6);
            R1C3.Name = "R1C3";
            R1C3.Size = new Size(78, 71);
            R1C3.TabIndex = 11;
            R1C3.UseVisualStyleBackColor = true;
            R1C3.Click += Button_Click;
            // 
            // menuStrip1
            // 
            menuStrip1.Items.AddRange(new ToolStripItem[] { toolStripMenuItem1, fileOptionsToolStripMenuItem });
            menuStrip1.Location = new Point(0, 0);
            menuStrip1.Name = "menuStrip1";
            menuStrip1.Size = new Size(1370, 24);
            menuStrip1.TabIndex = 12;
            menuStrip1.Text = "menuStrip1";
            // 
            // toolStripMenuItem1
            // 
            toolStripMenuItem1.DropDownItems.AddRange(new ToolStripItem[] { toolStripTextBox1, doubleToolStripMenuItem, computerToolStripMenuItem });
            toolStripMenuItem1.Name = "toolStripMenuItem1";
            toolStripMenuItem1.Size = new Size(96, 20);
            toolStripMenuItem1.Text = "Player Options";
            // 
            // toolStripTextBox1
            // 
            toolStripTextBox1.Name = "toolStripTextBox1";
            toolStripTextBox1.Size = new Size(100, 23);
            toolStripTextBox1.Text = "Single";
            // 
            // doubleToolStripMenuItem
            // 
            doubleToolStripMenuItem.Name = "doubleToolStripMenuItem";
            doubleToolStripMenuItem.Size = new Size(180, 22);
            doubleToolStripMenuItem.Text = "Double";
            // 
            // computerToolStripMenuItem
            // 
            computerToolStripMenuItem.Name = "computerToolStripMenuItem";
            computerToolStripMenuItem.Size = new Size(180, 22);
            computerToolStripMenuItem.Text = "Computer";
            // 
            // fileOptionsToolStripMenuItem
            // 
            fileOptionsToolStripMenuItem.DropDownItems.AddRange(new ToolStripItem[] { newGameToolStripMenuItem, exitToolStripMenuItem });
            fileOptionsToolStripMenuItem.Name = "fileOptionsToolStripMenuItem";
            fileOptionsToolStripMenuItem.Size = new Size(82, 20);
            fileOptionsToolStripMenuItem.Text = "File Options";
            // 
            // newGameToolStripMenuItem
            // 
            newGameToolStripMenuItem.Name = "newGameToolStripMenuItem";
            newGameToolStripMenuItem.Size = new Size(180, 22);
            newGameToolStripMenuItem.Text = "NewGame";
            newGameToolStripMenuItem.Click += newGameToolStripMenuItem_Click;
            // 
            // exitToolStripMenuItem
            // 
            exitToolStripMenuItem.Name = "exitToolStripMenuItem";
            exitToolStripMenuItem.Size = new Size(180, 22);
            exitToolStripMenuItem.Text = "Quit Game";
            exitToolStripMenuItem.Click += exitToolStripMenuItem_Click;
            // 
            // Form1
            // 
            AutoScaleDimensions = new SizeF(15F, 32F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(1370, 749);
            Controls.Add(R1C3);
            Controls.Add(R1C2);
            Controls.Add(R2C3);
            Controls.Add(R3C3);
            Controls.Add(R3C2);
            Controls.Add(R3C1);
            Controls.Add(R2C2);
            Controls.Add(R2C1);
            Controls.Add(R1C1);
            Controls.Add(menuStrip1);
            Font = new Font("Segoe UI Black", 18F, FontStyle.Bold | FontStyle.Italic, GraphicsUnit.Point);
            MainMenuStrip = menuStrip1;
            Margin = new Padding(6);
            Name = "Form1";
            Text = "Form1";
            menuStrip1.ResumeLayout(false);
            menuStrip1.PerformLayout();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Button R1C1;
        private Button R2C1;
        private Button R2C2;
        private Button R3C1;
        private Button R3C2;
        private Button R3C3;
        private Button R2C3;
        private Button R1C2;
        private Button R1C3;
        private MenuStrip menuStrip1;
        private ToolStripMenuItem toolStripMenuItem1;
        private ToolStripTextBox toolStripTextBox1;
        private ToolStripMenuItem doubleToolStripMenuItem;
        private ToolStripMenuItem computerToolStripMenuItem;
        private ToolStripMenuItem fileOptionsToolStripMenuItem;
        private ToolStripMenuItem newGameToolStripMenuItem;
        private ToolStripMenuItem exitToolStripMenuItem;
    }
}