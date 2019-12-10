import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class CallbackVoid implements Callback<Void> {
    @Override
    public void onResponse(Call<Void> call, Response<Void> response) {
        System.out.println(response.code());
        System.out.println(response.message());
    }

    @Override
    public void onFailure(Call<Void> call, Throwable throwable) {

    }
}
