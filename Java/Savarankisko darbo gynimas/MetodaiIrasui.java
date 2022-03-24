/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studPaketas;

import java.io.*;
import java.util.*;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import javax.xml.xpath.XPath;
import javax.xml.xpath.XPathConstants;
import javax.xml.xpath.XPathExpressionException;
import javax.xml.xpath.XPathFactory;
import org.w3c.dom.*;
import org.xml.sax.SAXException;

public class MetodaiIrasui {
    
    public Studentas[] skaitytiXML () {
        Studentas[] studMas = null;
        int studKiek = 0;
        try {        
            File inputFile = new File("D:\\Users\\nerijusa\\My Documents\\NetBeansProjects\\projektas1\\src\\main\\java\\studPaketas\\testStudentasDuom.xml");
        
            DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();        
            DocumentBuilder dbBuilder = dbFactory.newDocumentBuilder();
            Document doc = dbBuilder.parse(inputFile);
            
            doc.getDocumentElement().normalize();
            //System.out.println (doc.getDocumentElement().getNodeName());
            
            XPath xPath = XPathFactory.newInstance().newXPath();
            String exp = "/root/studentas";            
            NodeList nodeList = (NodeList) xPath.compile(exp).evaluate(doc, XPathConstants.NODESET);
            System.out.println ("Sarase yra: " + nodeList.getLength() + " studentu;" );
            studKiek = nodeList.getLength();
            studMas = new Studentas[studKiek];
            
            for (int i =0; i< nodeList.getLength(); i++) {
                Node nNode = nodeList.item(i);
                Studentas stud = new Studentas();
                
                NodeList chNodeList = nNode.getChildNodes();
                for (int j=0; j<chNodeList.getLength(); j++){
                    if(chNodeList.item(j).getNodeType() == chNodeList.item(j).ELEMENT_NODE )
                        //System.out.println(chNodeList.item(j).getNodeName() + " = " + chNodeList.item(j).getTextContent() );
                        switch (chNodeList.item(j).getNodeName()) {
                            case "vardas": stud.keistiVarda(chNodeList.item(j).getTextContent());/*vardas*/ break;
                            case "kursas": stud.keistiKursa(Integer.parseInt(chNodeList.item(j).getTextContent()));/*kursas*/ break;
                            case "vidurkis": stud.keistiVidurkis(Double.parseDouble(chNodeList.item(j).getTextContent()));/*vidurkis*/ break;
                            case "fakultetas": stud.keistiFakulteta(chNodeList.item(j).getTextContent());/*fakultetas*/ break;
                        }
                }
                studMas[i] = stud;
            }
            
        } catch (ParserConfigurationException ex) {
            System.out.println("Klaida ");
        } catch (SAXException ex) {
            System.out.println("Klaida ");
        } catch (IOException ex) {
            System.out.println("Klaida ");
        } catch (XPathExpressionException ex) {
            System.out.println("Klaida ");
        }
        return studMas;
    }
    
    public Studentas skaitoIrasa() throws IOException {
	// skaito informaciją apie studentą
	String vardas;
	int kursas;
	double vidurkis =0;
        String fakultetas;
	BufferedReader iv = new BufferedReader(new InputStreamReader(System.in));
	System.out.println("Iveskite varda: ");
   	vardas = iv.readLine();
	System.out.println("Kursas: ");
	while(true) {
		try {
    	    	        kursas = Integer.parseInt(iv.readLine());
		        break;
		} catch (NumberFormatException ko) {
			System.out.println("Blogas kodas - pakartokite: ");
	    }
	}
	// analogiskai skaito vidurki
	System.out.println("Nurodykite vidurki: ");
	while(true) {
		try {
    	    	        vidurkis = Double.parseDouble(iv.readLine());
		        break;
		} catch (NumberFormatException ko) {
			System.out.println("Blogas kodas - pakartokite: ");
	    }
	}
        System.out.println("Iveskite fakulteta: ");
   	fakultetas = iv.readLine();
    	// B variantas: konstruktorius su parametrais:
	Studentas stud = new Studentas(vardas, kursas, vidurkis, fakultetas);
        //Studentas stud = new Studentas();
        //stud.keistiVarda(vardas);
	// B varianto pabaiga.
	
	return stud;
    }
        
