var grupos;
var idGrupoSelect;

actualizar_Grupo();

function borrar_Grupo(id) {
  idGrupoSelect = id;
  const xml1 = new XMLHttpRequest();
  xml1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const respuesta = JSON.parse(xml1.responseText);
      if (respuesta.correcto) {
        if (respuesta.grupos.length > 0) {
          document.getElementById("btn_eliminar").style.visibility = "hidden";
          document.getElementById("label_eliminar").innerText =
            "No puede eliminar este grupo, primero debe eliminar a sus miembros.";
        } else {
          document.getElementById("btn_eliminar").style.visibility = "visible";
          document.getElementById("label_eliminar").innerText =
            "¿Está seguro de que desea eliminar el grupo?";
        }
      }
    }
  };
  xml1.open("GET", "php/agrupamientos.php?Grupo_idGrupo=" + id, true);
  xml1.send();
}

function editar_Grupo(id) {
  idGrupoSelect = id;
  for (var i = 0; i < grupos.length; i++) {
    if (grupos[i].idGrupo == id) {
      document.getElementById("a_nombre").value = grupos[i].nombre;
      document.getElementById("a_descripcion").value = grupos[i].descripcion;
      break;
    }
  }
}

function agrupar_Grupo(id) {
  idGrupoSelect = id;
  for (var i = 0; i < grupos.length; i++) {
    if (grupos[i].idGrupo == id) {
      document.getElementById("label-asignar").innerText = "Asignar a grupo: " + grupos[i].nombre;
      break;
    }
  }
  actualizar_alumnos();
  actualizar_agrupamiento();
}

function addAgrupamiento(id) {
  const xml1 = new XMLHttpRequest();
  xml1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const respuesta = JSON.parse(xml1.responseText);
      if (respuesta.correcto) {
        actualizar_alumnos();
        actualizar_agrupamiento();
      }
    }
  };
  xml1.open("POST", "php/agrupamientos.php", true);
  var data = {};
  data["Usuario_idUsuario"] = id;
  data["Grupo_idGrupo"] = idGrupoSelect;
  var data_json = JSON.stringify(data);
  xml1.send(data_json);
}

function borrarUsuAgrupamiento(id) {
  const xml1 = new XMLHttpRequest();
  xml1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const respuesta = JSON.parse(xml1.responseText);
      if (respuesta.correcto) {
        actualizar_alumnos();
        actualizar_agrupamiento();
      }
    }
  };
  xml1.open(
    "DELETE",
    "php/agrupamientos.php?Usuario_idUsuario=" +
      id +
      "&Grupo_idGrupo=" +
      idGrupoSelect,
    true
  );
  xml1.send();
}

function borrarUsuario(id) {
  const xml1 = new XMLHttpRequest();
  xml1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const respuesta = JSON.parse(xml1.responseText);
      if (respuesta.correcto) {
        actualizar_alumnos();
      } else {
        alert(
          "No puede eliminar este usuario, primero debe ser eliminado de todos los grupos."
        );
      }
    }
  };
  xml1.open("DELETE", "php/usuario.php?idUsuario=" + id, true);
  xml1.send();
}

function actualizar_alumnos() {
  const xml1 = new XMLHttpRequest();
  xml1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const respuesta = JSON.parse(xml1.responseText);
      if (respuesta.correcto) {
        var dataSet = [];
        var usuarios = respuesta.usuarios;
        for (var i = 0; i < usuarios.length; i++) {
          var a =
            "<button type='button' style='width: 49%' class='btn btn-outline-primary' onclick='addAgrupamiento(" +
            +usuarios[i].idUsuario +
            ")'>" +
            "<i class='nav-icon fas fa-tasks'></i></button>";

          a +=
            "<button type='button' style='width: 49%' class='btn btn-outline-danger' onclick='borrarUsuario(" +
            +usuarios[i].idUsuario +
            ")'>" +
            "<i class='nav-icon fas fa-trash-alt'></i></button>";

          var d = [usuarios[i].nombrecompleto, usuarios[i].tipo, a];
          dataSet.push(d);
        }

        $("#example2").DataTable().clear().draw();
        $("#example2").DataTable().rows.add(dataSet);
        $("#example2").DataTable().columns.adjust().draw();
      }
    }
  };
  xml1.open("GET", "php/usuario.php?Grupo_idGrupo=" + idGrupoSelect, true);
  xml1.send();
}

function actualizar_agrupamiento() {
  const xml1 = new XMLHttpRequest();
  xml1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const respuesta = JSON.parse(xml1.responseText);
      if (respuesta.correcto) {
        var dataSet = [];
        var g = respuesta.grupos;
        for (var i = 0; i < g.length; i++) {
          var a =
            "<button type='button'class='btn btn-block btn-outline-danger' onclick='borrarUsuAgrupamiento(" +
            +g[i].idUsuario +
            ")'>" +
            "<i class='nav-icon fas fa-trash-alt'></i></button>";

          var d = [g[i].nombrecompleto, g[i].tipo, a];
          dataSet.push(d);
        }

        $("#example3").DataTable().clear().draw();
        $("#example3").DataTable().rows.add(dataSet);
        $("#example3").DataTable().columns.adjust().draw();
      }
    }
  };
  xml1.open(
    "GET",
    "php/agrupamientos.php?Grupo_idGrupo=" + idGrupoSelect,
    true
  );
  xml1.send();
}

