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

//modify/delete msg context menu
var msgs = document.querySelectorAll(".msg");
const msgContextMenu = document.querySelector(".msg-context-menu-div");
const msgContextMenuShield = document.querySelector(".msg-context-menu-shield");
const modifyMessageDiv = document.querySelector(".modify-msg-div");
const modifyMessageShield = document.querySelector(".modify-msg-shield");
var msgId = "";
msgs.forEach((msg) => {
  if (role == "admin" || msg.getAttribute("senderId") == currentId) {
    msg.addEventListener("contextmenu", function () {
      event.preventDefault();
      msgContextMenuShield.style.display = "flex";
      const mouseX = event.clientX;
      const mouseY = event.clientY;
      msgContextMenu.style.left = `${mouseX}px`;
      msgContextMenu.style.top = `${mouseY}px`;

      const deleteMsgBtn = document.getElementById("del-msg");
      const messageId = msg.getAttribute("messageId");
      msgId = msg.getAttribute("messageId");
      deleteMsgBtn.addEventListener("click", function () {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if (response.success) {
            } else {
              console.log(response);
            }
          }
        };

        xhttp.open("POST", "./jsToPhp/message-action.php", true);
        xhttp.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        var params = "delId=" + encodeURIComponent(messageId);
        xhttp.send(params);
      });

      const modifyMsgBtn = document.getElementById("modify-msg");
      modifyMsgBtn.addEventListener("click", function () {
        modifyMessageShield.style.display = "flex";
        modifyMessageDiv.querySelector(".modify-content").textContent =
          msg.querySelector(".messageContent").textContent;
      });

      modifyMessageShield.addEventListener("click", function () {
        if (!event.target.closest(".modify-msg-div")) {
          modifyMessageShield.style.display = "none";
        }
      });

      const cancelModify = document.getElementById("modify-del");
      cancelModify.addEventListener("click", function () {
        modifyMessageShield.style.display = "none";
      });
    });
  }
});

const saveModify = document.getElementById("modify-save");
saveModify.addEventListener("click", function () {
  const newMsg = modifyMessageDiv.querySelector(".modify-content").value;
  // const msgId = msg.getAttribute("messageId");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      if (response.success) {
        modifyMessageShield.style.display = "none";
      } else {
        console.log(response);
      }
    }
  };
  xhttp.open("POST", "./jsToPhp/message-action.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params =
    "modId=" +
    encodeURIComponent(msgId) +
    "&newMsg=" +
    encodeURIComponent(newMsg);
  xhttp.send(params);
});

msgContextMenuShield.addEventListener("click", function () {
  this.style.display = "none";
});

msgContextMenuShield.addEventListener("contextmenu", function () {
  event.preventDefault();
  this.style.display = "none";
});
