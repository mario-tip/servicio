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


$ (document).ready (function () {
  $ (".modal a").not (".dropdown-toggle").on ("click", function () {
    $ (".modal").modal ("hide");
  });
});
