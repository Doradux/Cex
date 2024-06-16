document.addEventListener("DOMContentLoaded", function () {
  var inputField = document.getElementById("sendMsg");

  inputField.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault(); // Evitar el envío automático del formulario
      sendMsg();
    }
  });

  var confirmSendMsgButton = document.querySelector(".confirmSendMsg");

  if (confirmSendMsgButton) {
    confirmSendMsgButton.addEventListener("click", function () {
      sendMsg();
    });
  }
});

function sendMsg() {
  var message = document.getElementById("sendMsg").value;
  // Aquí puedes agregar la lógica para enviar el mensaje, por ejemplo, con AJAX
  console.log("Message sent:", message);
  // Limpia el campo de entrada después de enviar el mensaje, si es necesario
  document.getElementById("sendMsg").value = "";
}

function sendMsg() {
  var msg = document.getElementById("sendMsg").value;
  document.getElementById("sendMsg").value = null;
  var chanelId = document.getElementById("chanelId").value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      fetchMessages();
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
