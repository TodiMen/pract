using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

/*. 1. Bизначити кількість рядків, які не містять жодного від’ємного елемента.
2. Переставити рядки матриці, розміщуючи їх за спаданням сум елементів у рядках.
*/
namespace Arrays2DWinForms
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        double[,] d;
        private void Button1_Click(object sender, EventArgs e)
        {
            int m = Convert.ToInt32(numericUpDownRowCount.Value);
            int n = Convert.ToInt32(numericUpDownColumnCount.Value);
            d = new double[n, m];

            Random rnd = new Random();

            for (int i = 0; i < n; i++)
            {
                for (int j = 0; j < m; j++)
                {
                    d[i, j] = rnd.Next(-29, 603) / 10.0;
                    Console.Write($"{d[i, j]} | ");
                }
                Console.WriteLine();
            }

            //Щоб додати номери рядків у таблицю, використовуйте такий код:
            for (int j = 0; j < m; j++)
            {
                dataGridViewMatrix.Rows[j].HeaderCell.Value = j.ToString();
            }

            //Щоб додати номери стовпцівта заборонити їх сортування користувачем:
            for (int i = 0; i < n; i++)
            {
                dataGridViewMatrix.Columns[i].HeaderText = i.ToString();
                dataGridViewMatrix.Columns[i].SortMode = DataGridViewColumnSortMode.NotSortable;
            }

        }

        //Для того, щоб у початковому заголовочному стовпчику не промальовувалася стрілочка, додайте обробник події CellPainting з таким кодом:
        private void DataGridViewMatrix_CellPainting(object sender, DataGridViewCellPaintingEventArgs e)
        {
            if (e.ColumnIndex == -1 && e.RowIndex > -1)
            {
                e.PaintBackground(e.CellBounds, true);
                using (SolidBrush br = newSolidBrush(Color.Black))
                {
                    StringFormat sf = newStringFormat();
                    sf.Alignment = StringAlignment.Center;
                    sf.LineAlignment = StringAlignment.Center;
                    e.Graphics.DrawString(e.RowIndex.ToString(),
                    e.CellStyle.Font, br, e.CellBounds, sf);
                }
                e.Handled = true;
            }

        }

        private StringFormat newStringFormat()
        {
            throw new NotImplementedException();
        }

        private SolidBrush newSolidBrush(Color black)
        {
            throw new NotImplementedException();
        }
    }
}
