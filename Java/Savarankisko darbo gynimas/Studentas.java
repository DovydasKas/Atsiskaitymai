
package studPaketas;

public class Studentas {
    private String vardas;
    private int kursas;
    private double sesijosVidurkis;
    private String fakultetas;
    
    //konstruktoriai
    Studentas() { }
    Studentas(String va, int ku, double sv, String fk) {
		vardas = va;
		kursas = ku;
		sesijosVidurkis = sv;
                fakultetas = fk;
	}
    
    public String gautiVarda() {
		return vardas;
	}
    public void keistiVarda(String var) {
		vardas = var;
	}
    public int gautiKursa() {
		return kursas;
	}
    public void keistiKursa(int krs) {
		kursas = krs;
	}
    public double gautiVidurkis() {
		return sesijosVidurkis;
	}
    public void keistiVidurkis(double svid) {
		sesijosVidurkis = svid;
	}
    public String gautiFakulteta() {
		return fakultetas;
	}
    public void keistiFakulteta(String fak) {
		fakultetas = fak;
	}

}
