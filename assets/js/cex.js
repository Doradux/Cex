function addServer() {
  var modal = document.getElementById("modal");
  modal.style.display = "flex";
}

var joinS = document.getElementById("joinS");
joinS.addEventListener("click", function (event) {
  event.preventDefault();
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
  xhttp.open("POST", "../model/PostServer.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params =
    "name=" +
    encodeURIComponent(name) +
    "&creationTime=" +
    encodeURIComponent(formattedDate) +
    "&create=1";
  xhttp.send(params);
}
