//show login form when page load
window.addEventListener("load", function () {
  gsap.set(".login", {
    display: "flex",
  });
  gsap.from(".login", {
    y: -600,
    scale: 0,
    duration: 1,
  });

  circleAnimation();
});
var tl = gsap.timeline({});

//cicle animaion when login form showing
function circleAnimation() {
  gsap.set(".circle", {
    transformOrigin: "50% 50%",
    width: "60px",
    height: "60px",
  });

  var duracionTotal = 1;
  var radio = 150;

  var size = 60;
  var numPasos = 360;

  for (var i = 0; i < numPasos; i++) {
    var angulo = i + 100 * (380 / numPasos);
    var x = Math.cos((angulo * Math.PI) / 180) * radio;
    var y = Math.sin((angulo * Math.PI) / 180) * radio;
    size -= 0.17;

    tl.to(".circle", {
      x: x,
      y: y,
      width: size,
      height: size,
      duration: duracionTotal / numPasos,
      ease: "none",
    });
  }
}

//events for register link
var reg = document.getElementById("reg");
reg.addEventListener("click", goToRegisterPage);
reg.addEventListener("mouseover", function () {
  this.style.cursor = "pointer";
});

function goToRegisterPage() {
  tl.to(".login", {
    y: -600,
    scale: 0,
    duration: 0.5,
    onComplete: showRegister,
  });
}

//events for log link
var log = document.getElementById("log");
log.addEventListener("click", goToLoginPage);
log.addEventListener("mouseover", function () {
  this.style.cursor = "pointer";
});

function goToLoginPage() {
  tl.to(".register", {
    y: -600,
    scale: 0,
    duration: 0.5,
    onComplete: showLogin,
  });

}

//shows register form
function showRegister() {
  gsap.set(".register", {
    y: -600,
    display: "block",
    scale: 0,
  });
  gsap.to(".register", {
    y: 0,
    opacity: 1,
    scale: 1,
    duration: 0.5,
  });
}

//shows login form
function showLogin() {
  gsap.set(".login", {
    display: "flex",
  });
  gsap.to(".login", {
    circleAnimation,
    y: 0,
    scale: 1,
    duration: 0.5,
  });
}

//register dinamyc days and years
var days = document.getElementById("day");
for (var i = 1; i <= 31; i++) {
  var option = document.createElement("option");
  option.value = i;
  option.text = i;
  days.appendChild(option);
}

var years = document.getElementById("year");
var currentYear = new Date().getFullYear();
for (var i = currentYear; i >= 1940; i--) {
  var option = document.createElement("option");
  option.value = i;
  option.text = i;
  years.appendChild(option);
}
