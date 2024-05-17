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
