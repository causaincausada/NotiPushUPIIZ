window.onload = function () {
    document.getElementById("salir").addEventListener(
      "click",
      function (event) {
        event.preventDefault();
        sessionStorage.clear();
        location.href = "login.html";
      },
      false
    );
  };