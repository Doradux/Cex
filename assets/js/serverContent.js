const groups = document.getElementById("groups");
const chanelsOptions = document.querySelector(".chanelsOptions");

//open groups/chanels menu
groups.addEventListener("contextmenu", function (event) {
  if (event.target.matches("#groups, #groups *") && role == "admin") {
    event.preventDefault();

    // Obtener las dimensiones del menú y de la ventana
    const menuWidth = chanelsOptions.offsetWidth;
    const menuHeight = chanelsOptions.offsetHeight;
    const windowWidth = window.innerWidth;
    const windowHeight = window.innerHeight;

    // Calcular las posiciones iniciales
    let left = event.clientX;
    let top = event.clientY;

    // Ajustar la posición si el menú se sale de la ventana
    if (left + menuWidth > windowWidth) {
      left = windowWidth - menuWidth;
    }
    if (top + menuHeight > windowHeight) {
      top = windowHeight - menuHeight;
    }

    // Asegurarse de que las posiciones no sean negativas
    if (left < 0) {
      left = 0;
    }
    if (top < 0) {
      top = 0;
    }

    // Establecer la posición del menú
    chanelsOptions.style.display = "flex";
    chanelsOptions.style.left = left + "px";
    chanelsOptions.style.top = top + "px";
  }
});

//close gourps/chanels menu
document.addEventListener("click", function (event) {
  if (!event.target.closest(".chanelsOptions")) {
    chanelsOptions.style.display = "none";
  }
});

//tooltip
document.addEventListener("DOMContentLoaded", function () {
  const addChanel = document.querySelectorAll("a");

  addChanel.forEach((link) => {
    if (link.textContent.trim() === "+") {
      link.addEventListener("mouseover", function () {
        const tooltip = document.getElementById("tooltip");
        tooltip.textContent = "Create new chanel";
        tooltip.style.display = "block";

        // Posicionar el tooltip encima del enlace a
        const linkRect = link.getBoundingClientRect();
        tooltip.style.left = linkRect.left + -65 + "px";
        tooltip.style.top = linkRect.top - tooltip.offsetHeight + "px";
      });

      link.addEventListener("mouseout", function () {
        const tooltip = document.getElementById("tooltip");
        tooltip.style.display = "none";
      });
    }
  });
});

// const arrow = document.getElementById("arrow");
const serverOptions = document.querySelector(".serverOptions");

//open groups/chanels menu
arrow.addEventListener("click", function (event) {
  if (event.target.matches("#arrow")) {
    event.preventDefault();
    serverOptions.style.display = "flex";
    const arrowpos = arrow.getBoundingClientRect();
    serverOptions.style.left = arrowpos.left + -220 + "px";
    serverOptions.style.top = arrowpos.top - tooltip.offsetHeight + +25 + "px";
    requestAnimationFrame(() => {
      serverOptions.style.clipPath = "polygon(0 0, 100% 0, 100% 100%, 0 100%)";
    });
  }
});

//close gourps/chanels menu
document.addEventListener("click", function (event) {
  if (
    !event.target.closest(".serverOptions") &&
    !event.target.matches("#arrow")
  ) {
    serverOptions.style.clipPath = "polygon(0 0, 100% 0, 100% 0, 0 0)";
    serverOptions.style.display = "none";
  }
});

var chanelLinks = document.querySelectorAll(".chanelLink");
chanelLinks.forEach((link) => {
  link.addEventListener("click", function () {
    preventDefault();
  });
});

//get chanels content
var chanelsLinks = document.querySelectorAll(".chanelLink");

chanelsLinks.forEach(function (link) {
  link.addEventListener("click", function (event) {
    event.preventDefault();
    var chanelId = link.getAttribute("href");

    document
      .getElementById("chanelContent")
      .setAttribute(
        "src",
        "../controller/text_chanel.php?chanelId=" + chanelId
      );
  });
});

//scroll down when open chat
document.getElementById("chanelContent").onload = function () {
  var iframe = document.getElementById("chanelContent");
  iframe.contentWindow.scrollTo(0, iframe.contentDocument.body.scrollHeight);
};

var addChanelUtility = document.getElementById("postChanelUtility");
var chanelIdToPost = document.getElementById("chanelGroupIdToPost");
var addChanelPerGroupPluses = document.querySelectorAll(".addServerInGroup");
addChanelPerGroupPluses.forEach(function (plus) {
  plus.addEventListener("click", function () {
    event.preventDefault();
    addChanelUtility.style.display = "flex";
    chanelIdToPost.value = event.getAttribute("href");
  });
});

//select type
var selectType = document.getElementById("chanelTypeToPost");
var typeHider = document.getElementById("typeHider");
var emoji = document.getElementById("typeEmoji");
var type = 0;
selectType.addEventListener("click", function () {
  if (type == 0) {
    typeHider.style.transform = "translateX(-148px)";
    emoji.textContent = "🔊";
    emoji.style.transform = "rotate(-360deg)";
    type = 1;
  } else if (type == 1) {
    typeHider.style.transform = "translateX(0)";
    emoji.textContent = "📖";
    emoji.style.transform = "rotate(0)";
    type = 0;
  }
});
