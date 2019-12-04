package pruebaRetrofitJava;

import com.sun.net.httpserver.Headers;
import jdk.nashorn.internal.codegen.CompilerConstants;

import javax.xml.ws.Response;
import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;

public class LibroCallbackLista
{
    @Override
    public void onResponse(Call<List<Libro>> call, Response<List<Libro>> response) {

        ArrayList<Libro> listaLibros = new ArrayList<>();

        String contentType;
        int code;
        String message;
        boolean isSuccesful;

        listaLibros = (ArrayList<Libro>) response.body();

        Headers cabeceras = response.headers();
        contentType = cabeceras.get("Content-Type");
        code = response.code();
        message = response.message();
        isSuccesful = response.isSuccessful();

        if(response.isSuccessful()){
            for(int i = 0; i < listaLibros.size(); i ++){
                System.out.println(listaLibros.get(i).getId()+" "+listaLibros.get(i).getTitulo()+" "+listaLibros.get(i).getNumpag());
            }
        }else {
            System.out.println("Error " + response.code());
            System.out.println(response.message());
        }
    }

    @Override
    public void onFailure(Call<List<Libro>> call, Throwable throwable)
    {
        int i = 0;
    }
}
