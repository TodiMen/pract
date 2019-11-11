using System;
using System.Collections.Generic;
using System.Text;

namespace ClassLibrary
{
    public class Abiturient : People
    {
        public int ZNO_bal { set; get; }
        public int DocumentBal { set; get; }
        public string NazvaZakladu { set; get; }

        public Abiturient() { }
        public Abiturient(int zno_bal, int documentBal, string nazvaZakladu,
            People people) : base(people)
        {
            ZNO_bal = zno_bal;
            DocumentBal = documentBal;
            NazvaZakladu = nazvaZakladu;
        }
        public Abiturient(Abiturient prevAbit) : base(prevPeople: prevAbit)
        {
            ZNO_bal = prevAbit.ZNO_bal;
            DocumentBal = prevAbit.DocumentBal;
            NazvaZakladu = prevAbit.NazvaZakladu;
        }
        public override void ShowInfo()
        {
            base.ShowInfo();
            Console.WriteLine("\nAbiturient");
            Console.WriteLine($"ZNO_bal: {ZNO_bal}");
            Console.WriteLine($"DocumentBal: {DocumentBal}");
            Console.WriteLine($"NazvaZakladu: {NazvaZakladu}");
        }
    }
}
