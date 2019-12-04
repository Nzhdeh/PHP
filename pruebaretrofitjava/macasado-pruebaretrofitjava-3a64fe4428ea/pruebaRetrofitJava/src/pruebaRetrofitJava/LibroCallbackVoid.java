package pruebaRetrofitJava;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import okhttp3.Headers;

//mejor un callback para cada consulta get post etc
public class LibroCallback implements Callback<Libro>{

	@Override
	public void onFailure(Call<Void> call, Throwable throwable)
	{
	}

	@Override
	public void onResponse(Call<Void> call, Response<Void> resp)
	{
		System.out.println(resp.code());
		System.out.println(resp.message());
	}
}
