package JSON_IN;

public class Grupo {
    private final String idNotificacion;
    private final String titulo;
    private final String descripcion;
    private final String fecha;
    private final String Grupo_idGrupo;

    public Grupo(String idNotificacion, String titulo, String descripcion, String fecha, String grupo_idGrupo) {
        this.idNotificacion = idNotificacion;
        this.titulo = titulo;
        this.descripcion = descripcion;
        this.fecha = fecha;
        Grupo_idGrupo = grupo_idGrupo;
    }

    public String getIdNotificacion() {
        return idNotificacion;
    }

    public String getTitulo() {
        return titulo;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public String getFecha() {
        return fecha;
    }

    public String getGrupo_idGrupo() {
        return Grupo_idGrupo;
    }
}
