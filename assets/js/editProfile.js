var show = document.getElementById("show");
var emailHider = document.getElementById("cover");
emailHider.style.display = "block";
window.addEventListener("load", function () {
  show.addEventListener("click", function () {
    if (emailHider.style.display == "block") {
      emailHider.style.display = "none";
      show.textContent = "HIDE";
    } else {
      emailHider.style.display = "block";
      show.textContent = "REVEAL";
    }
  });
});

const input = document.querySelector(".change-hover");

input.addEventListener("change", function (event) {
  console.log("hola");
  var file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById("user-image").src = e.target.result;
      document.getElementById("save-user-photo").style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});

document
  .getElementById("save-user-photo")
  .addEventListener("click", function () {
    const fileInput = document.querySelector(".change-hover");
    const file = fileInput.files[0];
    if (file) {
      const formData = new FormData();
      formData.append("file", file);

      fetch("jsToPhp/postUserImage.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // alert("File uploaded successfully!");
            document.querySelector("#save-user-photo").style.display = "none";
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

var editUsername = document.getElementById("edit-username");
var editDisplayName = document.getElementById("edit-displayname");
var editBirth = document.getElementById("edit-birth");

var usernameInput = document.getElementById("username-input");
var displaynameInput = document.getElementById("displayname-input");
var birthInput = document.getElementById("birth-input");

var saveBtns = document.querySelectorAll(".save-btn");

//username
editUsername.addEventListener("click", function () {
  usernameInput.setAttribute("class", "editable");
  usernameInput.removeAttribute("disabled");
  editUsername.style.display = "none";
  saveBtns[0].style.display = "block";
});

saveBtns[0].addEventListener("click", function () {
  var changeTo = usernameInput.value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      editUsername.style.display = "block";
      saveBtns[0].style.display = "none";
      usernameInput.setAttribute("disabled", "disabled");
      usernameInput.setAttribute("class", "no-editable");
    }
  };
  xhttp.open("POST", "./jsToPhp/editProfile.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params = "username=" + encodeURIComponent(changeTo);
  xhttp.send(params);
});

//displayname
editDisplayName.addEventListener("click", function () {
  displaynameInput.setAttribute("class", "editable");
  displaynameInput.removeAttribute("disabled");
  editDisplayName.style.display = "none";
  saveBtns[1].style.display = "block";
});

saveBtns[1].addEventListener("click", function () {
  var changeTo = displaynameInput.value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      editDisplayName.style.display = "block";
      saveBtns[1].style.display = "none";
      displaynameInput.setAttribute("disabled", "disabled");
      displaynameInput.setAttribute("class", "no-editable");
    }
  };
  xhttp.open("POST", "./jsToPhp/editProfile.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params = "displayname=" + encodeURIComponent(changeTo);
  xhttp.send(params);
});

//birth
editBirth.addEventListener("click", function () {
  birthInput.setAttribute("class", "editable");
  birthInput.removeAttribute("disabled");
  editBirth.style.display = "none";
  saveBtns[2].style.display = "block";
});

saveBtns[2].addEventListener("click", function () {
  var changeTo = birthInput.value;
  var parts = changeTo.split("/");
  var day = parts[0];
  var month = parts[1];
  var year = parts[2];
  changeTo = `${year}-${month}-${day}`;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      editBirth.style.display = "block";
      saveBtns[2].style.display = "none";
      birthInput.setAttribute("disabled", "disabled");
      birthInput.setAttribute("class", "no-editable");
    }
  };
  xhttp.open("POST", "./jsToPhp/editProfile.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params = "birth=" + encodeURIComponent(changeTo);
  xhttp.send(params);
});

//password
const passwordDiv = document.querySelector(".password-shield");
const passCancel = document.getElementById("cancel-password");
const showPasswordDiv = document.getElementById("showCancelDiv");
const savePassword = document.getElementById("save-password");

showPasswordDiv.addEventListener("click", function () {
  passwordDiv.style.display = "flex";
});

var cancelChange = [passCancel, passwordDiv];

cancelChange.forEach(function (listener) {
  listener.addEventListener("click", function (event) {
    // Verificar si el clic proviene de passCancel o de fuera del div change-password
    if (listener === passCancel || !event.target.closest(".change-password")) {
      passwordDiv.style.display = "none";
      // Limpiar todos los campos de contraseña
      var passwordInputs = document.querySelectorAll('input[type="password"]');
      passwordInputs.forEach(function (input) {
        input.value = "";
      });
    }
  });
});

savePassword.addEventListener("click", function () {
  var xhttp = new XMLHttpRequest();
  const currentPassword = document.getElementById("old-password").value;
  const newPassword = document.getElementById("new-password").value;
  const confirmPassword = document.getElementById("confirm-password").value;
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      if (response.success) {
        passwordDiv.style.display = "none";
        var passwordInputs = document.querySelectorAll(
          'input[type="password"]'
        );
        passwordInputs.forEach(function (input) {
          input.value = "";
        });
      } else {
        console.error(response.error);
      }
    }
  };
  xhttp.open("POST", "./jsToPhp/changePassword.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params =
    "old=" +
    encodeURIComponent(currentPassword) +
    "&new=" +
    encodeURIComponent(newPassword) +
    "&confirm=" +
    encodeURIComponent(confirmPassword);
  xhttp.send(params);
});

//sign out
const signoutBtn = document.getElementById("sign-out");
signoutBtn.addEventListener("click", function () {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log("sign out");
      window.top.location.href = "http://localhost";
    }
  };

  xhttp.open("POST", "./jsToPhp/signOut.php", true);
  xhttp.send();
});
