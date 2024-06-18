var selected = document.getElementById("frame").getAttribute("page");
var options = document.querySelectorAll(".option");
for (let index = 0; index < options.length; index++) {
  if (index == selected) {
    options[index - 1].style.backgroundColor = "darkcyan";
  } else {
  }
}

var iframe = document.getElementById("frame");
var options = document.querySelectorAll(".option");

options.forEach((element, index) => {
  element.addEventListener("mouseenter", function () {
    element.style.backgroundColor = "darkcyan";
  });

  element.addEventListener("mouseleave", function () {
    if (element.getAttribute("data-selected") !== "true") {
      element.style.backgroundColor = "transparent";
    }
  });
});

options.forEach((option, index) => {
  option.addEventListener("click", function () {
    iframe.src = "../controller/" + option.getAttribute("id") + ".php";
    iframe.setAttribute("page", index);

    options.forEach((element, i) => {
      element.style.backgroundColor = "transparent";
      element.setAttribute("data-selected", "false");
      element.style.color = "";
    });

    if (index === 5) {
      option.style.backgroundColor = "crimson";
      option.style.color = "white";
    } else {
      option.style.backgroundColor = "rgb(24, 24, 24)";
    }
    option.setAttribute("data-selected", "true");
  });
});

options[0].setAttribute("data-selected", "true");

options[5].addEventListener("mouseenter", function () {
  this.style.backgroundColor = "crimson";
  this.style.color = "white";
});

options[5].addEventListener("mouseleave", function () {
  if (this.getAttribute("data-selected") === "true") {
    this.style.backgroundColor = "crimson";
    this.style.color = "white";
  } else {
    this.style.backgroundColor = "transparent";
    this.style.color = "crimson";
  }
});

var leftMenu = document.querySelector(".left-menu");
var showMenu = document.querySelector(".showMenu");

if (window.innerWidth <= 800) {
  leftMenu.style.left = "-260px";
  iframe.style.width = "100%";
  showMenu.style.left = "-10px";
}

showMenu.addEventListener("click", function () {
  showMenu.style.left = "-30px";
  leftMenu.style.left = "0";
});

window.addEventListener("resize", function () {
  if (window.innerWidth < 870) {
    leftMenu.style.left = "-260px";
    iframe.style.width = "100%";
    showMenu.style.left = "-10px";
  } else {
    leftMenu.style.left = "0";
    iframe.style.width = "calc(100% - 30%)";
    showMenu.style.left = "-30px";
  }
});

function refreshIframeCloseMenu() {
  const iframeDocument =
    iframe.contentDocument || iframe.contentWindow.document;
  iframeDocument.addEventListener("click", function (event) {
    if (!event.target.closest(".left-menu") && window.innerWidth < 871) {
      leftMenu.style.left = "-260px";
      showMenu.style.left = "-10px";
    }
  });
}

iframe.addEventListener("load", function () {
  refreshIframeCloseMenu();
});

refreshIframeCloseMenu();
