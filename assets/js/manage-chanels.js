const shield = document.querySelector(".postChanelUtility-shield");
const addChanelUtility = document.getElementById("postChanelUtility");
const addChanelBtns = document.querySelectorAll(".add-new-chanel");

function displayChanelInputError(message) {
  document.getElementById("newName").style.outline = "1px solid crimson";
  document.getElementById("newName").value = message;
}

function clearChanelInputError() {
  document.getElementById("newName").style.outline = "none";
}

addChanelBtns.forEach(function (btn) {
  btn.addEventListener("click", function () {
    shield.style.display = "flex";
    groupId.value = btn.getAttribute("groupId");

    document
      .getElementById("CancelcreateChanelInGroup")
      .addEventListener("click", function () {
        shield.style.display = "none";
        clearChanelInputError();
      });

    shield.addEventListener("click", function (event) {
      if (!event.target.closest("#postChanelUtility")) {
        shield.style.display = "none";
        clearChanelInputError();
      }
    });
  });
});

// select type
const selectType = document.getElementById("chanelTypeToPost");
const typeHider = document.getElementById("typeHider");
const emoji = document.getElementById("typeEmoji");
let type = 0;

selectType.addEventListener("click", function () {
  if (type == 0) {
    typeHider.style.transform = "translateX(-80px)";
    emoji.innerHTML =
      '<img class="chanel-type-icon" src="../../assets/icons/voice-chanel.svg" alt="">';
    emoji.style.transform = "rotate(-360deg)";
    type = 1;
  } else if (type == 1) {
    typeHider.style.transform = "translateX(80px)";
    emoji.innerHTML =
      '<img class="chanel-type-icon" src="../../assets/icons/text-chanel.svg" alt="">';
    emoji.style.transform = "rotate(0)";
    type = 0;
  }
});

// post chanel (manage chanels)
const postChanel = document.getElementById("createChanelInGroup");
postChanel.addEventListener("click", function () {
  const chanelName = document.getElementById("newName").value.trim();
  const chanelDescription = document.getElementById(
    "chanelDescriptionToPost"
  ).value;

  if (chanelName !== "") {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        window.location.reload();
        shield.style.display = "none";
        clearChanelInputError();
      }
    };
    xhttp.open("POST", "./jsToPhp/postChanel.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    const params =
      "name=" +
      encodeURIComponent(chanelName) +
      "&description=" +
      encodeURIComponent(chanelDescription) +
      "&type=" +
      encodeURIComponent(type) +
      "&groupId=" +
      encodeURIComponent(groupId.value);
    xhttp.send(params);
  } else {
    displayChanelInputError("Chanel name can't be empty");
  }
});

// deleteChanel
const chanels = document.querySelectorAll(".chanel");
chanels.forEach((chanel) => {
  chanel.querySelector(".delete").addEventListener("click", function () {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const response = JSON.parse(this.response);
        if (response.success) {
          chanel.remove();
        } else {
          console.error(response);
        }
      }
    };
    xhttp.open("POST", "./jsToPhp/deleteChanel.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    const params =
      "chanelId=" + encodeURIComponent(chanel.getAttribute("chanelId"));
    xhttp.send(params);
  });
});

// modify chanel name
const modifyShield = document.querySelector(".modify-chanel-shield");
const editChanelBtns = document.querySelectorAll(".chanel-modify");
let currentChanelBtn = null;

editChanelBtns.forEach((btn) => {
  btn.addEventListener("click", function () {
    currentChanelBtn = btn;
    const chanelName =
      btn.parentElement.parentElement.parentElement.getAttribute("chanelName");
    document.getElementById("newName").value = chanelName;
    modifyShield.style.display = "flex";
    clearChanelInputError();
  });
});

// confirm modify
const confirmModifyBtn = document.getElementById("confirmModify");
confirmModifyBtn.addEventListener("click", function () {
  if (currentChanelBtn) {
    const chanelModifyId =
      currentChanelBtn.parentElement.parentElement.parentElement.getAttribute(
        "chanelid"
      );
    const newName = document.getElementById("newName").value.trim();
    if (newName !== "") {
      const xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const response = JSON.parse(this.response);
          if (response.success) {
            modifyShield.style.display = "none";
            currentChanelBtn.parentElement.parentElement.parentElement.parentElement.querySelector(
              "p"
            ).innerHTML = "# " + newName;
          } else {
            console.error(this.response);
          }
        }
      };
      xhttp.open("POST", "./jsToPhp/modifyChanel.php", true);
      xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      const params =
        "chanelId=" +
        encodeURIComponent(chanelModifyId) +
        "&chanelNewName=" +
        encodeURIComponent(newName);
      xhttp.send(params);
    } else {
      displayChanelInputError("Chanel name can't be empty");
    }
  }
});

modifyShield.addEventListener("click", function (event) {
  if (!event.target.closest(".modify-chanel")) {
    modifyShield.style.display = "none";
    clearChanelInputError();
  }
});
