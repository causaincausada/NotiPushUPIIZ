package JSON_IN;

import java.util.List;

public class Alumno_JSON {
    private final Boolean error;
    private final String error_Mensaje;
    private final Boolean encontrado;
    private final List<Data_alumno> data_alumno;

    public Alumno_JSON(Boolean error, String error_Mensaje, Boolean encontrado, List<Data_alumno> data_alumno) {
        this.error = error;
        this.error_Mensaje = error_Mensaje;
        this.encontrado = encontrado;
        this.data_alumno = data_alumno;
    }

    public Boolean getError() {
        return error;
    }

    public String getError_Mensaje() {
        return error_Mensaje;
    }

    public Boolean getEncontrado() {
        return encontrado;
    }

    public List<Data_alumno> getData_alumno() {
        return data_alumno;
    }
}
