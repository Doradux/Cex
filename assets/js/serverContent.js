const groups = document.getElementById("groups");
const chanelsOptions = document.querySelector(".chanelsOptions");

//tooltip
document.addEventListener("DOMContentLoaded", function () {
  const addChanel = document.querySelectorAll("a");

  addChanel.forEach((link) => {
    if (link.textContent.trim() === "+") {
      link.addEventListener("mouseover", function () {
        const tooltip = document.getElementById("tooltip");
        tooltip.textContent = "Create new chanel";
        tooltip.style.display = "block";

        const linkRect = link.getBoundingClientRect();
        tooltip.style.left = linkRect.left + -65 + "px";
        tooltip.style.top = linkRect.top - tooltip.offsetHeight + "px";
      });

      link.addEventListener("mouseout", function () {
        const tooltip = document.getElementById("tooltip");
        tooltip.style.display = "none";
      });
    }
  });
});

const arrow = document.getElementById("arrow");
const serverOptions = document.querySelector(".serverOptions");

//open groups/chanels menu
arrow.addEventListener("click", function (event) {
  if (event.target.matches("#arrow")) {
    event.preventDefault();
    serverOptions.style.display = "flex";
    const arrowpos = arrow.getBoundingClientRect();
    serverOptions.style.left = arrowpos.left + -220 + "px";
    serverOptions.style.top = arrowpos.top - tooltip.offsetHeight + +25 + "px";
    requestAnimationFrame(() => {
      serverOptions.style.clipPath = "polygon(0 0, 100% 0, 100% 100%, 0 100%)";
    });
  }
});

//get chanels content
var chanelsLinks = document.querySelectorAll(".chanelLink");

chanelsLinks.forEach(function (link) {
  link.addEventListener("click", function (event) {
    chanelsLinks.forEach((chanel) => {
      chanel.style.backgroundColor = "transparent";
    });
    event.preventDefault();
    link.style.backgroundColor = "darkcyan";
    var chanelId = link.getAttribute("href");

    document
      .getElementById("chanelContent")
      .setAttribute(
        "src",
        "../controller/text_chanel.php?chanelId=" + chanelId
      );
  });
});

//scroll down when open chat
var iframe = document.getElementById("chanelContent");
document.getElementById("chanelContent").onload = function () {
  iframe.contentWindow.scrollTo(0, iframe.contentDocument.body.scrollHeight);
};

//go to server settings
try {
  var serverSettingsLink = document.getElementById("server-settings");
  serverSettingsLink.addEventListener("click", function () {
    event.preventDefault();
    window.location.href = "../controller/serverSettings.php";
  });
} catch {}

//leave server
var leaveServer = document.getElementById("leaveServer");
var confirmLeaveServerShield = document.querySelector(
  ".confirmLeaveServer-shield"
);
var confirmLeaveServer = document.querySelector(".confirmLeaveServer");
leaveServer.addEventListener("click", function () {
  event.preventDefault();
  confirmLeaveServerShield.style.display = "flex";
});

var confirmLeaveServerBtn = document.querySelector(".btn-confirm");
var cancelLeaveServerBtn = document.querySelector(".btn-cancel");
cancelLeaveServerBtn.addEventListener("click", function () {
  confirmLeaveServerShield.style.display = "none";
});

confirmLeaveServerShield.addEventListener("click", function () {
  if (!event.target.closest(".confirmLeaveServer")) {
    confirmLeaveServerShield.style.display = "none";
  }
});

confirmLeaveServerBtn.addEventListener("click", function () {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.top.top.location.reload();
    }
  };
  xhttp.open("POST", "./jsToPhp/leaveServer.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
});

var groupId = document.getElementById("groupId");
const shield = document.querySelector(".postChanelUtility-shield");
//display chanel adder (server view)
var addChanelUtility = document.getElementById("postChanelUtility");
var chanelIdToPost = document.getElementById("chanelGroupIdToPost");
var addChanelPerGroupPluses = document.querySelectorAll(".addServerInGroup");
addChanelPerGroupPluses.forEach(function (plus) {
  plus.addEventListener("click", function () {
    event.preventDefault();
    groupId.value = plus.getAttribute("href");
    shield.style.display = "flex";
    chanelIdToPost.value = this.href;
    document
      .getElementById("CancelcreateChanelInGroup")
      .addEventListener("click", function () {
        shield.style.display = "none";
      });
    shield.addEventListener("click", function (event) {
      if (!event.target.closest("#postChanelUtility")) {
        shield.style.display = "none";
      }
    });
  });
});

//select type
var selectType = document.getElementById("chanelTypeToPost");
var typeHider = document.getElementById("typeHider");
var emoji = document.getElementById("typeEmoji");
typeHider.style.transform = "translateX(10px)";
var type = 0;
selectType.addEventListener("click", function () {
  if (type == 0) {
    typeHider.style.transform = "translateX(-150px)";
    emoji.innerHTML =
      '<img class="chanel-type-icon" src="../../assets/icons/voice-chanel.svg" alt="">';
    emoji.style.transform = "rotate(-360deg)";
    type = 1;
  } else if (type == 1) {
    typeHider.style.transform = "translateX(10px)";
    emoji.innerHTML =
      '<img class="chanel-type-icon" src="../../assets/icons/text-chanel.svg" alt="">';
    emoji.style.transform = "rotate(0)";
    type = 0;
  }
});

//post chanel
var postChanel = document.getElementById("createChanelInGroup");
postChanel.addEventListener("click", function () {
  var chanelName = document.getElementById("chanelNameToPost").value;
  var chanelDescription = document.getElementById(
    "chanelDescriptionToPost"
  ).value;
  // alert('chanelName:' + chanelName + '; chanelDescription: ' + chanelDescription + '; type: ' + type + '; groupId: ' + groupId.value)

  //php request
  if (chanelName != "") {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        shield.style.display = "none";
      }
    };
    xhttp.open("POST", "./jsToPhp/postChanel.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params =
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
    alert("Chanel name can't be: null");
  }
});

//show members page
const showMembersOption = document.getElementById("show-members-page");
showMembersOption.addEventListener("click", function () {
  event.preventDefault();
  iframe.src = "../controller/members-page.php";
});

document.addEventListener("click", function () {
  if (!event.target.closest("#arrow")) {
    document.querySelector(".serverOptions").style.display = "none";
  }
});

const contextMenu = document.querySelector(".contextMenu");
const contextMenuDisplayer = document.querySelector(".showMenu");

var contextMenuLeft = window
  .getComputedStyle(contextMenu)
  .getPropertyValue("left");

if (contextMenuLeft == "-300px") {
  contextMenuDisplayer.style.display = "block";
} else {
  contextMenuDisplayer.style.display = "none";
}

window.addEventListener("resize", function () {
  var contextMenuLeft = window
    .getComputedStyle(contextMenu)
    .getPropertyValue("left");

  if (contextMenuLeft == "-300px") {
    contextMenuDisplayer.style.display = "block";
  } else {
    contextMenuDisplayer.style.display = "none";
  }
});

contextMenuDisplayer.addEventListener("click", function () {
  contextMenu.style.left = "0";
  contextMenuDisplayer.style.display = "none";
});
