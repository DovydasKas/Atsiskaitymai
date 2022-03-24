
import java.io.*;
import java.util.StringTokenizer;



class Displejus {
    String marke;
    int metai;
    String raiska;
    double kaina;
    //konstruktoriai
    Displejus() { }
	Displejus(String mrk, int met, String rai, double kain) {
		marke = mrk;
		this.metai = met;
		this.raiska = rai;
                kaina = kain;
	}
        public String GautiMarke (){
            return marke;
        }
        public int GautiMetai(){
            return metai;
        }
        public String GautiRaiska(){
            return raiska;
        }
        public double GautiKaina (){
            return kaina;
        }
    }






public class Savarankiskas {

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        BufferedReader in = new BufferedReader (new InputStreamReader (System.in));
		File fd = new File ("savarankiskas_duom.txt"); //duomenu failas
		File fr = new File ("savarankiskas_rez.txt"); //rezultatu failas
		int n = 0; //masyvo A elementu sk.
		int nr = 0; //meniu veiksmo numeris
		int vieta = -1; //salinamo elemento numeris 
		PrintWriter rasyti = null;
		Displejus A[] = null;
		Displejus B[] = null;
                
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
					A = new Displejus[n];
					
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
                               case 5://pabaiga
				if (rasyti != null) rasyti.close();
				System.out.println("Programa baige darba.");
				System.exit(0);
				break;
				
    /**
     *
     */
  
}
}
    }
    public static void meniu() {
                System.out.println("Savarankisko darbo nr1 uzduociu meniu");
                System.out.println("----------------------------");
		System.out.println("1. Skaitymas is failo");
		System.out.println("2. Rezultatu isvedimas i faila");
		System.out.println("3. Naujo iraso ivedimas");
		System.out.println("4. Iraso salinimas");
                System.out.println("5. Baigti Darba");
		System.out.println("----------------------------");
		System.out.println("Iveskite pasirinkto veiksmo nr.:");
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
        	//metodas skaito duomenis is failo
	public static Displejus[] skaityti_sar (File file, int n){
		Displejus A[] = new Displejus [n]; //sukuriamas masyvo objektas
		String eilute;	// kintamasis 1 eilutei skaityti
		int sk = 0; //rasymo i masyva skaitliukas
		String marke;
                int metai;
                String raiska;
                double kaina;
		
		try {
			BufferedReader file_in = new BufferedReader (new FileReader (file));
			while (true){
			
				if ((eilute = file_in.readLine()) == null) break; 
				StringTokenizer st = new StringTokenizer(eilute);
				
				marke = st.nextToken();
				metai = Integer.parseInt(st.nextToken());
				kaina = Double.parseDouble(st.nextToken());
				raiska = st.nextToken();
				
				A[sk]= new Displejus (marke,metai,raiska,kaina);
				sk ++;
				if (sk==n) break;
			}
		}
		catch (IOException e) {System.out.println("Ivedimo klaida");}
		catch (IndexOutOfBoundsException e) {System.out.println("Masyvo ribu klaida");}
		
		return A;
	}
		public static void spausdinti_sar_faile (PrintWriter rasyti, Displejus [] A, int n) {
		if (n > 0) {
			spausdinti_antraste_faile (rasyti);
			rasyti.println("*************************************************************");
			for (int i=0; i<n; i++) {
				rasyti.println("* " + prailginti((i+1)+"", 3) +" * "+prailginti(A[i].GautiMarke(),15)+ " * "+ prailginti(A[i].GautiMetai()+"", 6)+
						" * " + prailginti(A[i].GautiKaina()+"", 6) + " * " + prailginti(A[i].GautiRaiska(), 15) + " *");
			}
			rasyti.println("*************************************************************");
		}
		else rasyti.println("Masyvas tuscias!");
	}
	
	public static void spausdinti_antraste_faile (PrintWriter rasyti){
		rasyti.println("*************************************************************");
		rasyti.println("* Nr. *   Marke   * Metai * Kaina *  Raiska   *");
	}
	
	public static void spausdinti_sar_ekrane ( Displejus [] A, int n) {
		if (n > 0) {
			spausdinti_antraste_ekrane ();
			System.out.println("*************************************************************");
			for (int i=0; i<n; i++) {
				System.out.println("* " + prailginti((i+1)+"", 3) +" * "+prailginti(A[i].GautiMarke(),15)+ " * "+ prailginti(A[i].GautiMetai()+"", 6)+
						" * " + prailginti(A[i].GautiKaina()+"", 6) + " * " + prailginti(A[i].GautiRaiska(), 15) + " *");
			}
			System.out.println("*************************************************************");
		}
		else System.out.println("Masyvas tuscias!");
	}
	
	public static void spausdinti_antraste_ekrane (){
		System.out.println("*************************************************************");
		System.out.println("* Nr. *   Marke   * Metai * Kaina *  Raiska   *");
	}
	
	public static String prailginti (String reiksme, int ilgis){
		for (int i=reiksme.length(); i<ilgis; i++)
			reiksme += " ";
		return reiksme;
	}
    
        public static Displejus[] kopijuotiMas(Displejus A[], int n){
		Displejus A2[] = new Displejus[n];
		for (int i=0; i<n-1; i++ )
			A2[i]=A[i];
		return A2;
	}
	
	public static Displejus[] iterpti(Displejus G[], int n){
		BufferedReader in = new BufferedReader (new InputStreamReader (System.in));
		String marke;
                int metai;
                String raiska;
                double kaina;
                int vieta;
		
		while (true){
			System.out.println("Iveskite displejaus marke:");
			try {
				marke = in.readLine(); 
				break;
				}
			catch (IOException e) {System.out.println("Ivedimo klaida");}
		}
		
		while (true){
			System.out.println("Iveskite displejaus metus:");
			try {
				metai = Integer.parseInt(in.readLine()); 
				break;
				}
			catch (IOException e) {System.out.println("Ivedimo klaida");}
			catch (NumberFormatException e) {System.out.println("Ivedet ne sveika skaiciu!");}
		}
		
		while (true){
			System.out.println("Iveskite displejaus kaina:");
			try {
				kaina = Double.parseDouble(in.readLine()); 
				break;
				}
			catch (IOException e) {System.out.println("Ivedimo klaida");}
			catch (NumberFormatException e) {System.out.println("Ivedet ne skaiciu!");}
		}
		
		while (true){
			System.out.println("Iveskite displejaus raiska:");
			try {
				raiska = in.readLine(); 
				break;
				}
			catch (IOException e) {System.out.println("Ivedimo klaida");}
		}
		
		Displejus naujas = new Displejus(marke, metai, raiska,kaina );
		
		while (true){
			System.out.println("Masyve yra " + (n-1) + " elementu. Iveskite i kuria vieta iterpti nauja displeju(1 - "+ n +"):");
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
        	public static Displejus[] salinti(Displejus G[], int n, int vieta){
		for (int i=vieta; i<n; i++)
			G[i]=G[i+1];
		return G;
	}
        
    }
