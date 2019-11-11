using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using ClassLibrary1;

namespace ПР2
{
    class Program
    {

        //читає з клавіатури дані і повертає масив об’єктів типу Student
        static Student[] ReadStudentsArray()
        {
            string subject, teacher;
            int points;
            string name, surname, group;
            int year;
            double price;
            string paymentTime;
            
            int exam;

            Console.WriteLine("Введiть кiлькiсть студентiв: ");
            int n = Convert.ToInt32(Console.ReadLine());
            Student[] students = new Student[n];

            for (int i = 0; i < n; i++)
            {
                Console.WriteLine($"Студент {i + 1}");
                Console.WriteLine("Введiть iм`я студента: ");
                name = Console.ReadLine();

                Console.WriteLine("Введiть прiзвище студента: ");
                surname = Console.ReadLine();

                Console.WriteLine("Введiть шифр групи студента: ");
                group = Console.ReadLine();

                Console.WriteLine("Введiть номер курсу студента: ");
                year = Convert.ToInt32(Console.ReadLine());

                Console.WriteLine("Скiльки екзаменiв здавав студент? ");
                exam = Convert.ToInt32(Console.ReadLine());

                Result[] result = new Result[exam];
                for (int j = 0; j < exam; j++)
                {
                    Console.WriteLine($"Предмет {j + 1}");
                    Console.WriteLine("Назва предмета: ");
                    subject = Console.ReadLine();
                    Console.WriteLine("ПIБ викладача: ");
                    teacher = Console.ReadLine();
                    Console.WriteLine("Оцiнка: ");
                    points = Convert.ToInt32(Console.ReadLine());
                    Console.WriteLine();

                    result[j] = new Result(subject, teacher, points);
                }
                Console.WriteLine("За який перiод буде виконана оплата? (1 - мiсяць, 2 - рiк, 3 - весь час)");
                n = Convert.ToInt32(Console.ReadLine());
                Console.WriteLine("Введіть суму: ");
                price = Convert.ToDouble(Console.ReadLine());
                switch (n)
                {
                    case 1:
                        paymentTime = "month";
                        break;
                    case 2:
                        paymentTime = "year";
                        break;
                    case 3:
                        paymentTime = "all of time";
                        break;
                    default:
                        Console.WriteLine("Такого варіанту немає!");
                        i--;
                        continue;
                }

                students[i] = new Student(name, surname, group, year, result, price, paymentTime);
            }
            return students;
        }

        //приймає об’єкт типу Student і виводить його на екран
        static void PrintStudent(Student stude)
        {
            Console.WriteLine($"Iм'я: {stude.Name}");
            Console.WriteLine($"Прiзвище: {stude.Surname}");
            Console.WriteLine($"Група: {stude.Group}");
            Console.WriteLine($"Курс: {stude.Year}");
            Console.WriteLine("Оплата за навчання: ");
            stude.printPrice();

            for( int i = 0; i < stude.Results.Count(); i++)
            {
                Console.WriteLine($"Предмет {i + 1}");
                Console.WriteLine($"Назва предмета: {stude.Results[i].Subject}");
                Console.WriteLine($"ПIБ викладача: {stude.Results[i].Teacher}");
                Console.WriteLine($"Оцiнка: {stude.Results[i].Points}");
            }
        }

        //приймає масив об’єктів типу Student і виводить його на екран
        static void PrintStudents(Student[] stude)
        {
            for(int i = 0; i < stude.Count(); i++)
            {
                Console.WriteLine($"Iм'я: {stude[i].Name}");
                Console.WriteLine($"Прiзвище: {stude[i].Surname}");
                Console.WriteLine($"Група: {stude[i].Group}");
                Console.WriteLine($"Курс: {stude[i].Year}");
                Console.WriteLine("Оплата за навчання: ");
                stude[i].printPrice();

                for (int j = 0; j < stude[i].Results.Count(); j++)
                {
                    Console.WriteLine($"Предмет {j + 1}");
                    Console.WriteLine($"Назва предмета: {stude[i].Results[j].Subject}");
                    Console.WriteLine($"ПIБ викладача: {stude[i].Results[j].Teacher}");
                    Console.WriteLine($"Оцiнка: {stude[i].Results[j].Points}");
                }
            }
        }

        //приймає масив об’єктів типу Student 
        //і повертає через out-параметри найвищий середній бал та найнижчий середній бал
        static void GetStudentsInfo(Student[] stude, out double MaxAveragePoint, out double MinAveragePoint)
        {
            MaxAveragePoint = 0;
            MinAveragePoint = 101;

            for(int i = 0; i < stude.Count(); i++)
            {
                if (stude[i].GetAveragePoints() > MaxAveragePoint) {
                    MaxAveragePoint = stude[i].GetAveragePoints();
                }

                if (stude[i].GetAveragePoints() < MinAveragePoint)
                {
                    MinAveragePoint = stude[i].GetAveragePoints();
                }
            }
        }

        //приймає масив об’єктів типу Student і сортує його за середнім балом студента
        static void SortStudentsByPoints(Student[] stude)
        {
            Array.Sort(stude, (s1, s2) => s1.GetAveragePoints().CompareTo(s2.GetAveragePoints()));       
        }

        //приймає масив об’єктів типу Student і сортує його за прізвищем 
        static void SortStudentsByName(Student[] stude)
        {
            Array.Sort(stude, (s1, s2) => s1.Surname.CompareTo(s2.Surname));
        }

        static void Main(string[] args)
        {
            bool isExit = false;
            int n, s;
            double MinPoint, MaxPoint;
            Student[] stude = ReadStudentsArray();
            while (!isExit)
            {
                Console.WriteLine();
                Console.WriteLine("1. Вивести iнформацiю про одного студента.");
                Console.WriteLine("2. Вивести iнформацiю про всiх студентiв.");
                Console.WriteLine("3. Вивести найвищий та найнижчий середнiй бал.");
                Console.WriteLine("4. Посортувати студентiв за середнiм балом.");
                Console.WriteLine("5. Посортувати студентiв за прiзвищем.");
                Console.WriteLine("6. Вихiд.");

                n = Convert.ToInt32(Console.ReadLine());
                Console.WriteLine();

                switch (n)
                {
                    case 1:
                        Console.WriteLine($"Введiть порядковий номер студента: 0-{stude.Count() - 1} : ");
                        s = Convert.ToInt32(Console.ReadLine());
                        PrintStudent(stude[s]);
                        break;
                    case 2:
                        PrintStudents(stude);
                        break;
                    case 3:
                        GetStudentsInfo(stude, out MaxPoint, out MinPoint);
                        Console.WriteLine($"Мiнiмальний бал: {MinPoint}");
                        Console.WriteLine($"Максимальний бал: {MaxPoint}");
                        break;
                    case 4:
                        SortStudentsByPoints(stude);
                        break;
                    case 5:
                        SortStudentsByName(stude);
                        break;
                    case 6:
                        isExit = true;
                        break;
                    default:
                        Console.WriteLine("Такого варiанту не iснує!");
                        break;
                }
                Console.WriteLine();
            }

        }
    }
}
