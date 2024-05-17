const groups = document.getElementById("groups");
const chanelsOptions = document.querySelector(".chanelsOptions");

//open groups/chanels menu
groups.addEventListener("contextmenu", function (event) {
  if (event.target.matches("#groups, #groups *") && role == "admin") {
    event.preventDefault();
    chanelsOptions.style.display = "flex";
    chanelsOptions.style.left = event.clientX + "px";
    chanelsOptions.style.top = event.clientY + "px";
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

var chanelLinks = document.querySelectorAll('.chanelLink');
chanelLinks.forEach((link) => {
  link.addEventListener('click', function() {
    preventDefault();
  })
})

