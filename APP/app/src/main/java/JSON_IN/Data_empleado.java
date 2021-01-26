package JSON_IN;

public class Data_empleado {
    private final String nombre;
    private final String programa;
    private final String numempleado;

    public Data_empleado(String nombre, String programa, String numempleado) {
        this.nombre = nombre;
        this.programa = programa;
        this.numempleado = numempleado;
    }

    public String getNombre() {
        return nombre;
    }

    public String getPrograma() {
        return programa;
    }

    public String getNumempleado() {
        return numempleado;
    }
}
