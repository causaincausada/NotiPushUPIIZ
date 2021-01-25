package JSON_IN;

import java.util.List;

public class GetNotis {
    private final Boolean correcto;
    private final List<Notificacion> notificaciones;
    private final List<Grupo> grupos;

    public GetNotis(Boolean correcto, List<Notificacion> notificaciones, List<Grupo> grupos) {
        this.correcto = correcto;
        this.notificaciones = notificaciones;
        this.grupos = grupos;
    }

    public Boolean getCorrecto() {
        return correcto;
    }

    public List<Notificacion> getNotificaciones() {
        return notificaciones;
    }

    public List<Grupo> getGrupos() {
        return grupos;
    }
}
