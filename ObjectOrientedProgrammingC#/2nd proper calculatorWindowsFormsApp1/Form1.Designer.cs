namespace _2nd_proper_calculatorWindowsFormsApp1
{
    partial class Form1
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
            this.result = new System.Windows.Forms.TextBox();
            this.btnclear = new System.Windows.Forms.Button();
            this.btnCE = new System.Windows.Forms.Button();
            this.btndiv = new System.Windows.Forms.Button();
            this.btnmultiple = new System.Windows.Forms.Button();
            this.btnpoint = new System.Windows.Forms.Button();
            this.btnminus = new System.Windows.Forms.Button();
            this.btn0 = new System.Windows.Forms.Button();
            this.btn9 = new System.Windows.Forms.Button();
            this.btn8 = new System.Windows.Forms.Button();
            this.btn7 = new System.Windows.Forms.Button();
            this.btn6 = new System.Windows.Forms.Button();
            this.btn5 = new System.Windows.Forms.Button();
            this.btn4 = new System.Windows.Forms.Button();
            this.btn3 = new System.Windows.Forms.Button();
            this.btn2 = new System.Windows.Forms.Button();
            this.btnPlus = new System.Windows.Forms.Button();
            this.btnEqual = new System.Windows.Forms.Button();
            this.btn1 = new System.Windows.Forms.Button();
            this.equation = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // result
            // 
            this.result.Location = new System.Drawing.Point(109, 40);
            this.result.Name = "result";
            this.result.Size = new System.Drawing.Size(199, 20);
            this.result.TabIndex = 43;
            this.result.Text = "0";
            this.result.TextAlign = System.Windows.Forms.HorizontalAlignment.Right;
            // 
            // btnclear
            // 
            this.btnclear.Location = new System.Drawing.Point(267, 114);
            this.btnclear.Name = "btnclear";
            this.btnclear.Size = new System.Drawing.Size(40, 25);
            this.btnclear.TabIndex = 42;
            this.btnclear.Text = "C";
            this.btnclear.UseVisualStyleBackColor = true;
            this.btnclear.Click += new System.EventHandler(this.btnclear_Click);
            // 
            // btnCE
            // 
            this.btnCE.Location = new System.Drawing.Point(266, 73);
            this.btnCE.Name = "btnCE";
            this.btnCE.Size = new System.Drawing.Size(41, 25);
            this.btnCE.TabIndex = 41;
            this.btnCE.Text = "CE";
            this.btnCE.UseVisualStyleBackColor = true;
            this.btnCE.Click += new System.EventHandler(this.btnCE_Click);
            // 
            // btndiv
            // 
            this.btndiv.Location = new System.Drawing.Point(229, 73);
            this.btndiv.Name = "btndiv";
            this.btndiv.Size = new System.Drawing.Size(36, 25);
            this.btndiv.TabIndex = 40;
            this.btndiv.Text = "/";
            this.btndiv.UseVisualStyleBackColor = true;
            this.btndiv.Click += new System.EventHandler(this.operator_click);
            // 
            // btnmultiple
            // 
            this.btnmultiple.Location = new System.Drawing.Point(229, 193);
            this.btnmultiple.Name = "btnmultiple";
            this.btnmultiple.Size = new System.Drawing.Size(36, 25);
            this.btnmultiple.TabIndex = 39;
            this.btnmultiple.Text = "*";
            this.btnmultiple.UseVisualStyleBackColor = true;
            this.btnmultiple.Click += new System.EventHandler(this.operator_click);
            // 
            // btnpoint
            // 
            this.btnpoint.Location = new System.Drawing.Point(192, 193);
            this.btnpoint.Name = "btnpoint";
            this.btnpoint.Size = new System.Drawing.Size(36, 25);
            this.btnpoint.TabIndex = 38;
            this.btnpoint.Text = ".";
            this.btnpoint.UseVisualStyleBackColor = true;
            // 
            // btnminus
            // 
            this.btnminus.Location = new System.Drawing.Point(229, 154);
            this.btnminus.Name = "btnminus";
            this.btnminus.Size = new System.Drawing.Size(36, 25);
            this.btnminus.TabIndex = 37;
            this.btnminus.Text = "-";
            this.btnminus.UseVisualStyleBackColor = true;
            this.btnminus.Click += new System.EventHandler(this.operator_click);
            // 
            // btn0
            // 
            this.btn0.Location = new System.Drawing.Point(109, 193);
            this.btn0.Name = "btn0";
            this.btn0.Size = new System.Drawing.Size(73, 25);
            this.btn0.TabIndex = 36;
            this.btn0.Text = "0";
            this.btn0.UseVisualStyleBackColor = true;
            this.btn0.Click += new System.EventHandler(this.btn1_Click);
            // 
            // btn9
            // 
            this.btn9.Location = new System.Drawing.Point(190, 154);
            this.btn9.Name = "btn9";
            this.btn9.Size = new System.Drawing.Size(36, 25);
            this.btn9.TabIndex = 35;
            this.btn9.Text = "9";
            this.btn9.UseVisualStyleBackColor = true;
            this.btn9.Click += new System.EventHandler(this.btn1_Click);
            // 
            // btn8
            // 
            this.btn8.Location = new System.Drawing.Point(192, 115);
            this.btn8.Name = "btn8";
            this.btn8.Size = new System.Drawing.Size(32, 25);
            this.btn8.TabIndex = 34;
            this.btn8.Text = "8";
            this.btn8.UseVisualStyleBackColor = true;
            this.btn8.Click += new System.EventHandler(this.btn1_Click);
            // 
            // btn7
            // 
            this.btn7.Location = new System.Drawing.Point(192, 74);
            this.btn7.Name = "btn7";
            this.btn7.Size = new System.Drawing.Size(32, 25);
            this.btn7.TabIndex = 33;
            this.btn7.Text = "7";
            this.btn7.UseVisualStyleBackColor = true;
            this.btn7.Click += new System.EventHandler(this.btn1_Click);
            // 
            // btn6
            // 
            this.btn6.Location = new System.Drawing.Point(148, 154);
            this.btn6.Name = "btn6";
            this.btn6.Size = new System.Drawing.Size(32, 25);
            this.btn6.TabIndex = 32;
            this.btn6.Text = "6";
            this.btn6.UseVisualStyleBackColor = true;
            this.btn6.Click += new System.EventHandler(this.btn1_Click);
            // 
            // btn5
            // 
            this.btn5.Location = new System.Drawing.Point(150, 115);
            this.btn5.Name = "btn5";
            this.btn5.Size = new System.Drawing.Size(32, 25);
            this.btn5.TabIndex = 31;
            this.btn5.Text = "5";
            this.btn5.UseVisualStyleBackColor = true;
            this.btn5.Click += new System.EventHandler(this.btn1_Click);
            // 
            // btn4
            // 
            this.btn4.Location = new System.Drawing.Point(150, 74);
            this.btn4.Name = "btn4";
            this.btn4.Size = new System.Drawing.Size(30, 25);
            this.btn4.TabIndex = 30;
            this.btn4.Text = "4";
            this.btn4.UseVisualStyleBackColor = true;
            this.btn4.Click += new System.EventHandler(this.btn1_Click);
            // 
            // btn3
            // 
            this.btn3.Location = new System.Drawing.Point(109, 154);
            this.btn3.Name = "btn3";
            this.btn3.Size = new System.Drawing.Size(30, 25);
            this.btn3.TabIndex = 29;
            this.btn3.Text = "3";
            this.btn3.UseVisualStyleBackColor = true;
            this.btn3.Click += new System.EventHandler(this.btn1_Click);
            // 
            // btn2
            // 
            this.btn2.Location = new System.Drawing.Point(109, 114);
            this.btn2.Name = "btn2";
            this.btn2.Size = new System.Drawing.Size(30, 25);
            this.btn2.TabIndex = 28;
            this.btn2.Text = "2";
            this.btn2.UseVisualStyleBackColor = true;
            this.btn2.Click += new System.EventHandler(this.btn1_Click);
            // 
            // btnPlus
            // 
            this.btnPlus.Location = new System.Drawing.Point(229, 114);
            this.btnPlus.Name = "btnPlus";
            this.btnPlus.Size = new System.Drawing.Size(36, 25);
            this.btnPlus.TabIndex = 27;
            this.btnPlus.Text = "+";
            this.btnPlus.UseVisualStyleBackColor = true;
            this.btnPlus.Click += new System.EventHandler(this.operator_click);
            // 
            // btnEqual
            // 
            this.btnEqual.Location = new System.Drawing.Point(266, 154);
            this.btnEqual.Name = "btnEqual";
            this.btnEqual.Size = new System.Drawing.Size(41, 64);
            this.btnEqual.TabIndex = 26;
            this.btnEqual.Text = "=";
            this.btnEqual.UseVisualStyleBackColor = true;
            this.btnEqual.Click += new System.EventHandler(this.btnEqual_Click);
            // 
            // btn1
            // 
            this.btn1.Location = new System.Drawing.Point(109, 74);
            this.btn1.Name = "btn1";
            this.btn1.Size = new System.Drawing.Size(30, 25);
            this.btn1.TabIndex = 25;
            this.btn1.Text = "1";
            this.btn1.UseVisualStyleBackColor = true;
            this.btn1.Click += new System.EventHandler(this.btn1_Click);
            // 
            // equation
            // 
            this.equation.AutoSize = true;
            this.equation.Location = new System.Drawing.Point(117, 40);
            this.equation.Name = "equation";
            this.equation.Size = new System.Drawing.Size(35, 13);
            this.equation.TabIndex = 44;
            this.equation.Text = "label1";
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(800, 450);
            this.Controls.Add(this.equation);
            this.Controls.Add(this.result);
            this.Controls.Add(this.btnclear);
            this.Controls.Add(this.btnCE);
            this.Controls.Add(this.btndiv);
            this.Controls.Add(this.btnmultiple);
            this.Controls.Add(this.btnpoint);
            this.Controls.Add(this.btnminus);
            this.Controls.Add(this.btn0);
            this.Controls.Add(this.btn9);
            this.Controls.Add(this.btn8);
            this.Controls.Add(this.btn7);
            this.Controls.Add(this.btn6);
            this.Controls.Add(this.btn5);
            this.Controls.Add(this.btn4);
            this.Controls.Add(this.btn3);
            this.Controls.Add(this.btn2);
            this.Controls.Add(this.btnPlus);
            this.Controls.Add(this.btnEqual);
            this.Controls.Add(this.btn1);
            this.Name = "Form1";
            this.Text = "Calculator";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox result;
        private System.Windows.Forms.Button btnclear;
        private System.Windows.Forms.Button btnCE;
        private System.Windows.Forms.Button btndiv;
        private System.Windows.Forms.Button btnmultiple;
        private System.Windows.Forms.Button btnpoint;
        private System.Windows.Forms.Button btnminus;
        private System.Windows.Forms.Button btn0;
        private System.Windows.Forms.Button btn9;
        private System.Windows.Forms.Button btn8;
        private System.Windows.Forms.Button btn7;
        private System.Windows.Forms.Button btn6;
        private System.Windows.Forms.Button btn5;
        private System.Windows.Forms.Button btn4;
        private System.Windows.Forms.Button btn3;
        private System.Windows.Forms.Button btn2;
        private System.Windows.Forms.Button btnPlus;
        private System.Windows.Forms.Button btnEqual;
        private System.Windows.Forms.Button btn1;
        private System.Windows.Forms.Label equation;
    }
}

