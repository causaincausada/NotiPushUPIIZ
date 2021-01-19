window.onload = function () {
  document.getElementById("form_login").addEventListener(
    "submit",
    function (event) {
      event.preventDefault();

      var usuario = document.getElementById("username").value;
      var clave = document.getElementById("password").value;

      const xml1 = new XMLHttpRequest();
      xml1.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const respuesta = JSON.parse(xml1.responseText);
          if (respuesta.correcto) {
            if (respuesta.login) {
              location.href = "Menu.html";
              sessionStorage.setItem("tipo", "1");
            } else {
              alert("Usuario o contraseña incorrectos ");
              document.getElementById("username").value = "";
              document.getElementById("password").value = "";
            }
          }
        }
      };
      xml1.open("GET", "php/login.php?usuario=" + usuario +"&clave=" + clave, true);
      xml1.send();
    },
    false
  );
};
