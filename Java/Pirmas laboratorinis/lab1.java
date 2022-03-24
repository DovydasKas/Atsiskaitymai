import java.io.*;
import java.util.StringTokenizer;

class Gyvunas {
	private String pavadinimas;
	private int amzius;
	private double svoris;
	private String k_salis;
	
	Gyvunas() {}
	Gyvunas (String pav, int amzius, double svoris, String salis) {
		pavadinimas = pav;
		this.amzius = amzius;
		this.svoris = svoris;
		k_salis = salis;
	}
	
	public String gautiPav () {
		return pavadinimas;
	} 
	
	public int gautiAmziu () {
		return amzius;
	}
	
	public double gautiSvori () {
		return svoris;
	}
	
	public String gautiSali () {
		return k_salis;
	}
}

public class lab1 {

	public static void main(String[] args) {
		BufferedReader in = new BufferedReader (new InputStreamReader (System.in));
		File fd = new File ("lab1_duom.txt"); //duomenu failas
		File fr = new File ("lab1_rez.txt"); //rezultatu failas
		int n = 0; //masyvo A elementu sk.
		int nr = 0; //meniu veiksmo numeris
		int vieta = -1; //salinamo elemento numeris 
		PrintWriter rasyti = null;
		Gyvunas A[] = null;
		Gyvunas B[] = null;
		
		//Atidarome rezultatu faila
		try {
			rasyti = new PrintWriter (new FileWriter (fr));
		}
		catch (IOException e) {System.out.println("Nepavyko sukurti failo.");}
		
		while (true){
			meniu();
			try {
				nr = Integer.parseInt(in.readLine());
			}
			catch(IOException e){System.out.println("Ivedimo klaida1!");}
			catch(NumberFormatException e){System.out.println("Ivedete ne sveika skaiciu!");}
			switch (nr) {
			case 1://skaitymas is failo
					n = skaiciuotiEilutes(fd);
					System.out.println("kiekis" + n);
					A = new Gyvunas[n];
					
					A = skaityti_sar(fd, n);
					System.out.println("Duomenys nuskaityti.");
					spausdinti_sar_ekrane(A, n);
				break;
			
			case 2://rezultatu isvedimas i faila
				spausdinti_sar_faile(rasyti, A, n);
				System.out.println("Duomenys irasyti i faila " + fr + ".");
				break;
				
			case 3://naujo iraso iterpimas
				n++;
				A = kopijuotiMas(A, n);
				iterpti(A,n);
				spausdinti_sar_ekrane(A, n);
				break;
				
			case 4://iraso salinimas
				if (n==0) {System.out.println("Masyvas tuscias. Nera ka salinti.");}
				else {
					while (true){
						System.out.println("Iveskite salinamo elemento nr.(1 - "+ n +" ):");
						try {
							vieta = Integer.parseInt(in.readLine());
							if (vieta <1 || vieta > n) System.out.println("Tokio elemento pasalinti negalima!");
							else {
								n--;
								A = salinti(A, n, vieta-1);
								spausdinti_sar_ekrane(A, n);
								break; 
							}
						}
						catch(IOException e){System.out.println("Ivedimo klaida2!");}
						catch(NumberFormatException e){System.out.println("Ivedete ne sveika skaiciu!");}
					}
				}
				break;
				
			case 5://paieskos veiksmai
				B = surasti(A, n);
				System.out.println("Sunkiausias gyvunas yra:");
				spausdinti_sar_ekrane(B, B.length);
				break;
				
			case 6://pabaiga
				if (rasyti != null) rasyti.close();
				System.out.println("Programa baige darba.");
				System.exit(0);
				break;
	
			default://veiksmai kitais atvejais
				System.out.println("Neteisingas veiksmo nr. Pakartokite!");
				break;
			}
		}
	}
	
	//metodas skaito duomenis is failo
	public static Gyvunas[] skaityti_sar (File file, int n){
		Gyvunas A[] = new Gyvunas [n]; //sukuriamas masyvo objektas
		String eilute;	// kintamasis 1 eilutei skaityti
		int sk = 0; //rasymo i masyva skaitliukas
		String pav, salis;
		int amzius;
		double svoris;
		
		try {
			BufferedReader file_in = new BufferedReader (new FileReader (file));
			while (true){
			
				if ((eilute = file_in.readLine()) == null) break; 
				StringTokenizer st = new StringTokenizer(eilute);
				
				pav = st.nextToken();
				amzius = Integer.parseInt(st.nextToken());
				svoris = Double.parseDouble(st.nextToken());
				salis = st.nextToken();
				
				A[sk]= new Gyvunas (pav, amzius, svoris, salis);
				sk ++;
				if (sk==n) break;
			}
		}
		catch (IOException e) {System.out.println("Ivedimo klaida");}
		catch (IndexOutOfBoundsException e) {System.out.println("Masyvo ribu klaida");}
		
		return A;
	}
	
	//metodas suskaiciuoja kiek faile yra irasu eiluciu 
	public static int skaiciuotiEilutes (File file) {
		int sk = 0;
		try {
			BufferedReader file_in = new BufferedReader (new FileReader (file));
			while (true){
					if ((file_in.readLine()) == null){
						file_in.close();
						return sk;}
					sk++;
			}
		}
		catch (IOException e) {System.out.println("Skaitymo is failo klaida");}
		return sk;
	}
	
	//metodas sukuria nauja, vienetu didesni masyva, nei buvo pries iterpima
	//ir i ji perkopijuoja pradinio masyvo duomenis
	public static Gyvunas[] kopijuotiMas(Gyvunas A[], int n){
		Gyvunas A2[] = new Gyvunas[n];
		for (int i=0; i<n-1; i++ )
			A2[i]=A[i];
		return A2;
	}
	
