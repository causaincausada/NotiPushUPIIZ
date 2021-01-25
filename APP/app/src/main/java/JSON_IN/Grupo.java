package JSON_IN;

public class Grupo {
    private final String idGrupo;
    private final String nombre;
    private final String descripcion;

    public Grupo(String idGrupo, String nombre, String descripcion) {
        this.idGrupo = idGrupo;
        this.nombre = nombre;
        this.descripcion = descripcion;
    }

    public String getIdGrupo() {
        return idGrupo;
    }

    public String getNombre() {
        return nombre;
    }

    public String getDescripcion() {
        return descripcion;
    }
}
