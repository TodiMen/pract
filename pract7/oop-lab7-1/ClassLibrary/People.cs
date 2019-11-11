using System;
using System.Collections.Generic;
using System.Text;

namespace ClassLibrary
{
    public class People
    {
        public string Name { set; get; }
        public string Surname { set; get; }
        public string DateOfBirth { set; get; }

        public People() { }
        public People(string name, string surname, string dateOfBirth)
        {
            Name = name;
            Surname = surname;
            DateOfBirth = dateOfBirth;
        }
        public People(People prevPeople)
        {
            Name = prevPeople.Name;
            Surname = prevPeople.Surname;
            DateOfBirth = prevPeople.DateOfBirth;
        }

        public virtual void ShowInfo()
        {
            Console.WriteLine(new String('-', 50));
            Console.WriteLine("People");
            Console.WriteLine($"Name: {Name}");
            Console.WriteLine($"Surname: {Surname}");
            Console.WriteLine($"DateOfBirth: {DateOfBirth}");
        }
    }
}
