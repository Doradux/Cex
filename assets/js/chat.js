var msgContextMenuShield = document.querySelector(".msg-context-menu-shield");

// Function to fetch messages via AJAX
function fetchMessages() {
  $.ajax({
    url: "../controller/fetch-messages.php",
    type: "POST",
    data: { sender: currentId, chanel: chanelId },
    success: function (data) {
      $("#msgs-container").html(data);
      getMsgs(currentId, role, msgContextMenuShield); // Call getMsgs after updating the messages
    },
  });
}

function fetchMessages1() {
  $.ajax({
    url: "../controller/fetch-messages.php",
    type: "POST",
    data: { sender: currentId, chanel: chanelId },
    success: function (data) {
      $("#msgs-container").html(data);
      getMsgs(currentId, role, msgContextMenuShield); // Call getMsgs after updating the messages
      scrollToBottom();
    },
  });
}

// Function to handle message context menu and actions
function getMsgs(currentId, role, msgContextMenuShield) {
  if (msgContextMenuShield) {
    msgContextMenuShield.addEventListener("contextmenu", function (event) {
      event.preventDefault();
      this.style.display = "none";
    });
  }

  var msgs = document.querySelectorAll(".msg");
  msgs.forEach((msg) => {
    if (role == "admin" || msg.getAttribute("senderid") == currentId) {
      msg.addEventListener("contextmenu", function (event) {
        event.preventDefault();

        document.addEventListener("click", function () {
          msgContextMenuShield.style.display = "none";
        });

        if (msgContextMenuShield) {
          msgContextMenuShield.style.display = "flex";
          var mouseX = event.clientX;
          var mouseY = event.clientY;
          var msgContextMenu = document.querySelector(".msg-context-menu-div");
          if (msgContextMenu) {
            msgContextMenu.style.left = `${mouseX}px`;
            msgContextMenu.style.top = `${mouseY}px`;
          }

          var deleteMsgBtn = document.getElementById("del-msg");
          var modifyMsgBtn = document.getElementById("modify-msg");
          var modifyMessageShield =
            document.querySelector(".modify-msg-shield");

          // Delete message action
          deleteMsgBtn.addEventListener("click", function () {
            var messageId = msg.getAttribute("messageId");
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
              if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                  fetchMessages();
                } else {
                  console.log(response); // Log error message
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

          // Modify message action
          modifyMsgBtn.addEventListener("click", function () {
            var modifyContent =
              modifyMessageShield.querySelector(".modify-content");
            modifyContent.textContent =
              msg.querySelector(".messageContent").textContent;
            modifyMessageShield.style.display = "flex";
          });

          // Close modify message dialog
          modifyMessageShield.addEventListener("click", function (event) {
            if (!event.target.closest(".modify-msg-div")) {
              modifyMessageShield.style.display = "none";
            }
          });

          var cancelModify = document.getElementById("modify-del");
          cancelModify.addEventListener("click", function () {
            modifyMessageShield.style.display = "none";
          });

          const saveModify = document.getElementById("modify-save");
          saveModify.addEventListener("click", function () {
            var messageId = msg.getAttribute("messageId");
            saveModifiedMessage(messageId);
          });
        }
      });
    }
  });
}

$(document).ready(function () {
  fetchMessages1();
  setInterval(fetchMessages, 3000);
  //   setInterval(autoScroll, 3000);
});

$("#chat-form").submit(function (e) {
  e.preventDefault();
  var message = $("#sendMsg").val();

  $.ajax({
    url: "submit_message.php",
    type: "POST",
    data: { chanelId: chanelId, message: message },
    success: function () {
      $("#sendMsg").val("");
      fetchMessages();
      scrollToBottom();
    },
  });
});

function scrollToBottom() {
  var chatBox = $("html, body");
  chatBox.scrollTop(chatBox.prop("scrollHeight"));
}

function isScrollAtBottom() {
  $(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
      return true;
    } else {
      return false;
    }
  });
}

// function autoScroll() {
//   if (isScrollAtBottom()) {
//     scrollToBottom();
//     console.log("scrolled");
//   }
// }

function saveModifiedMessage(messageId) {
  const modifyMessageShield = document.querySelector(".modify-msg-shield");
  const modifyContent =
    modifyMessageShield.querySelector(".modify-content").value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      if (response.success) {
        modifyMessageShield.style.display = "none";
        fetchMessages();
      } else {
        console.log(response);
      }
    }
  };
  xhttp.open("POST", "./jsToPhp/message-action.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params =
    "modId=" +
    encodeURIComponent(messageId) +
    "&newMsg=" +
    encodeURIComponent(modifyContent);
  xhttp.send(params);
}