function actualizar_Grupo() {
  const xml1 = new XMLHttpRequest();
  xml1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const respuesta = JSON.parse(xml1.responseText);
      if (respuesta.correcto) {
        grupos = respuesta.grupos;
        var dataSet = [];
        for (var i = 0; i < grupos.length; i++) {
          var a =
            "<button type='button' class='btn btn-outline-primary' data-toggle='modal'" +
            "data-target='#modal-Asignar' style='width: 33%' onclick='agrupar_Grupo(" +
            grupos[i].idGrupo +
            ")'> " +
            " <i class='nav-icon fas fa-user-friends'> </i> </button>";

          a +=
            "<button type='button' class='btn btn-outline-success' data-toggle='modal'" +
            "data-target='#modal-Actualizar' style='width: 33%' onclick='editar_Grupo(" +
            grupos[i].idGrupo +
            ")'> " +
            "<i class='nav-icon fas fa-pencil-alt'></i></button>";

          a +=
            "<button type='button' class='btn btn-outline-danger' data-toggle='modal'" +
            "data-target='#modal-Eliminar' style='width: 33%' onclick='borrar_Grupo(" +
            grupos[i].idGrupo +
            ")'> " +
            "<i class='nav-icon fas fa-trash-alt'></i></button>";

          var d = [grupos[i].nombre, grupos[i].descripcion, a];
          dataSet.push(d);
        }

        $("#example1").DataTable().clear().draw();
        $("#example1").DataTable().rows.add(dataSet);
        $("#example1").DataTable().columns.adjust().draw();
      }
    }
  };
  xml1.open("GET", "php/grupo.php", true);
  xml1.send();
}

document.getElementById("btn-enviar").addEventListener(
  "click",
  function () {
    var nombre = document.getElementById("nombre").value;
    var descripcion = document.getElementById("descripcion").value;
    var error = false;

    if (nombre == "") {
      alert("Campo nombre está vacío");
      error = true;
    }

    if (descripcion == "") {
      alert("Campo descripción está vacío");
      error = true;
    }

    if (!error) {
      const xml_nueva_noti = new XMLHttpRequest();
      xml_nueva_noti.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const respuesta = JSON.parse(xml_nueva_noti.responseText);
          if (respuesta.correcto) {
            document.getElementById("nombre").value = "";
            document.getElementById("descripcion").value = "";

            $(function () {
              $("#modal-Nuevo_Grupo").modal("toggle");
            });

            actualizar_Grupo();
          }
        }
      };
      xml_nueva_noti.open("POST", "php/grupo.php", true);

      var data = {};
      data["nombre"] = nombre;
      data["descripcion"] = descripcion;
      var data_json = JSON.stringify(data);
      xml_nueva_noti.send(data_json);
    }
  },
  false
);

document.getElementById("a_btn-enviar").addEventListener(
  "click",
  function () {
    var nombre = document.getElementById("a_nombre").value;
    var descripcion = document.getElementById("a_descripcion").value;
    var error = false;

    if (nombre == "") {
      alert("Campo nombre está vacío");
      error = true;
    }

    if (descripcion == "") {
      alert("Campo descripción está vacío");
      error = true;
    }

    if (!error) {
      const xml_nueva_noti = new XMLHttpRequest();
      xml_nueva_noti.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const respuesta = JSON.parse(xml_nueva_noti.responseText);
          if (respuesta.correcto) {
            document.getElementById("a_nombre").value = "";
            document.getElementById("a_descripcion").value = "";

            $(function () {
              $("#modal-Actualizar").modal("toggle");
            });

            actualizar_Grupo();
          }
        }
      };
      xml_nueva_noti.open(
        "PUT",
        "php/grupo.php?idGrupo=" + idGrupoSelect,
        true
      );

      var data = {};
      data["nombre"] = nombre;
      data["descripcion"] = descripcion;
      var data_json = JSON.stringify(data);
      xml_nueva_noti.send(data_json);
    }
  },
  false
);

document.getElementById("btn_eliminar").addEventListener(
  "click",
  function () {
    const xml1 = new XMLHttpRequest();
    xml1.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const respuesta = JSON.parse(xml1.responseText);
        if (respuesta.correcto) {
          $(function () {
            $("#modal-Eliminar").modal("toggle");
          });

          actualizar_Grupo();
        } else {
          document.getElementById("btn_eliminar").style.visibility = "hidden";
          document.getElementById("label_eliminar").innerText =
            "No puede eliminar este grupo, hay notificaciones de este grupo.";
        }
      }
    };
    xml1.open("DELETE", "php/grupo.php?idGrupo=" + idGrupoSelect, true);
    xml1.send();
  },
  false
);

document.getElementById("btn_agrup").addEventListener(
  "click",
  function () {
    $(function () {
      $("#modal-Asignar").modal("toggle");
    });
  },
  false
);