    public void suvestine(Studentas mas[ ], String vardas) {
	if (vardas.equals("visi")) {
//	if (vardas.compareTo("visi") == 0) { // tinka ir taip
		System.out.println("*** Bendra suvestine ***");
		System.out.println("Vardas  kursas  vidurkis  Fakultetas");
	} else {
		System.out.println("*** Tik su vardais " + vardas + " ***");
		System.out.println("Kursas  vidurkis");
	}
	for (int i = 0; i < mas.length; i++) {
		if (vardas.equals("visi") || vardas.equals(mas[i].gautiVarda() )) {
		      if (vardas.equals("visi")) {
			System.out.print(mas[i].gautiVarda() + "  ");
		      }
		     System.out.print(mas[i].gautiKursa() + "      ");
		     System.out.print(mas[i].gautiVidurkis() + "      ");
                     System.out.println(mas[i].gautiFakulteta());
		}
	}
}
    
    public void kurso_vidurkis(Studentas mas[ ], String kursas) {
        if (kursas.equals("visi")) {
            System.out.print("Viso kurso vidurkis: ");
        }
        else { System.out.print(kursas + " kurso vidurkis: "); }
        double sum = 0;
        int kiek = 0;
        
        for (int i = 0; i < mas.length; i++) {
		if (kursas.equals("visi") || kursas.equals(mas[i].gautiKursa())) {
                    sum= sum + mas[i].gautiVidurkis();
                    kiek ++;
                }
                }
        try {
            System.out.println( sum/kiek);
        }
        catch (Exception e) {System.out.println("Buvo klaidu: " + e.getMessage());  }
    }

    public Studentas[] koreguoti (Studentas mas[ ]) {
        int kor_nr = -1;
        BufferedReader iv = new BufferedReader(new InputStreamReader(System.in));
	System.out.println("Kuri irasa koreguosime?: ");
   	while(true) {
		try {
    	    	        kor_nr = Integer.parseInt(iv.readLine())-1;
                        System.out.println("Koreguosiu " + kor_nr);
		        break;
		} 
                catch (NumberFormatException ko) {
			System.out.print("Blogas kodas - pakartokite: ");
	    }
                catch (IOException ko) {System.out.print("Buvo klaida. ");}                
        }
        
        for (int i=0; i<4; i++){
            System.out.println("Jei nekeisti, palikti tuscia. Kokia nauja " + (i+1) + " lauko reiksme: " );
            try {
                String s = iv.readLine();
                if (! s.equals("")) {
                switch (i) {
                    case 0: mas[kor_nr].keistiVarda(s);/*vardas*/ break;
                    case 1: mas[kor_nr].keistiKursa(Integer.parseInt(s));/*kursas*/ break;
                    case 2: mas[kor_nr].keistiVidurkis(Double.parseDouble(s));/*vidurkis*/ break;
                    case 3: mas[kor_nr].keistiFakulteta(s);/*fakultetas*/ break;
                }
                }
            } 
            catch (IOException ex) { System.out.print("Buvo klaida. ");}
            catch (NumberFormatException ko) {System.out.print("Blogas kodas - pakartokite: ");
	    }
        }        
        return mas;
    }
    
    public Studentas koreguoti_st (Studentas st) {
        BufferedReader iv = new BufferedReader(new InputStreamReader(System.in));
        for (int i=0; i<4; i++){
            System.out.println("Jei nekeisti, palikti tuscia. Kokia nauja " + (i+1) + " lauko reiksme: " );
            try {
                String s = iv.readLine();
                if (! s.equals("")) {
                switch (i) {
                    case 0: st.keistiVarda(s);/*vardas*/ break;
                    case 1: st.keistiKursa(Integer.parseInt(s));/*kursas*/ break;
                    case 2: st.keistiVidurkis(Double.parseDouble(s));/*vidurkis*/ break;
                    case 3: st.keistiFakulteta(s);/*fakultetas*/ break;
                }
                }
            } 
            catch (IOException ex) { System.out.print("Buvo klaida. ");}
            catch (NumberFormatException ko) {System.out.print("Blogas kodas - pakartokite: ");
	    }
        }
        return st;
    }
    
    public Studentas[] salinti (Studentas mas[ ], int nr) {
        Studentas sar[] = new Studentas[mas.length-1];
        int sk =0;
        for (int i = 0; i < sar.length; i++) {
            if (sk != nr) {
                sar[i]= mas[sk];
                sk++;
            }
            else {
                sk++;
                sar[i]= mas[sk];
                sk++;}
        }
    
        return sar;
    }
}
