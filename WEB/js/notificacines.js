var dataSet = [];
var noti;
var grups;

init();

function btn_ver(id) {
  for (var i = 0; i < noti.length; i++) {
    if (noti[i].idNotificacion == id) {
      document.getElementById("label_asunto").innerText = noti[i].titulo;
      document.getElementById("label_desti").innerText = noti[i].descripcion;
      document.getElementById("label_des").innerText = getNameGrupo(
        noti[i].Grupo_idGrupo
      );
      document.getElementById("label_date").innerText = noti[i].fecha;
      break;
    }
  }
}

function setNoti(notificaciones) {
  for (var i = 0; i < notificaciones.length; i++) {
    var b =
      "<button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#modal-VerNotificacion' style='width: 100%;' onclick='btn_ver(" +
      notificaciones[i].idNotificacion +
      ");' > VER</button>";
    var d = [
      notificaciones[i].titulo,
      getNameGrupo(notificaciones[i].Grupo_idGrupo),
      b,
    ];
    dataSet.push(d);
  }

  setTablaData();
}

function setGrupos(grupos) {
  var x = document.getElementById("select-grupo");

  for (var i = 0; i < grupos.length; i++) {
    var option = document.createElement("option");
    option.text = grupos[i].nombre;
    option.value = grupos[i].idGrupo;
    x.add(option);
  }
}

document.getElementById("btn-enviar").addEventListener(
  "click",
  function () {
    var grupo = document.getElementById("select-grupo").value;
    var asunto = document.getElementById("asunto").value;
    var descripcion = document.getElementById("descripcion").value;
    var error = false;

    if (asunto == "") {
      alert("Campo asunto está vacío");
      error = true;
    }

    if (descripcion == "") {
      alert("Campo descripción está vacío");
      error = true;
    }

    if (grupo == "-1") {
      alert("Debe seleccionar un grupo");
      error = true;
    }

    if (!error) {
      const xml_nueva_noti = new XMLHttpRequest();
      xml_nueva_noti.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const respuesta = JSON.parse(xml_nueva_noti.responseText);
          if (respuesta.correcto) {
            document.getElementById("select-grupo").value = -1;
            document.getElementById("asunto").value = "";
            document.getElementById("descripcion").value = "";

            $(function () {
              $("#modal-NuevaNotificacion").modal("toggle");
            });

            resetNotificaciones();
          }
        }
      };
      xml_nueva_noti.open("POST", "php/notificacion.php", true);

      var data = {};
      data["titulo"] = asunto;
      data["descripcion"] = descripcion;
      data["fecha"] = timestamp();
      data["Grupo_idGrupo"] = grupo;
      var data_json = JSON.stringify(data);
      xml_nueva_noti.send(data_json);
    }
  },
  false
);

function init() {
  const xml = new XMLHttpRequest();
  xml.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const respuesta = JSON.parse(xml.responseText);
      if (respuesta.correcto) {
        grups = respuesta.grupos;
        setGrupos(respuesta.grupos);

        const xml2 = new XMLHttpRequest();
        xml2.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            const respuesta = JSON.parse(xml2.responseText);
            if (respuesta.correcto) {
              noti = respuesta.notificaciones;
              setNoti(respuesta.notificaciones);
            }
          }
        };
        xml2.open("GET", "php/notificacion.php", true);
        xml2.send();
      }
    }
  };

  xml.open("GET", "php/grupo.php", true);
  xml.send();
}

function resetNotificaciones() {
  const xml3 = new XMLHttpRequest();
  xml3.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const respuesta = JSON.parse(xml3.responseText);
      if (respuesta.correcto) {
        noti = respuesta.notificaciones;
        notificaciones = respuesta.notificaciones;
        dataSet = [];
        for (var i = 0; i < notificaciones.length; i++) {
          var b =
            "<button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#modal-VerNotificacion' style='width: 100%;' onclick='btn_ver(" +
            notificaciones[i].idNotificacion +
            ");' > VER</button>";
          var d = [
            notificaciones[i].titulo,
            getNameGrupo(notificaciones[i].Grupo_idGrupo),
            b,
          ];
          dataSet.push(d);
        }

        $("#example1").DataTable().clear().draw();
        $("#example1").DataTable().rows.add(dataSet);
        $("#example1").DataTable().columns.adjust().draw();
      }
    }
  };
  xml3.open("GET", "php/notificacion.php", true);
  xml3.send();
}

function setTablaData() {
  $("#example1")
    .DataTable({
      data: dataSet,
      columns: [{ title: "Asunto" }, { title: "Grupo" }, { title: "Acción" }],
      language: {
        decimal: "",
        emptyTable: "No hay información",
        info: "Mostrando _START_ a _END_ de _TOTAL_ Notificaciones",
        infoEmpty: "Mostrando 0 to 0 of 0 Notificaciones",
        infoFiltered: "(Filtrado de _MAX_ total Notificaciones)",
        infoPostFix: "",
        thousands: ",",
        lengthMenu: "Mostrar _MENU_ Notificaciones",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "Buscar:",
        zeroRecords: "Sin resultados encontrados",
        paginate: {
          first: "Primero",
          last: "Ultimo",
          next: "Siguiente",
          previous: "Anterior",
        },
      },
      responsive: true,
      lengthChange: true,
      autoWidth: false,
    })
    .buttons()
    .container()
    .appendTo("#example1_wrapper .col-md-6:eq(0)");
}

function timestamp() {
  function pad(n) {
    return n < 10 ? "0" + n : n;
  }
  d = new Date();
  dash = "-";
  colon = ":";
  return (
    d.getFullYear() +
    dash +
    pad(d.getMonth() + 1) +
    dash +
    pad(d.getDate()) +
    " " +
    pad(d.getHours()) +
    colon +
    pad(d.getMinutes()) +
    colon +
    pad(d.getSeconds())
  );
}

function getNameGrupo(id) {
  for (var i = 0; i < grups.length; i++) {
    if (grups[i].idGrupo == id) {
      return grups[i].nombre;
    }
  }
}
