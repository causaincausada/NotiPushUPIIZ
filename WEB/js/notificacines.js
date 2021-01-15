//Traer estos datos de la api
var nameGrupos = [];
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
idGrupos.push("3");
setGrupos(nameGrupos, idGrupos);


function setGrupos(nameGrupos, idGrupos) {
  var x = document.getElementById("select-grupo");

  for (var i = 0; i < nameGrupos.length; i++) {
    var option = document.createElement("option");
    option.text = nameGrupos[i];
    option.value = idGrupos[i];
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

    if(asunto == ""){
      alert("Campo asunto está vacío");
      error = true;
    }

    if(descripcion == ""){
      alert("Campo descripción está vacío");
      error = true;
    }

    if(grupo == "-1"){
      alert("Debe seleccionar un grupo");
      error = true;
    }

    if(!error){
      //LLamar a la api agregar noti
    }
  },
  false
);
