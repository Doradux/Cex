var show = document.getElementById("show");
var emailHider = document.getElementById("cover");
emailHider.style.display = "block";
window.addEventListener("load", function () {
  show.addEventListener("click", function () {
    if (emailHider.style.display == "block") {
      emailHider.style.display = "none";
      show.textContent = "HIDE";
    } else {
      emailHider.style.display = "block";
      show.textContent = "REVEAL";
    }
  });
});
