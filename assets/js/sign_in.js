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
  option.value = i + 1;
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

//register user
var registerBtn = document.getElementById("confirmRegister");
registerBtn.addEventListener("click", function (event) {
  event.preventDefault();
  console.log(registerUser());
});

function registerUser() {
  var valid = true;
  document.getElementById("label3").addEventListener("input", function () {
    document.getElementById("emailError").innerText = "";
  });
  var e = document.getElementById("label3").value;
  if (e == "") {
    valid = false;
    document.getElementById("label3").style.outline = "1px solid crimson";
    document.getElementById("emailError").innerText = "Email is required.";
  } else if (!isValidEmail(e)) {
    valid = false;
    document.getElementById("label3").style.outline = "1px solid crimson";
    document.getElementById("emailError").innerText =
      "Email format is not valid.";
  } else {
    document.getElementById("emailError").innerText = "";
  }

  document.getElementById("label5").addEventListener("input", function () {
    document.getElementById("usernameError").innerText = "";
  });
  var u = document.getElementById("label5").value;
  if (u == "") {
    valid = false;
    document.getElementById("label5").style.outline = "1px solid crimson";
    document.getElementById("usernameError").innerText =
      "Username is required.";
  } else {
    document.getElementById("usernameError").innerText = "";
  }

  document.getElementById("label6").addEventListener("input", function () {
    document.getElementById("passwordError").innerText = "";
  });
  var p = document.getElementById("label6").value;
  if (p == "") {
    valid = false;
    document.getElementById("label6").style.outline = "1px solid crimson";
    document.getElementById("passwordError").innerText =
      "Password is required.";
  } else if (!isValidPassword(p)) {
    valid = false;
    document.getElementById("label6").style.outline = "1px solid crimson";
    document.getElementById("passwordError").innerText =
      "Password must be more than 6 characters.";
  } else {
    document.getElementById("passwordError").innerText = "";
  }

  document.getElementById("label6-1").addEventListener("input", function () {
    document.getElementById("repeatPasswordError").innerText = "";
  });
  var rp = document.getElementById("label6-1").value;
  if (rp == "") {
    valid = false;
    document.getElementById("label6-1").style.outline = "1px solid crimson";
    document.getElementById("repeatPasswordError").innerText =
      "Repeat password is required.";
  } else if (rp != p) {
    valid = false;
    document.getElementById("repeatPasswordError").innerText =
      "Passwords do not match.";
    document.getElementById("label6").style.outline = "1px solid crimson";
    document.getElementById("label6-1").style.outline = "1px solid crimson";
  } else {
    document.getElementById("label6").style.outline = "none";
    document.getElementById("repeatPasswordError").innerText = "";
  }

  const dateSelects = document.querySelectorAll("select");
  if (document.getElementById("month").value != "") {
    var month = document.getElementById("month").value;
  } else {
    valid = false;
    dateSelects[0].style.outline = "1px solid crimson";
    document.getElementById("dateError").innerText = "Invalid date";
  }

  if (document.getElementById("day").value != "") {
    var day = document.getElementById("day").value;
  } else {
    valid = false;
    dateSelects[1].style.outline = "1px solid crimson";
    document.getElementById("dateError").innerText = "Invalid date";
  }

  if (document.getElementById("year").value != "") {
    var year = document.getElementById("year").value;
  } else {
    valid = false;
    dateSelects[2].style.outline = "1px solid crimson";
    document.getElementById("dateError").innerText = "Invalid date";
  }

  dateSelects.forEach((element) => {
    element.addEventListener("change", function () {
      element.style.outline = "none";
      document.getElementById("dateError").innerText = "";
    });
  });

  if (!document.getElementById("label8").checked) {
    valid = false;
    document.getElementById("eulaError").innerText = "You must confirm this.";
  }

  document.getElementById("label8").addEventListener("change", function () {
    document.getElementById("eulaError").innerText = "";
  });

  var birthDate = new Date(year, month - 1, day);

  var b = birthDate.toISOString().split("T")[0];
  console.log(b);

  if (valid) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        // console.log(response.message);
        if (response.success) {
          window.location.href = "./home.php";
        } else if (response.error) {
        }
      }
    };
    xhttp.open("POST", "./controller/jsToPhp/registerUser.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params =
      "username=" +
      encodeURIComponent(u) +
      "&email=" +
      encodeURIComponent(e) +
      "&password=" +
      encodeURIComponent(p) +
      "&birth=" +
      encodeURIComponent(b);
    xhttp.send(params);
  }
}

//login user
var loginBtn = document.getElementById("confirmLogin");
loginBtn.addEventListener("click", function (event) {
  event.preventDefault();
  console.log(loginUser());
});

const logInInputs = document.querySelectorAll(".logInInputs");
function loginUser() {
  // console.log("login in");

  var u = document.getElementById("label1").value;
  var p = document.getElementById("label2").value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      // console.log(response.message);
      if (response.success) {
        window.location.href = "./home.php";
      } else {
        document.getElementById("error").textContent = response.error;
        logInInputs.forEach((element) => {
          element.style.outline = "1px solid crimson";
        });
      }
    }
  };
  xhttp.open("POST", "./controller/jsToPhp/loginIn.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params =
    "username=" + encodeURIComponent(u) + "&password=" + encodeURIComponent(p);
  xhttp.send(params);
}

const allInputs = document.querySelectorAll("input");
allInputs.forEach((input) => {
  input.addEventListener("input", function () {
    input.style.outline = "none";
    document.getElementById("error").textContent = "";
  });
});

function isValidEmail(email) {
  const emailPattern = /^[^@]+@[^@]+\.[^@]+$/;
  return emailPattern.test(email);
}

function isValidPassword(password) {
  return password.length > 6;
}
