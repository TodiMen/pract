using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace oop_lab8
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Paint(object sender, PaintEventArgs e)
        {
            one();
        }

        private void Form1_Resize(object sender, EventArgs e)
        {
            one();
        }

        void one()
        {
            Graphics g = this.CreateGraphics(); // задаємо область малювання
            g.Clear(Color.White); //очищуємо область (заливаємо білим кольором)
            Pen a = new Pen(Color.Blue, 1); // ручка для малювання вісі
            Pen b = new Pen(Color.Green, 2); // ручка для малювання графіка
            Font drawFont = new Font("Arial", 12); // шрифт, яким будем підписувати вісі
            Font signatureFont = new Font("Arial", 7); //шрифт, яким будем підписувати ділення вісі
            SolidBrush drawBrush = new SolidBrush(Color.Blue); // колір цього шрифта
            StringFormat drawFormat = new StringFormat(); // формат букв (для підписування)
            drawFormat.FormatFlags = StringFormatFlags.DirectionRightToLeft; // напрямок тектсу

            int sizeWidth = Form1.ActiveForm.Width; // ширина вікна програми
            int sizeHeight = Form1.ActiveForm.Height; // висота вікна програми
            // x, y - координати центра (точки 0)
            Point center = new Point((int)(sizeWidth / 2 - 8), (int)(sizeHeight / 2 - 19));
             

            // Додаємо код для малювання осей та виведення підписів до них

            g.DrawLine(a, 10, center.Y, center.X, center.Y);  // вісь Х-
            g.DrawLine(a, center.X, center.Y, 2 * center.X - 10, center.Y); // вісь Х+
            g.DrawLine(a, center.X, 10, center.X, center.Y); // вісь У+
            g.DrawLine(a, center.X, center.Y, center.X, 2 * center.Y - 10);// вісь У-

            g.DrawString("X", drawFont, drawBrush, new Point(2 * center.X - 5, center.Y + 10), drawFormat); // підписуємо Х
            g.DrawString("Y", drawFont, drawBrush, new Point(center.X + 30, 5), drawFormat); // підписуємо У
            g.DrawString("0", drawFont, drawBrush, new Point(center.X - 1, center.Y + 2), drawFormat);// підписуємо 0

            g.DrawLine(a, center.X, 10, center.X + 5, 20); // стрілка У+;
            g.DrawLine(a, center.X, 10, center.X - 5, 20); // стрілка У-;
            g.DrawLine(a, 2 * center.X - 10, center.Y, 2 * center.X - 20, center.Y - 5); // стрілка X+;
            g.DrawLine(a, 2 * center.X - 10, center.Y, 2 * center.X - 20, center.Y + 5); // стрілка X-;

            int stepForAxes = 25; // відстань між діленнями на вісях
            int lengthShtrih = 3; // половина довжини штриха ділення
            int maxValueForAxesX = 4; // максимальне значення по вісі Х
            int maxValueForAxesY = 9; // по вісі У

            //те, чим підписувати ділення Х
            float oneDelenieX = (float)maxValueForAxesX / ((float)center.X / (float)stepForAxes);
            //те, чим підписувати ділення У
            float oneDelenieY = (float)maxValueForAxesY / ((float)center.Y / (float)stepForAxes);

            for (int i = center.X, j = center.X, k = 1; i < 2 * center.X - 30; j -= stepForAxes, i += stepForAxes, k++) {
                //малюємо штрихи по вісі Х вправо від центра
                g.DrawLine(a, i, center.Y - lengthShtrih, i, center.Y + lengthShtrih);
                //малюємо штрихи по вісі Х вліво від центра
                g.DrawLine(a, j, center.Y - lengthShtrih, j, center.Y + lengthShtrih);

                if(i < 2 * center.X - 55)
                {
                    g.DrawString((k * oneDelenieX).ToString("0.0"), signatureFont, drawBrush, 
                        new PointF(i + stepForAxes + 9, center.Y + 6), drawFormat); //підписуємо ділення +
                    g.DrawString((k * oneDelenieX).ToString("0.0").ToString() + "-", signatureFont, drawBrush, 
                        new PointF(j - stepForAxes + 9, center.Y + 6), drawFormat); //підписуємо ділення -
                }
            }

            for (int i = center.Y, j = center.Y, k = 1; i < 2 * center.Y - 30; j -= stepForAxes, i += stepForAxes, k++)
            {
                //малюємо штрихи по вісі Y вправо від центра     
                g.DrawLine(a, center.X - lengthShtrih, i, center.X + lengthShtrih, i);
                g.DrawLine(a, center.X - lengthShtrih, j, center.X + lengthShtrih, j);

                if (i < 2 * center.Y - 55)
                {

                    g.DrawString((k * oneDelenieX).ToString("0.0"), signatureFont, drawBrush,
                        new PointF(center.X + 25, j - stepForAxes - 4), drawFormat); //підписуємо ділення +
                    g.DrawString((k * oneDelenieX).ToString("0.0").ToString() + "-", signatureFont, drawBrush,
                        new PointF(center.X + 25, i + stepForAxes - 4), drawFormat); //підписуємо ділення -
                }
            }

            // Далі розраховуємо значення функції на заданому интервалі, і побудуємо по цим значенням графік

            int numOfPoint = 100; // кількість точок для розрахування значення функції

            float[] first = new float[numOfPoint]; // точки для розрахування

            for(int i = 0; i < numOfPoint; i++)
            {
                // інтервал від -2 до 2
                first[i] = (float)maxValueForAxesX / (float)numOfPoint * (i + 1) - (float)(maxValueForAxesX / 2);
            }

            float[] second = new float[numOfPoint]; // значення в точках для розрахування
            for(int i = 0; i < numOfPoint; i++)
            {
                second[i] = (float)(Math.Exp(first[i] / 2) * Math.Sin(2 * first[i])); // сама функція
            }

            Point[] pointOne = new Point[numOfPoint];
            float tempX = 1 / oneDelenieX * stepForAxes; // розраховуємо нові координати
            float tempY = 1 / oneDelenieY * stepForAxes;

            for(int i = 0; i < numOfPoint; i++)
            {
                pointOne[i].X = center.X + (int)(first[i] * tempX); // перехід до нових координат
                pointOne[i].Y = center.Y - (int)(second[i] * tempY);
            }

            g.DrawCurve(b, pointOne);

            for(int i = 0; i < numOfPoint; i++)
            {
                chart1.Series[0].Points.AddXY(first[i], second[i]);
            }
        }
    }
}
