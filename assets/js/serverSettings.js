document.getElementById("back").addEventListener("click", function () {
  window.history.back();
});

var selected = document.getElementById("frame").getAttribute("page");
console.log(selected);
var options = document.querySelectorAll(".option");
console.log(options[0].textContent);
for (let index = 0; index < options.length; index++) {
  if (index == selected) {
    options[index - 1].style.backgroundColor = "rgb(24, 24, 24)";
  }
}

var iframe = document.getElementById("frame");
options.forEach((option, index) => {
  option.addEventListener("click", function () {
    iframe.src = "../controller/" + option.getAttribute("id") + ".php";
    iframe.page = index;
    options.forEach((element, i) => {
      element.style.backgroundColor = "transparent";
      if (index == i) {
        element.style.backgroundColor = "rgb(24, 24, 24)";
      }
    });
  });
});