	public static Gyvunas[] iterpti(Gyvunas G[], int n){
		BufferedReader in = new BufferedReader (new InputStreamReader (System.in));
		String pav, salis;
		int amzius;
		double svoris;
		int vieta;
		
		while (true){
			System.out.println("Iveskite gyvuno pavadinima:");
			try {
				pav = in.readLine(); 
				break;
				}
			catch (IOException e) {System.out.println("Ivedimo klaida");}
		}
		
		while (true){
			System.out.println("Iveskite gyvuno amziu:");
			try {
				amzius = Integer.parseInt(in.readLine()); 
				break;
				}
			catch (IOException e) {System.out.println("Ivedimo klaida");}
			catch (NumberFormatException e) {System.out.println("Ivedet ne sveika skaiciu!");}
		}
		
		while (true){
			System.out.println("Iveskite gyvuno svori:");
			try {
				svoris = Double.parseDouble(in.readLine()); 
				break;
				}
			catch (IOException e) {System.out.println("Ivedimo klaida");}
			catch (NumberFormatException e) {System.out.println("Ivedet ne skaiciu!");}
		}
		
		while (true){
			System.out.println("Iveskite gyvuno kilmes sali:");
			try {
				salis = in.readLine(); 
				break;
				}
			catch (IOException e) {System.out.println("Ivedimo klaida");}
		}
		
		Gyvunas naujas = new Gyvunas(pav, amzius, svoris, salis);
		
		while (true){
			System.out.println("Masyve yra " + (n-1) + " elementu. Iveskite i kuria vieta iterpti nauja gyvuna(1 - "+ n +"):");
			try {
				vieta = Integer.parseInt(in.readLine()); 
				if (vieta > n) System.out.println("Ivedete per dideli skaiciu!");
				else if (vieta < 1) System.out.println("Ivedete per maza skaiciu!");
				else break;
				}
			catch (IOException e) {System.out.println("Ivedimo klaida");}
			catch (NumberFormatException e) {System.out.println("Ivedet ne sveika skaiciu!");}
		}
		
		for (int i=n-1; i>vieta-1; i--)
			G[i]=G[i-1];
		G[vieta-1]=naujas;
		
		return G;
	}
	
	public static Gyvunas[] salinti(Gyvunas G[], int n, int vieta){
		for (int i=vieta; i<n; i++)
			G[i]=G[i+1];
		return G;
	}
	
	//Metodas suranda sunkiausia gyvuna ir ji iraso naujame masyve
	public static Gyvunas[] surasti (Gyvunas G[], int n){
		Gyvunas A[] = new Gyvunas[1]; //sukuriam nauja 1 iraso masyva, nes surasim tik 1 gyvuna
		Gyvunas max = G[0];
		for (int i=1; i<n; i++)
			if (max.gautiSvori()<G[i].gautiSvori()) max = G[i];
		A[0]=max;
		return A;
	}
	
	public static void spausdinti_sar_faile (PrintWriter rasyti, Gyvunas [] A, int n) {
		if (n > 0) {
			spausdinti_antraste_faile (rasyti);
			rasyti.println("*************************************************************");
			for (int i=0; i<n; i++) {
				rasyti.println("* " + prailginti((i+1)+"", 3) +" * "+prailginti(A[i].gautiPav(),15)+ " * "+ prailginti(A[i].gautiAmziu()+"", 6)+
						" * " + prailginti(A[i].gautiSvori()+"", 6) + " * " + prailginti(A[i].gautiSali(), 15) + " *");
			}
			rasyti.println("*************************************************************");
		}
		else rasyti.println("Masyvas tuscias!");
	}
	
	public static void spausdinti_antraste_faile (PrintWriter rasyti){
		rasyti.println("*************************************************************");
		rasyti.println("* Nr. *   Pavadinimas   * Amzius * Svoris *  Kilmes salis   *");
	}
	
	public static void spausdinti_sar_ekrane ( Gyvunas [] A, int n) {
		if (n > 0) {
			spausdinti_antraste_ekrane ();
			System.out.println("*************************************************************");
			for (int i=0; i<n; i++) {
				System.out.println("* " + prailginti((i+1)+"", 3) +" * "+prailginti(A[i].gautiPav(),15)+ " * "+ prailginti(A[i].gautiAmziu()+"", 6)+
						" * " + prailginti(A[i].gautiSvori()+"", 6) + " * " + prailginti(A[i].gautiSali(), 15) + " *");
			}
			System.out.println("*************************************************************");
		}
		else System.out.println("Masyvas tuscias!");
	}
	
	public static void spausdinti_antraste_ekrane (){
		System.out.println("*************************************************************");
		System.out.println("* Nr. *   Pavadinimas   * Amzius * Svoris *  Kilmes salis   *");
	}
	
	public static String prailginti (String reiksme, int ilgis){
		for (int i=reiksme.length(); i<ilgis; i++)
			reiksme += " ";
		return reiksme;
	}
	
	public static void meniu () {
		//Isvalom ekrana
		/*for (int i =0; i<=80; i++ )
			System.out.println("\n");*/
		System.out.println("Programos Lab1 veiksmu meniu");
		System.out.println("----------------------------");
		System.out.println("1. Skaityti duomenis.");
		System.out.println("2. Spausdinti i faila.");
		System.out.println("3. Iterpti.");
		System.out.println("4. Istrinti.");
		System.out.println("5. Surasti.");
		System.out.println("6. Baigti darba.");
		System.out.println("----------------------------");
		System.out.println("Iveskite pasirinkto veiksmo nr.:");
	}
	
}

