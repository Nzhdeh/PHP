package pruebaRetrofitJava;
import jdk.nashorn.internal.codegen.CompilerConstants;
import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Path;

import java.util.List;
import java.util.Observable;


public interface LibroInterface
{
	//obtener un solo libro
	@GET("/libro/{codigo}")
	Call<Libro> getLibro (@Path("codigo") int codigo);
	//obtener una coleccion de libros
	@GET("/libro/")
	Call<List<Libro>> getLibro();

	//borra un libro
	@DELETE("/libro/{codigo}")
	Call<Void> deletePost(@Path("codigo") int codigo);

	//actualiza
	@PUT("/libro/{codigo}")
	Call<Void> updatePost(@Path("codigo") int codigo,@Body Libro libro);

	//guarda
	@POST("/api/v1/libro")
	Observable<Void> savePost(@Body Libro nuevoLibro);
}
