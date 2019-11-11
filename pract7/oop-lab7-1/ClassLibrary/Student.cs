using System;
using System.Collections.Generic;
using System.Text;

namespace ClassLibrary
{
    public class Student : Abiturient
    {
        public int Kurs { set; get; }
        public string Gruppa { set; get; }
        public string Fakultet { set; get; }
        public string NavchZaklad { set; get; }

        public Student() { }
        public Student(int kurs, string gruppa, string fakultet, string navchZaklad, Abiturient abit) : base(abit)
        {
            Kurs = kurs;
            Gruppa = gruppa;
            Fakultet = fakultet;
            NavchZaklad = navchZaklad;
        }
        public Student(Student prevStudent) : base(prevAbit: prevStudent)
        {
            Kurs = prevStudent.Kurs;
            Gruppa = prevStudent.Gruppa;
            Fakultet = prevStudent.Fakultet;
            NavchZaklad = prevStudent.NavchZaklad;
        }
        public override void ShowInfo()
        {
            base.ShowInfo();
            Console.WriteLine("\nStudent");
            Console.WriteLine($"Kurs: {Kurs}");
            Console.WriteLine($"Gruppa: {Gruppa}");
            Console.WriteLine($"Fakultet: {Fakultet}");
            Console.WriteLine($"NavchZaklad: {NavchZaklad}");
        }
    }
}
