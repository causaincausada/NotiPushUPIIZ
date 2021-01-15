if (sessionStorage.getItem("tipo") === null) {
    alert("No ha iniciado sesión");
    location.href = "login.html";
  }