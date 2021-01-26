package JSON_IN;

public class NotisyGrups {
    private final String idNotificacion;
    private final String titulo;
    private final String descripcion;
    private final String fecha;
    private final String Grupo;

    public NotisyGrups(String idNotificacion, String titulo, String descripcion, String fecha, String grupo) {
        this.idNotificacion = idNotificacion;
        this.titulo = titulo;
        this.descripcion = descripcion;
        this.fecha = fecha;
        Grupo = grupo;
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

    public String getGrupo() {
        return Grupo;
    }
}
