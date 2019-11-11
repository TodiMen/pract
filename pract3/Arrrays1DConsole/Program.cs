using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Arrrays1DConsole
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.Write("Кiлькiсть елементiв масиву: ");
            int n = Convert.ToInt32(Console.ReadLine());

            Random rnd = new Random();
            double[] d = new double[n];
            double sum = 0;

            Console.Write("Array: ");
            for(int i = 0; i < d.Length; i++)
            {
                d[i] = rnd.Next(-1051, 1053) / 100.0;
                Console.Write($"{d[i]} | ");
            }

            for(int i = 0; i < d.Length; i+= 3)
            {
                if(d[i] > 0)
                {
                    sum += d[i];
                }
            }
            Console.WriteLine($"\nСума додатних елементiв з iндексами, якi дiляться на 3 = {sum}");
            double temp;

            for(int i = 0; i < d.Length; i++)
            {
                for (int j = 0; j < d.Length/2; j++)
                {
                    if (d[j] < d[j + 1]) {
                        temp = d[j];
                        d[j] = d[j + 1];
                        d[j + 1] = temp;
                    }
                }
            }

            Console.Write("Array: ");
            foreach (double dx in d)
            {
                Console.Write($"{dx} | ");
            }

            Console.ReadKey();
        }
    }
}
