using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace _2nd_proper_calculatorWindowsFormsApp1
{
    public partial class Form1 : Form
    {
        Double value = 0;
        String operation = "";
        bool operation_clicked = false;
        public Form1()
        {
            InitializeComponent();
        }

        private void btn1_Click(object sender, EventArgs e)
        {
            if (result.Text == "0" || operation_clicked == true){
                result.Clear(); }
            Button b = (Button)sender; //to pass the object as a diff datatype
            //the object is the item eg 1, what is exactle edited on the form
            result.Text = result.Text + b.Text;// 0 plus object
            operation_clicked = false;//to enable multiple digit input by going back to clear so more digits can be input
        }

        private void btnCE_Click(object sender, EventArgs e)
        {
            result.Text = "0"; //displays 0 on screen
        }

        private void operator_click(object sender, EventArgs e)
        {
            Button b = (Button)sender;//to capture what button we pressed
            operation = b.Text; //captures the value of the operator input ie that on button
            value = Double.Parse(result.Text); //this captures the value in the textbox..ie the first number input
            operation_clicked = true;//this resets to typing a new number by going back to the if statement
            equation.Text = result.Text + ""+ operation; // equation.Text now contains the value input and the operator
            //equation.Text = value "" + operation;
        }


        private void btnEqual_Click(object sender, EventArgs e)
        {
            
            equation.Text = ""; //the contents in equation.Text are shown after equal is clicked 
            // i have a question though because nothing is being assigned to equation.Text so how does it have the
            //previous output
            switch (operation)
            {
                case "+":
                    result.Text = (value + Double.Parse(result.Text)).ToString();//in this case value stores the previous
                    // and result holds the current
                    break;
                case "-":
                    result.Text = (value - Double.Parse(result.Text)).ToString();
                    break;
                case "/":

                    double d = (Convert.ToDouble(result.Text));

                    if (d == 0)
                    {
                        result.Text = "Error";
                    }
                    else
                    {
                        result.Text = (value / Double.Parse(result.Text)).ToString();

                    }
                    break;
                case "*":
                    result.Text = (value * Double.Parse(result.Text)).ToString();
                    break;
                default:
                    break;

            }
            
        }

        private void btnclear_Click(object sender, EventArgs e)
        {
            result.Text = "0";
            value = 0;
        }
    }//put error message for division by zero try and catch
}
