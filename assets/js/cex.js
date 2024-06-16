var joinServerShield = document.querySelector(".join-server-shield");
function addServer() {
  joinServerShield.style.display = "flex";
}

joinServerShield.addEventListener("click", function () {
  if (!event.target.closest(".join-server-div")) {
    this.style.display = "none";
  }
});

var joinS = document.getElementById("joinS");
joinS.addEventListener("click", function (event) {
  event.preventDefault();
  joinServer();
});

var createS = document.getElementById("createS");
createS.addEventListener("click", function (event) {
  event.preventDefault();
  createServer();
});

function createServer() {
  joinServerShield.style.display = "none";

  var name = document.getElementById("createServerName").value;

  var currentDate = new Date();
  var year = currentDate.getFullYear();
  var month = currentDate.getMonth() + 1;
  var day = currentDate.getDate();
  var hours = currentDate.getHours();
  var minutes = currentDate.getMinutes();
  var seconds = currentDate.getSeconds();

  var formattedDate =
    year +
    "-" +
    (month < 10 ? "0" + month : month) +
    "-" +
    (day < 10 ? "0" + day : day) +
    " " +
    (hours < 10 ? "0" + hours : hours) +
    ":" +
    (minutes < 10 ? "0" + minutes : minutes) +
    ":" +
    (seconds < 10 ? "0" + seconds : seconds);

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      location.reload();
    }
  };
  xhttp.open("POST", "./model/PostServer.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params =
    "name=" +
    encodeURIComponent(name) +
    "&creationTime=" +
    encodeURIComponent(formattedDate) +
    "&create=1";
  xhttp.send(params);
}

function joinServer() {
  var sid = document.getElementById("joinServerId").value;
  window.location = "http://" + sid;
}

//tooltip server icons name
document.addEventListener("DOMContentLoaded", function () {
  const tooltip = document.getElementById("tooltip");
  const serverIcons = document.querySelectorAll(".serverIco");

  serverIcons.forEach((icon) => {
    icon.addEventListener("mouseover", function () {
      tooltip.textContent = this.getAttribute("name");
      tooltip.style.display = "block";
    });

    icon.addEventListener("mousemove", function (event) {
      tooltip.style.left = event.pageX + 10 + "px";
      tooltip.style.top = event.pageY + 10 + "px";
    });

    icon.addEventListener("mouseout", function () {
      tooltip.style.display = "none";
    });
  });

  //show server
  serverIcons.forEach((icon) => {
    icon.addEventListener("click", function () {
      const serId = icon.getAttribute("serId");
      const newUrl = "./controller/server_content.php?serId=" + serId;
      iframe.src = newUrl;
    });
  });
});

//go to edit profile
var editProfileBtn = document.getElementById("edit-profile-btn");
editProfileBtn.addEventListener("click", function () {
  userOptionsMenu.style.display = "none";
  iframe.src = "../controller/editProfile.php";
});

//go landing page
const landing = document.getElementById("home");
landing.addEventListener("click", function () {
  iframe.src = "../controller/landing.php";
});

//set status
const setStatusBtn = document.getElementById("set-status-btn");
const statusShield = document.querySelector(".status-shield");
const statusDiv = document.querySelector(".status");
const cancelStatus = document.getElementById("cancel-status");
const confirmStatus = document.getElementById("set-status");
const statusTextarea = document.getElementById("status-value");

setStatusBtn.addEventListener("click", function () {
  statusShield.style.display = "flex";
});

statusShield.addEventListener("click", function (event) {
  if (!event.target.closest(".status")) {
    statusShield.style.display = "none";
  }
});

cancelStatus.addEventListener("click", function (event) {
  statusShield.style.display = "none";
});

confirmStatus.addEventListener("click", function () {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      if (response.success) {
        statusShield.style.display = "none";
      } else {
        console.error(response);
      }
    }
  };
  xhttp.open("POST", "./controller/jsToPhp/editProfile.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params = "newStatus=" + encodeURIComponent(statusTextarea.value);
  xhttp.send(params);
});
