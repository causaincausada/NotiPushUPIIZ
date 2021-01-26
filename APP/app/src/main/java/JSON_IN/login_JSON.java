package JSON_IN;

public class login_JSON {
    private final Boolean error;
    private final String error_Mensaje;
    private final String idUsuario;

    public login_JSON(Boolean error, String error_Mensaje, String idUsuario) {
        this.error = error;
        this.error_Mensaje = error_Mensaje;
        this.idUsuario = idUsuario;
    }

    public Boolean getError() {
        return error;
    }

    public String getError_Mensaje() {
        return error_Mensaje;
    }

    public String getIdUsuario() {
        return idUsuario;
    }
}
