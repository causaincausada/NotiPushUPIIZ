window.onload = function () {
    document.getElementById("form_login").addEventListener(
      "submit",
      function (event) {
        event.preventDefault();
        
        console.log("peticion a la api");
      },
      false
    );
  };