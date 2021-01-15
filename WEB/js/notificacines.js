//Traer estos datos de la api
/*var nameGrupos = [];
nameGrupos.push("Hola");
nameGrupos.push("Hola2");
nameGrupos.push("Hola3");
nameGrupos.push("Hola");
nameGrupos.push("Hola2");
nameGrupos.push("Hola3");

var idGrupos = [];
idGrupos.push("1");
idGrupos.push("2");
idGrupos.push("3");
idGrupos.push("1");
idGrupos.push("2");
idGrupos.push("3");*/

var dataSet = [
  [ "Tiger Nixon", "System Architect", "Edinburgh" ],
  [ "Garrett Winters", "Accountant", "Tokyo" ],
  [ "Ashton Cox", "Junior Technical Author", "San Francisco"],
];

const xml = new XMLHttpRequest();
xml.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    const respuesta = JSON.parse(xml.responseText);
    console.log(respuesta);
    if (respuesta.correcto == "1") {
      setGrupos(respuesta.grupos);
    }
  }
};
xml.open("POST", "php/traer_grupos.php", true);
xml.send();



//Traer estos datos de la api
var asuntos = [];
asuntos.push("a");
asuntos.push("a");
asuntos.push("a");

var grupo = [];
grupo.push("x");
grupo.push("x");
grupo.push("x");

var idNoti = [];
grupo.push("1");
grupo.push("2");
grupo.push("3");

setNoti(asuntos, grupo, idNoti);

function setNoti(asuntos, grupo, idNoti) {
  
  for (var i = 0; i <asuntos.length; i++){
    var b = "<button type='button' class='btn btn-outline-primary' data-toggle='moda' data-target='#modal-VerNotificacion' style='width: 100%;'> VER</button>";
    var d = [asuntos[i], grupo[i], b];
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
      //LLamar a la api agregar noti
    }
  },
  false
);

function setTablaData(){
  $("#example1")
          .DataTable({
            data: dataSet,
      columns: [
          { title: "Autor" },
          { title: "Grupo" },
          { title: "Acción" },
      ],
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