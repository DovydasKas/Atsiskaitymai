import java.io.*;
import java.util.StringTokenizer;

public class lab2 {

	public static void main(String[] args) {
		BufferedReader in = new BufferedReader (new InputStreamReader (System.in));
		File fd = new File ("duom.txt"); //duomenu failas
		File fr = new File ("Rez.txt"); //rezultatu failas
		int n = 0; //masyvo A elementu sk.
		int m = 0; //masyvo B elementu sk.
		PrintWriter rasyti = null;
		BufferedReader file_in = null;
		String s = null;
		try {
			file_in = new BufferedReader (new FileReader (fd));
			System.out.println("Failas rastas");
			rasyti = new PrintWriter (new FileWriter (fr));
			
			System.out.println("Iveskite masyvo A elementu kieki:");
			s = in.readLine();
			n = Integer.parseInt(s);
			int A[] = new int[n];
						
			s = file_in.readLine();
			m = Integer.parseInt(s);
			int B[] = new int[m];
			
			A = ivesti_mas(in, n);
			spausdinti_mas_ekrane(A, n);
			spausdinti_mas_faile(rasyti, A, n);
			
			B = skaityti_mas(file_in, m);
			spausdinti_mas_faile(rasyti, B, m);
			spausdinti_mas_ekrane(B, m);
			
			
	// System.out.println();
			
	System.out.println("Masyvo A didziausias elementas: " + rasti_max(A, n) );
	System.out.println("Masyvo B didziausias elementas: " + rasti_max(B, m)	);
	System.out.println("Masyvo A elementu suma: " + suma(A, n)	);
	System.out.println("Masyvo B elementu suma: " + suma(B, m)	);	
	System.out.println("Masyvo A lyginiu elementu suma: " + lygine_suma(A, n)	);	
	System.out.println("Masyvo B lyginiu elementu suma: " + lygine_suma(B, m)	);	
	System.out.println("Masyvo A maziausias elementas: " + rasti_min(A, n)	);	
	System.out.println("Masyvo B maziausias elementas: " + rasti_min(B, m)	);
	
	
	
			if (rasyti != null) rasyti.close();
		}
		catch (FileNotFoundException ex) {System.out.println("Failas nerastas"); }
		catch (IOException e) {System.out.println("Ivedimo klaida");}
		
	
	}

	 
	// Rasti didziausia masyvo elementa
	public static int rasti_max (int [] A, int n) {
		int max = A[0];
		for (int i=1; i<n; i++) {
			if(A[i] > max ) max = A[i];
		}
		System.out.println();
		
		return max;
	}
	// Masyvo elementu suma
	public static int suma (int [] M1, int el_sk) {
		int sum = 0;
		for (int i=0; i<el_sk; i++) {
			sum = sum + M1[i];
		}
		System.out.println();
		
		return sum;
	}
	// Masyvo lyginiu skaiciu suma
		public static int lygine_suma (int [] M1, int el_sk) {
		int sum = 0;
		for (int i=0; i<el_sk; i++) {
			if(M1[i]%2==0)
			
			sum = sum + M1[i];
		}
		System.out.println();
		
		return sum;
	}
	//Maziausias masyvo elementas
		public static int rasti_min (int [] A, int n) {
		int min = A[0];
		for (int i=0; i<n; i++) {
			if(A[i] < min ) min = A[i];
		}
		System.out.println();
		
		return min;
	}
	
	
	public static int[] skaityti_mas (BufferedReader file, int n){
		int A[] = new int [n]; //sukuriamas masyvo objektas
		String eilute;	// kintamasis 1 eilutei skaityti
		int sk = 0; //rasymo i masyva skaitliukas
		while (true){
		try {
			if ((eilute = file.readLine()) == null) break; 
			StringTokenizer st = new StringTokenizer(eilute);
			int kiek_sk = st.countTokens();
			if (kiek_sk > n) kiek_sk = n;
			else n= n-kiek_sk;
			for (int i=0; i< kiek_sk; i++){
				A[sk]=Integer.parseInt(st.nextToken());
				sk ++;
				}
			if (kiek_sk==n) break;
		}
		catch (IOException e) {System.out.println("Ivedimo klaida");}
		catch (IndexOutOfBoundsException e) {System.out.println("Masyvo ribu klaida");}
		}
		return A;
	}
	
	public static int[] ivesti_mas (BufferedReader input, int n) {
		int A[] = new int[n];
		String s = null;
		for (int i=0; i<n; i++){
			System.out.println("Iveskite masyvo " + (i+1) +"-aji elementa ");
			try {
				s = input.readLine();
				A[i] = Integer.parseInt(s);
			}
			catch (IOException e) {
				System.out.println("Klaida ivedant masyvo elementa!");
				i--;
				}
			catch (NumberFormatException e) {
				System.out.println("Ivestas ne sveikasis skaicius!");
				i--;
				}
		}
		return A;
	}
	
	public static void spausdinti_mas_ekrane (int [] A, int n) {
		for (int i=0; i<n; i++) {
			System.out.print(A[i] +" ");
		}
		System.out.println();
	}
	
	public static void spausdinti_mas_faile (PrintWriter rasyti, int [] A, int n) {
				
		rasyti.println(n);
		for (int i=0; i<n; i++) {
			rasyti.print(A[i] +" ");
		}
		rasyti.println();
	}
}
