var msgsBtns = document.querySelectorAll(".msg");
msgsBtns.forEach((btn) => {
  btn.addEventListener("click", function () {
    var userId = btn.getAttribute("userId");
    getPrivateChanelId(userId, function (chanelId) {
      console.log(chanelId);
      window.location.href = `./private-text-chanel.php?chanelId=${chanelId}&userId=${userId}`;
    });
  });
});

function getPrivateChanelId(friendId, callback) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      if (response.success) {
        chanId = response.chanelId["id"];
        callback(chanId);
      } else {
        console.error(response);
        callback(null);
      }
    }
  };
  xhttp.open("POST", "./jsToPhp/getPrivateChanelId.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params = "friendId=" + encodeURIComponent(friendId);
  xhttp.send(params);
}

const deleteFriendBtns = document.querySelectorAll(".delete");
deleteFriendBtns.forEach((element) => {
  element.addEventListener("click", function () {
    var userId = element.getAttribute("userId");
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        window.top.location.reload();
        shield.style.display = "none";
        clearChanelInputError();
      }
    };
    xhttp.open("POST", "./jsToPhp/delete-friendship.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    const params = "userId=" + encodeURIComponent(userId);
    xhttp.send(params);
  });
});
