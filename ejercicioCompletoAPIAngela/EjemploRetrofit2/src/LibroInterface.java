
import retrofit2.Call;
import retrofit2.http.*;

import java.util.List;


public interface LibroInterface {
	@GET("/libro/{id}")
	Call<Libro> getLibro (@Path("id") int id);

	//?XDEBUG_SESSION_START=PHPSTORM
	@GET("/libro/")
	Call<List<Libro>> getLibro();

	@DELETE("/libro/{id}")
	Call<Void> deleteLibro(@Path("id") int id);

	@PUT("/libro/{id}")
	Call<Void> putLibro(@Path("id") int id, @Body Libro libro);
	/*info wena: https://futurestud.io/tutorials/retrofit-2-how-to-update-objects-on-the-server-put-vs-patch*/

	@POST("/libro?XDEBUG_SESSION_START=PHPSTORM")
	//Call<Void> postLibro(@Field("titulo") String titulo, @Field("numpag") String numpag);
	Call<Void> postLibro(@Body Libro nuevoLibro);

	/*No entiendo nada https://code.tutsplus.com/es/tutorials/sending-data-with-retrofit-2-http-client-for-android--cms-27845*/


}
