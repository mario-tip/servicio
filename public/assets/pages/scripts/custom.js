// ### Saludo en el header ###

function mostrarSaludo() {

  var today = new Date();
  var hourNow = today.getHours();
  var greeting;

  if (hourNow < 12) {
    greeting = "Good morning";
  } else if (hourNow < 18) {
    greeting = 'Good afternoon';
  } else if (hourNow < 24) {
    greeting = "Good night"
  } else {
    greeting = "Welcome";
  }

  document.getElementById("saludo").innerHTML = greeting;

}

mostrarSaludo();

// ### Fecha actual en el dashboard ###

function fechaActual() {

  var today = new Date();
  var day = today.getDate();
  var month = today.getMonth() + 1;
  var year = today.getFullYear();

  if (day < 10) {
    day = '0' + day
  }
  if (month < 10) {
    month = '0' + month
  }

  var out = document.getElementById("fecha");
  out.innerHTML = month + "/" + day + "/" + year;

}

fechaActual();

// ### Hora actual en el dashboard ###

function horaActual() {

  var today = new Date();

    var h = today.getHours(); // 0 - 23
    var m = today.getMinutes(); // 0 - 59
    var s = today.getSeconds(); // 0 - 59
    var session = "AM";

    if(h == 0){
        h = 12;
    }

    if(h > 12){
        h = h - 12;
        session = "PM";
    }

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;

    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("reloj").innerText = time;
    document.getElementById("reloj").textContent = time;

    setTimeout(horaActual, 1000);

}

horaActual();
