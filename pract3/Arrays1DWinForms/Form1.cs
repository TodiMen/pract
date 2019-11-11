using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Arrays1DWinForms
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        double[] d;
        private void Button1_Click(object sender, EventArgs e)
        {
            int n = Convert.ToInt32(numericUpDownCount.Value);
            d = new double[n];

            dataGridViewArray.RowCount = 1;
            dataGridViewArray.ColumnCount = n;

            Random rnd = new Random();

            for (int i = 0; i < d.Length; i++)
            {
                d[i] = rnd.Next(-42312, 7003) / 1000.0;
                dataGridViewArray[i, 0].Value = d[i];
                dataGridViewArray.Columns[i].HeaderText = i.ToString();
            }
        }

        private void Button2_Click(object sender, EventArgs e)
        {
            double sum = 0;
            for (int i = 0; i < d.Length; i += 2)
            {
                if (d[i] > 0)
                {
                    sum += d[i];
                }
            }

            double temp;
            int k = Convert.ToInt32(numericUpDownSort.Value);
            if(k > d.Length)
            {
                MessageBox.Show($"Введіть число менше {d.Length + 1}");
                return;
            }
            for (int i = d.Length - k; i < d.Length; i++)
            {
                for (int j = d.Length - k; j < d.Length - 1; j++)
                {
                    if (d[j] < d[j + 1])
                    {
                        temp = d[j];
                        d[j] = d[j + 1];
                        d[j + 1] = temp;
                    }
                }
            }

            for (int j = d.Length - k; j < d.Length; j++)
            {
                dataGridViewArray[j, 0].Value = d[j];
            }

            textBoxSumma.Text = sum.ToString();
        }

    }
}
