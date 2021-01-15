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
  var tabla = document.getElementById("example1");
  var tblBody = document.createElement("tbody");
  for (var i = 0; i < asuntos.length; i++) {
    var hilera = document.createElement("tr");

    var celda = document.createElement("td");
    var textoCelda = document.createTextNode(asuntos[i]);
    celda.appendChild(textoCelda);
    hilera.appendChild(celda);

    var celda = document.createElement("td");
    var textoCelda = document.createTextNode(grupo[i]);
    celda.appendChild(textoCelda);
    hilera.appendChild(celda);

    var parrafo25 = document.createElement("p");
    parrafo25.innerHTML =
      "<button type='button' class='btn btn-outline-primary' data-toggle='moda' data-target='#modal-VerNotificacion' style='width: 32%'> VER</button>";
    parrafo25.className = "text_form";

    var celda = document.createElement("td");
    celda.style.textAlign = "center";
    celda.style.verticalAlign = "middle";
    celda.appendChild(parrafo25);
    hilera.appendChild(celda);

    tblBody.appendChild(hilera);
  }
  tabla.appendChild(tblBody);
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
      const xml_nueva= new XMLHttpRequest();
      xml_nueva.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const respuesta = JSON.parse(xml_nueva.responseText);
          console.log(respuesta);
          if (respuesta.correcto == "1") {
            setGrupos(respuesta.grupos);
          }
        }
      };
      xml_nueva.open("POST", "php/nueva_notificacion.php?titulo=hola&descripcion=holimunto&fecha=17072000&Grupo_idGrupo=1", true);
      xml_nueva.send();
    }
  },
  false
);
