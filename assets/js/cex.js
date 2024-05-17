function addServer() {
  var modal = document.getElementById("modal");
  modal.style.display = "flex";
}

add = document.getElementById("add");
iframe = document.getElementById("iframe");
document.addEventListener("click", function (event) {
  if (
    (event.target !== modal &&
      event.target !== add &&
      !modal.contains(event.target)) ||
    event.target === iframe
  ) {
    modal.style.display = "none";
  }
});

iframe.contentWindow.document.addEventListener("click", function (event) {
  modal.style.display = "none";
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
  var modal = document.getElementById("modal");
  modal.style.display = "none";

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
      console.log(this.responseText);
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
  sid = document.getElementById("joinServerId").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      // console.log(response.message);
      if (response.status === "success") {
        window.location.href = "./home.php";
      } else {
        alert(response.message);
      }
    }
  };
  xhttp.open("POST", "./controller/jsToPhp/joinServer.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var params = "&serverId=" + encodeURIComponent(sid);
  xhttp.send(params);
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
      const newUrl = './controller/server_content.php?serId=' + serId;
      iframe.src = newUrl;
    });
  });
});
