
import java.io.IOException;
import java.util.ArrayList;

import com.google.gson.Gson;
import okhttp3.Headers;
import okio.*;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;





/***************************************
 * SE PUEDEN DESCARGAR JARS DE CONVERTIDORES DE AQUÍ:
 * http://search.maven.org/
 * 
 * Por ejemplo:
 * http://search.maven.org/#search%7Cga%7C1%7Cg%3A%22com.squareup.retrofit2%22
 * 
 * Si usamos gradle, simplemente añadiríamos la dependencia:
 * com.squareup.retrofit2:converter-gson/home/migue/Descargas/converter-gson-2.1.0.jar
 *
 */



public class Principal {
	
	private final static String SERVER_URL = "http://biblioteca.devel:8080";

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		Retrofit retrofit;
		//Hago los callback necesarios
		LibroCallback libroCallback = new LibroCallback();	//este para cuando devuelva un libro
		ListLibroCallback listLibroCallback = new ListLibroCallback();	//para lista
		CallbackVoid callbackVoid = new CallbackVoid();	//para cuando no devuelve nada
		retrofit = new Retrofit.Builder()
							   .baseUrl(SERVER_URL)
							   .addConverterFactory(GsonConverterFactory.create())
							   .build();
		
		LibroInterface libroInter = retrofit.create(LibroInterface.class);

		//get por id
		//libroInter.getLibro(5).enqueue(libroCallback);
		//get de la colección
		libroInter.getLibro().enqueue(listLibroCallback);

		//delete de un libro por id
		//libroInter.deleteLibro(5).enqueue(callbackVoid);

		/*Esto no va*/
		//libroInter.postLibro("Nuevo Libro 3000", "350").enqueue(new Callback<Void>() {


		//creacion de un libro
		//libroInter.postLibro(new Libro("La demo", "350")).enqueue(callbackVoid);

		//actualizacion de un libro por id
		//libroInter.putLibro(13, new Libro("El libro para llorar2", "250")).enqueue(callbackVoid);


	}


	


}
