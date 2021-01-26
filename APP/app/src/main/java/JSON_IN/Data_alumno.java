package JSON_IN;

public class Data_alumno {
    private final String nombre;
    private final String programa;
    private final String boleta;

    public Data_alumno(String nombre, String programa, String boleta) {
        this.nombre = nombre;
        this.programa = programa;
        this.boleta = boleta;
    }

    public String getNombre() {
        return nombre;
    }

    public String getPrograma() {
        return programa;
    }

    public String getBoleta() {
        return boleta;
    }
}
