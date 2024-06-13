//accept user
const acceptBtns = document.querySelectorAll(".accept");
acceptBtns.forEach((btn) => {
  btn.addEventListener("click", function () {
    var userId = btn.getAttribute("userId");
    console.log(userId);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if (response.success) {
            window.location.reload();
        } else {
          console.error(response);
        }
      }
    };
    xhttp.open("POST", "./jsToPhp/add-friend.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params = "addId=" + encodeURIComponent(userId);
    xhttp.send(params);
  });
});
