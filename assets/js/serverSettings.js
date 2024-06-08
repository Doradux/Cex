document.getElementById("back").addEventListener("click", function () {
  window.history.back();
});

var selected = document.getElementById("frame").getAttribute("page");
var options = document.querySelectorAll(".option");
for (let index = 0; index < options.length; index++) {
  if (index == selected) {
    options[index - 1].style.backgroundColor = "rgb(24, 24, 24)";
  } else {
  }
}

var iframe = document.getElementById("frame");
var options = document.querySelectorAll(".option");

// Aplicar event listeners para el efecto hover una sola vez
options.forEach((element, index) => {
  element.addEventListener("mouseenter", function () {
    element.style.backgroundColor = "rgb(24, 24, 24)";
  });

  element.addEventListener("mouseleave", function () {
    // Solo restablecer el color si no es el elemento seleccionado
    if (element.getAttribute("data-selected") !== "true") {
      element.style.backgroundColor = "transparent";
    }
  });
});

// Manejar el evento de clic y gestionar el estado seleccionado
options.forEach((option, index) => {
  option.addEventListener("click", function () {
    iframe.src = "../controller/" + option.getAttribute("id") + ".php";
    iframe.setAttribute("page", index);

    // Restablecer el color de fondo y estado de todas las opciones
    options.forEach((element, i) => {
      element.style.backgroundColor = "transparent";
      element.setAttribute("data-selected", "false");
    });

    // Aplicar el color de fondo y establecer el estado de la opción seleccionada
    option.style.backgroundColor = "rgb(24, 24, 24)";
    option.setAttribute("data-selected", "true");
  });
});
