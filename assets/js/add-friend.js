const input = document.getElementById("send-input");
const search = document.getElementById("send-btn");

input.addEventListener("input", function () {
  if (input.value !== "") {
    search.style.backgroundColor = "darkcyan";
    search.removeAttribute("disabled");
    search.style.cursor = "pointer";
  } else {
    search.style.backgroundColor = "gray";
    search.setAttribute("disabled", "disabled");
    search.style.cursor = "not-allowed";
  }
});

//add results to search div
function searchUsers() {
  var inputValue = input.value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const results = document.querySelector(".results");
      results.innerHTML = "";
      var response = JSON.parse(this.responseText);
      if (response.length > 0) {
        response.forEach((element) => {
          let resultDiv = document.createElement("div");
          resultDiv.className = "result";

          let fstDiv = document.createElement("div");
          fstDiv.className = "fst";

          let figure = document.createElement("figure");
          let img = document.createElement("img");
          img.src = "../assets/images/userImage/" + element.image;
          img.alt = "user image";
          figure.appendChild(img);

          let namesDiv = document.createElement("div");
          namesDiv.className = "names";
          let usernameP = document.createElement("p");
          usernameP.textContent = "@" + element.username;
          let displaynameP = document.createElement("p");
          displaynameP.textContent = element.displayname;
          namesDiv.appendChild(usernameP);
          namesDiv.appendChild(displaynameP);

          fstDiv.appendChild(figure);
          fstDiv.appendChild(namesDiv);

          let sndDiv = document.createElement("div");
          sndDiv.className = "snd snd-add";
          sndDiv.setAttribute("userId", element.id);
          let sndP = document.createElement("img");
          sndP.src = "../assets/icons/add-user.png";
          sndDiv.appendChild(sndP);

          resultDiv.appendChild(fstDiv);
          resultDiv.appendChild(sndDiv);

          results.appendChild(resultDiv);

          //send friend request
          let addBtns = document.querySelectorAll(".snd-add");
          addBtns.forEach((btn) => {
            btn.addEventListener("click", function () {
              let userId = btn.getAttribute("userid");
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                  var response = JSON.parse(this.responseText);
                  if (response.success) {
                    btn.querySelector("img").style.transform =
                      "rotate(-360deg)";
                    btn.querySelector("img").src = "../assets/icons/ok.png";

                    // Create the new sent user element
                    var user = response.user;
                    var sentDiv = document.querySelector(".p2");
                    var newSent = document.createElement("div");
                    newSent.className = "sent";

                    newSent.innerHTML = `<div class="fst">
                <figure><img src="../assets/images/userImage/${user.image}" alt="user image"></figure>
                <div class="names">
                    <p>@${user.username}</p>
                    <p>${user.displayname}</p>
                </div>
            </div>
            <div class="snd" userId="${user.id}">
                <p>x</p>
            </div>`;

                    sentDiv.appendChild(newSent);
                  } else {
                    console.error(response);
                  }
                }
              };
              xhttp.open("POST", "./jsToPhp/add-friend.php", true);
              xhttp.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
              );
              var params = "sendRequest=" + encodeURIComponent(userId);
              xhttp.send(params);
            });
          });
        });
      } else {
        let resultDiv = document.createElement("div");
        resultDiv.className = "no-data";
        let img = document.createElement("img");
        img.src = "../assets/icons/no-data.png";
        resultDiv.appendChild(img);
        let msg = document.createElement("p");
        msg.textContent = "Theres no results...";
        resultDiv.appendChild(msg);
        results.appendChild(resultDiv);
        getCancelBtns();
      }
    }
  };
  xhttp.open("POST", "./jsToPhp/add-friend.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params = "inputValue=" + encodeURIComponent(inputValue);
  xhttp.send(params);
}

//cancel friend request
getCancelBtns();
function getCancelBtns() {
  var cancelBtns = document.querySelectorAll(".snd");
  cancelBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      var cancelId = this.getAttribute("userId");
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          response = JSON.parse(this.response);
          if (response.success) {
            btn.parentElement.remove();
          } else {
            console.error(response);
          }
        }
      };
      xhttp.open("POST", "./jsToPhp/cancelFriendRequest.php", true);
      xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      var params = "userId=" + encodeURIComponent(cancelId);
      xhttp.send(params);
    });
  });
}
