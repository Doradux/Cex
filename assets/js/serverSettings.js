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

options.forEach((element, index) => {
  element.addEventListener("mouseenter", function () {
    element.style.backgroundColor = "rgb(24, 24, 24)";
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
