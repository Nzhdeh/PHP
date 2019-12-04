package pruebaRetrofitJava;

public class Libro {
	private int codigo;
	private String titulo;
	private String numpag;

	public Libro(int codigo, String titulo, String numpag) {
		this.codigo = codigo;
		this.titulo = titulo;
		this.numpag = numpag;
	}

	public Libro(String titulo, String numpag) {
		this.titulo = titulo;
		this.numpag = numpag;
	}
	
	public int getId() {
		return codigo;
	}
	public void setId(int codigo) {
		this.codigo = codigo;
	}
	public String getNumpag() {
		return numpag;
	}
	public void setNumpag(String numpag) {
		this.numpag = numpag;
	}
	public String getTitulo() {
		return titulo;
	}
	public void setTitulo(String titulo) {
		this.titulo = titulo;
	}
}
