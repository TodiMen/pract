using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            comboBoxMaterial.SelectedIndex = 0;
        }

        private void ButtonResult_Click(object sender, EventArgs e)
        {
            double price = 0;
            double width = Convert.ToDouble(textBoxWidth.Text);
            double height = Convert.ToDouble(textBoxHeight.Text);


            if (radioButtonOneCam.Checked && comboBoxMaterial.SelectedIndex == 0)
            {
                price = Math.Pow(width * 0.25, 2) + Math.Pow(height * 0.25, 2);
            }

            if (radioButtonOneCam.Checked && comboBoxMaterial.SelectedIndex == 1)
            {
                price = Math.Pow(width * 0.05, 2) + Math.Pow(height * 0.05, 2);
            }

            if (radioButtonOneCam.Checked && comboBoxMaterial.SelectedIndex == 2)
            {
                price = Math.Pow(width * 0.15, 2) + Math.Pow(height * 0.15, 2);
            }

            if (radioButtonTwoCam.Checked && comboBoxMaterial.SelectedIndex == 0)
            {
                price = Math.Pow(width * 0.3, 2) + Math.Pow(height * 0.3, 2);
            }

            if (radioButtonTwoCam.Checked && comboBoxMaterial.SelectedIndex == 1)
            {
                price = Math.Pow(width * 0.1, 2) + Math.Pow(height * 0.1, 2);
            }

            if (radioButtonTwoCam.Checked && comboBoxMaterial.SelectedIndex == 2)
            {
                price = Math.Pow(width * 0.2, 2) + Math.Pow(height * 0.2, 2);
            }

            if (checkBoxWindowsill.Checked)
            {
                price += 35;
            }

            labelPrice.Text = "Вартість: " + price + "грн";
        }
    }
}
