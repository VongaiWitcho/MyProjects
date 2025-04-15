using System.ComponentModel;
using System.Reflection;

namespace tic_tac_toe_official
{
    public partial class Form1 : Form
    {
        bool turn = true; //true is X's turn and false is Y's turn
        int turn_count = 0;
        public Form1()
        {
            InitializeComponent();
        }

        private void exitToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void R1C1_Click(object sender, EventArgs e)
        {

        }

        private void Button_Click(object sender, EventArgs e)
        {
            Button b = (Button)sender;
            if (turn)
                b.Text = "X";
            else
                b.Text = "O";
            turn = !turn;
            b.Enabled = false;
            lookforwinner();
            turn_count++;
        }
        private void lookforwinner()
        {
            //horizontal checks
            bool winner_present = false;
 
            if (R1C1.Text == R1C2.Text) && (R1C2.Text == R1C3.Text) && (!R1C1.Enabled)
                winner = true;
            else if (R2C1.Text == R2C2.Text) && (R2C2.Text == R2C3.Text) && (!R2C1.Enabled);
                    winner = true;
            else if (R3C1.Text == R3C2.Text) && (R3C2.Text == R3C3.Text) && (!R3C1.Enabled);
                    winner = true;

            //vertical checks
            else if (R1C1.Text == R2C1.Text) && (R2C1.Text == R3C1.Text) && (!R1C1.Enabled);
                    winner = true;
            else if (R1C2.Text == R2C2.Text) && (R2C2.Text == R3C2.Text) && (!R1C2.Enabled);
                    winner = true;
            else if (R1C3.Text == R2C3.Text) && (R2C3.Text == R3C3.Text) && (!R1C3.Enabled);
                    winner = true;

            //diagonals ckecks
            else if (R1C1.Text == R2C2.Text) && (R2C2.Text == R3C3.Text) && (!R1C1.Enabled);
                    winner = true;
            else if (R1C3.Text == R2C2.Text) && (R2C2.Text == R3C1.Text) && (!R3C1.Enabled);
                    winner = true;


            if (winner_present)
            {
                disableButtons();
                String winner = "";
                if (turn)
                    winner = "0";
                else winner = "X";

                MessageBox.Show("Player" + winner + "Has won !");
            }
            else
            {
                if (turn_count == 9)
                    MessageBox.Show("It's a draw !");
            }
        }
        private void disableButtons()
        {
            try
            {
                foreach (Control c in Controls)
                {
                    Button b = (Button)c;
                    b.Enabled = false;
                }
            }
            catch { }
        }

        private void newGameToolStripMenuItem_Click(object sender, EventArgs e)
        {
            turn = true;
            turn_count = 0;
            try
            {
                foreach (Control c in Controls)
                {
                    Button b = (Button)c;
                    b.Enabled = true;
                    b.Text = "";
                }
            }
            catch { }
        }
    }
}