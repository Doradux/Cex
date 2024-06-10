var editNicks = document.querySelectorAll(".member-server-nick");
const modifyP = document.getElementById("modify-p");
const nickInput = document.getElementById("nick-input");
const changeNickShield = document.querySelector(".modify-nickname-shield");
const idInput = document.getElementById("id-input");

editNicks.forEach((editNick) => {
  editNick.addEventListener("click", function () {
    changeNickShield.style.display = "flex";
    var memberId = editNick.getAttribute("memberId");
    var memberUsername = editNick.getAttribute("memberUsername");
    var memberNick = editNick.getAttribute("memberNick");
    modifyP.innerHTML =
      "Modify <span class='gold'>@" + memberUsername + "</span> nickname";
    nickInput.value = memberNick;
    idInput.value = memberId;
  });
});

changeNickShield.addEventListener("click", function () {
  if (!event.target.closest(".modify-nickname")) {
    changeNickShield.style.display = "none";
  }
});

const cancelModifyNick = document.querySelector(".cancel-btn");
cancelModifyNick.addEventListener("click", function () {
  changeNickShield.style.display = "none";
});

//modify server user nick
const saveModifyNick = document.querySelector(".save-btn");
saveModifyNick.addEventListener("click", function () {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      if (response.success) {
        changeNickShield.style.display = "none";
      } else {
        console.log(response.error);
        console.log(response);
      }
    }
  };

  xhttp.open("POST", "./jsToPhp/server-user-action.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var params =
    "nick=" +
    encodeURIComponent(nickInput.value) +
    "&id=" +
    encodeURIComponent(idInput.value);
  xhttp.send(params);
});

//change user role
var changeRoleBtns = document.querySelectorAll(".change-user-role");
changeRoleBtns.forEach((btn) => {
  btn.addEventListener("click", function () {
    var rId = btn.getAttribute("memberId");
    var rRole = btn.getAttribute("currentRole");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if (response.success) {
          //get name p
          var rName =
            btn.parentElement.parentElement.parentElement.querySelector(
              ".member-name-displayed"
            );

          if (rRole == "user") {
            btn.style.backgroundColor = "rgba(0, 180, 217, 1)";
            btn.setAttribute("currentRole", "admin");
            rName.style.color = "rgba(0, 180, 217, 1)";
          } else {
            btn.style.backgroundColor = "rgb(119, 119, 119)";
            btn.setAttribute("currentRole", "user");
            rName.style.color = "white";
          }
        } else {
          console.log(response.error);
          console.log(response);
        }
      }
    };

    xhttp.open("POST", "./jsToPhp/server-user-action.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var params =
      "rId=" +
      encodeURIComponent(rId) +
      "&currentRole=" +
      encodeURIComponent(rRole);
    xhttp.send(params);
  });
});
