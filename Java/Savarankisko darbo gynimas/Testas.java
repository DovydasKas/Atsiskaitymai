/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studPaketas;

import java.io.*;
public class Testas {
    public static void main(String[] args) throws IOException {
	BufferedReader buf = new BufferedReader(new InputStreamReader(System.in));
	MetodaiIrasui met = new MetodaiIrasui();
        
	try {                
                Studentas kor_stud = new Studentas();
                Studentas sarasas[] = null;
                sarasas = met.skaitytiXML();
                met.suvestine(sarasas, "visi");
               
//Koregavimas                
               System.out.println("Kuri irasa koreguosime?: ");
               while(true) {
    	    	        int kor_nr = Integer.parseInt(buf.readLine())-1;
                        //System.out.println("Koreguosiu " + kor_nr);
                        kor_stud = met.koreguoti_st(sarasas[kor_nr]);
                        sarasas[kor_nr] = kor_stud;
		        break;
		} 
               
               System.out.println("Sarasas po korekciju: ");
                met.suvestine(sarasas, "visi");
                
//Salinimas
               System.out.println("Kuri irasa salinsime?: ");
               while(true) {
    	    	        int kor_nr = Integer.parseInt(buf.readLine())-1;
                        //System.out.println("Koreguosiu " + kor_nr);
                        System.out.println("Sarasas po salinimo: ");
                        met.suvestine(met.salinti(sarasas, kor_nr) , "visi");
		        break;
		} 
                
                //System.out.print("Iveskite zodi visi arba kursa: ");
		//s = buf.readLine();
                //met.kurso_vidurkis(sarasas, s);
	} catch (NumberFormatException qq) {
		    System.out.println("Blogas įrašų skaičius - sąrasas neformuojamas ");
	}
        
	System.out.println("Pabaiga");
    }

}
