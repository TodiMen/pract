using System;
using System.Collections.Generic;
using System.Text;

namespace ClassLibrary
{
    public class Vykladach : People
    {
        public string Posada { set; get; }
        public string Kafedra { set; get; }
        public string NavchZaklad { set; get; }

        public Vykladach() { }
        public Vykladach(string posada, string kafedra, string navchZaklad, People people) : base(people)
        {
            Posada = posada;
            Kafedra = kafedra;
            NavchZaklad = navchZaklad;
        }
        public override void ShowInfo()
        {
            base.ShowInfo();
            Console.WriteLine("\nVykladach");
            Console.WriteLine($"Posada: {Posada}");
            Console.WriteLine($"Kafedra: {Kafedra}");
            Console.WriteLine($"NavchZaklad: {NavchZaklad}");
        }
    }
}
