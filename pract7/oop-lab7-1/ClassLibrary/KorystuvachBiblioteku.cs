using System;
using System.Collections.Generic;
using System.Text;

namespace ClassLibrary
{
    public class KorystuvachBiblioteku : Student
    {
        public int NomerChytKvytka { set; get; }
        public string DataVydachi { set; get; }
        public float RozmirVnesku { set; get; }

        public KorystuvachBiblioteku() { }
        public KorystuvachBiblioteku(int nomerChytKvytka, string dataVydachi, float rozmirVnesku, Student st) : base(prevStudent: st)
        {
            NomerChytKvytka = nomerChytKvytka;
            DataVydachi = dataVydachi;
            RozmirVnesku = rozmirVnesku; 
        }
        public override void ShowInfo()
        {
            base.ShowInfo();
            Console.WriteLine("\nKorystuvachBiblioteku");
            Console.WriteLine($"NomerChytKvytka: {NomerChytKvytka}");
            Console.WriteLine($"DataVydachi: {DataVydachi}");
            Console.WriteLine($"RozmirVnesku: {RozmirVnesku}");
        }
    }
}
