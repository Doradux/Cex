image1 = document.querySelector(".change-hover");
image2 = document.getElementById("image-input");

[image1, image2].forEach((element) => {
  element.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("photo").src = e.target.result;
        document.getElementsByClassName("save-photo")[0].style.display =
          "block";
      };
      reader.readAsDataURL(file);
      document
        .getElementsByClassName("save-photo")[0]
        .addEventListener("click", function () {
          const fileInput = element;
          const file = fileInput.files[0];
          if (file) {
            const formData = new FormData();
            formData.append("file", file);

            fetch("jsToPhp/postServerImage.php", {
              method: "POST",
              body: formData,
            })
              .then((response) => response.json())
              .then((data) => {
                if (data.success) {
                  // alert("File uploaded successfully!");
                  document.querySelector(".save-photo").style.display = "none";
                } else {
                  alert("File upload failed: " + data.error);
                }
              })
              .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while uploading the file.");
              });
          } else {
            alert("No file selected!");
          }
        });
    }
  });
});

grandimage1 = document.querySelector(".change-hover-grand");
grandimage2 = document.getElementById("grandimage-input");

[grandimage1, grandimage2].forEach((element) => {
  element.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("grandimage").src = e.target.result;
        document.getElementsByClassName("save-grandimage")[0].style.display =
          "block";
      };
      reader.readAsDataURL(file);

      document
        .getElementsByClassName("save-grandimage")[0]
        .addEventListener("click", function () {
          const fileInput = element;
          const file = fileInput.files[0];
          if (file) {
            const formData = new FormData();
            formData.append("file", file);

            fetch("jsToPhp/postServerGrandimage.php", {
              method: "POST",
              body: formData,
            })
              .then((response) => response.json())
              .then((data) => {
                if (data.success) {
                  // alert("File uploaded successfully!");
                  document.querySelector(".save-grandimage").style.display =
                    "none";
                } else {
                  alert("File upload failed: " + data.error);
                }
              })
              .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while uploading the file.");
              });
          } else {
            alert("No file selected!");
          }
        });
    }
  });
});

const nameInput = document.getElementById("server-name");
const editName = document.getElementById("name-btn");
var saveNameStatus = 0;

editName.addEventListener("click", function () {
  if (saveNameStatus == 0) {
    editName.textContent = "SAVE";
    editName.style.backgroundColor = "green";
    nameInput.removeAttribute("disabled");
    nameInput.focus();
    saveNameStatus = 1;
  } else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if (response.success) {
          editName.textContent = "EDIT";
          editName.style.backgroundColor = "rgb(0, 140, 255)";
          nameInput.setAttribute("disabled", "disabled");
          saveNameStatus = 0;
        } else {
          console.log(response.error);
          console.log(response);
        }
      }
    };

    xhttp.open("POST", "./jsToPhp/modify-server.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var params = "newServerName=" + encodeURIComponent(nameInput.value);
    xhttp.send(params);
  }
});

//change welcome chanel
const welcomeShield = document.querySelector(".welcome-chanel-shield");
const editWelcomeBtn = document.getElementById("change-welcome");
const currentWelcome = document.getElementById("current-welcome");
editWelcomeBtn.addEventListener("click", function () {
  welcomeShield.style.display = "flex";
});

welcomeShield.addEventListener("click", function () {
  if (!event.target.closest(".welcome-chanel-div")) {
    welcomeShield.style.display = "none";
  }
});

var welcomeListElements = document.querySelectorAll(".chanel-list-element");
welcomeListElements.forEach((element) => {
  element.addEventListener("click", function () {
    var chanelId = element.getAttribute("chanelId");
    var chanelName = element.querySelector(".chanel-name").textContent;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if (response.success) {
          currentWelcome.value = chanelName;
          welcomeShield.style.display = "none";
        } else {
          console.log(response.error);
          console.log(response);
        }
      }
    };

    xhttp.open("POST", "./jsToPhp/modify-server.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var params =
      "chanelId=" +
      encodeURIComponent(chanelId) +
      "&chanelName=" +
      encodeURIComponent(chanelName);
    xhttp.send(params);
  });
});

//get privacity
const privDiv = document.getElementById("privacity");
const privSelect = document.getElementById("type-privacity");
const privIcon = document.querySelector(".server-privacity-icon");
if (privacity == "public") {
  privSelect.style.backgroundColor = "darkcyan";
  privSelect.style.transform = "translateX(-120px)";
  privIcon.src = "../../assets/icons/visible.png";
  privIcon.style.transform = "rotate(-360deg)";
}

//change
privDiv.addEventListener("click", function () {
  if (privacity == "public") {
    privacity = "private";
    privSelect.style.backgroundColor = "crimson";
    privSelect.style.transform = "translateX(0)";
    privIcon.src = "../../assets/icons/no-visible.png";
    privIcon.style.transform = "rotate(360deg)";

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
    xhttp.open("POST", "./jsToPhp/modify-server.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var params = "serverPriv=private";
    xhttp.send(params);
  } else {
    privacity = "public";
    privSelect.style.backgroundColor = "darkcyan";
    privSelect.style.transform = "translateX(-120px)";
    privIcon.src = "../../assets/icons/visible.png";
    privIcon.style.transform = "rotate(-360deg)";

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
    xhttp.open("POST", "./jsToPhp/modify-server.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var params = "serverPriv=public";
    xhttp.send(params);
  }
});
