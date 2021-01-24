package JSON_IN;

import java.util.List;

public class Empleado_JSON {
    private final Boolean error;
    private final String error_Mensaje;
    private final Boolean encontrado;
    private final List<Data_empleado> data_empleado;

    public Empleado_JSON(Boolean error, String error_Mensaje, Boolean encontrado, List<Data_empleado> data_empleado) {
        this.error = error;
        this.error_Mensaje = error_Mensaje;
        this.encontrado = encontrado;
        this.data_empleado = data_empleado;
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

    public List<Data_empleado> getData_empleado() {
        return data_empleado;
    }
}
