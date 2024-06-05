document.addEventListener("DOMContentLoaded", function () {
  var inputField = document.getElementById("sendMsg");
  inputField.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      sendMsg();
    }
  });
});

function sendMsg() {
  console.log("sendingMsg");

  var msg = document.getElementById("sendMsg").value;
  document.getElementById("sendMsg").value = null;
  var chanelId = document.getElementById("chanelId").value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
    }
  };
  xhttp.open("POST", "./jsToPhp/postMsg.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params =
    "message=" +
    encodeURIComponent(msg) +
    "&chanelId=" +
    encodeURIComponent(chanelId);
  xhttp.send(params);
}
