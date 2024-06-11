//display chanel adder (manage chanels)
var addChanelUtility = document.getElementById("postChanelUtility");
var addChanelBtns = document.querySelectorAll(".add-new-chanel");
addChanelBtns.forEach(function (btn) {
  btn.addEventListener("click", function () {
    shield.style.display = "flex";
    groupId.value = btn.getAttribute("groupId");
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
var type = 0;
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

//post chanel (manage chanels)
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
