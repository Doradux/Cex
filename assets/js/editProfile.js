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

// Username
editUsername.addEventListener("click", function () {
  usernameInput.setAttribute("class", "editable");
  usernameInput.removeAttribute("disabled");
  editUsername.style.display = "none";
  saveBtns[0].style.display = "block";
});

saveBtns[0].addEventListener("click", function () {
  var changeTo = usernameInput.value.trim();
  if (changeTo !== "") {
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
  } else {
    usernameInput.style.outline = "1px solid crimson";
    usernameInput.value = "Invalid username";
    usernameInput.style.color = "crimson";
  }
});

usernameInput.addEventListener("input", function () {
  usernameInput.style.outline = "none";
  usernameInput.style.color = "white";
});

// Displayname
editDisplayName.addEventListener("click", function () {
  displaynameInput.setAttribute("class", "editable");
  displaynameInput.removeAttribute("disabled");
  editDisplayName.style.display = "none";
  saveBtns[1].style.display = "block";
});

saveBtns[1].addEventListener("click", function () {
  var changeTo = displaynameInput.value.trim();
  if (changeTo !== "") {
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
  } else {
    displaynameInput.style.outline = "1px solid crimson";
    displaynameInput.value = "Invalid displayname";
    displaynameInput.style.color = "crimson";
  }
});

displaynameInput.addEventListener("input", function () {
  displaynameInput.style.outline = "none";
  displaynameInput.style.color = "white";
});

// Birth
editBirth.addEventListener("click", function () {
  birthInput.setAttribute("class", "editable");
  birthInput.removeAttribute("disabled");
  editBirth.style.display = "none";
  saveBtns[2].style.display = "block";
});

saveBtns[2].addEventListener("click", function () {
  var changeTo = birthInput.value.trim();
  if (changeTo !== "") {
    var parts = changeTo.split("/");
    if (
      parts.length === 3 &&
      parts[0].length === 2 &&
      parts[1].length === 2 &&
      parts[2].length === 4
    ) {
      changeTo = `${parts[2]}-${parts[1]}-${parts[0]}`;
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
      xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      var params = "birth=" + encodeURIComponent(changeTo);
      xhttp.send(params);
    } else {
      birthInput.style.outline = "1px solid crimson";
      birthInput.value = "Invalid date format";
      birthInput.style.color = "crimson";
    }
  } else {
    birthInput.style.outline = "1px solid crimson";
    birthInput.value = "Invalid date";
    birthInput.style.color = "crimson";
  }
});

birthInput.addEventListener("input", function () {
  birthInput.style.outline = "none";
  birthInput.style.color = "white";
});

// Password
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
    if (listener === passCancel || !event.target.closest(".change-password")) {
      passwordDiv.style.display = "none";
      var passwordInputs = document.querySelectorAll('input[type="password"]');
      passwordInputs.forEach(function (input) {
        input.value = "";
      });
    }
  });
});

savePassword.addEventListener("click", function () {
  var xhttp = new XMLHttpRequest();
  const currentPassword = document.getElementById("old-password").value.trim();
  const newPassword = document.getElementById("new-password").value.trim();
  const confirmPassword = document
    .getElementById("confirm-password")
    .value.trim();
  const passwordErrorDiv = document.querySelector(".password-error");

  const validCharacters = /^[a-zA-Z0-9]+$/;
  if (
    newPassword.length < 6 ||
    newPassword !== confirmPassword ||
    !validCharacters.test(newPassword)
  ) {
    passwordErrorDiv.textContent =
      "Invalid password. Make sure it is at least 6 characters long, contains only alphanumeric characters, and both new passwords match.";
    document.getElementById("old-password").style.outline = "1px solid crimson";
    document.getElementById("new-password").style.outline = "1px solid crimson";
    document.getElementById("confirm-password").style.outline =
      "1px solid crimson";
    return;
  }

  passwordErrorDiv.textContent = "";
  document.getElementById("old-password").style.outline = "none";
  document.getElementById("new-password").style.outline = "none";
  document.getElementById("confirm-password").style.outline = "none";

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
        alert("Failed to change password.");
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

document
  .getElementById("old-password")
  .addEventListener("input", clearPasswordError);
document
  .getElementById("new-password")
  .addEventListener("input", clearPasswordError);
document
  .getElementById("confirm-password")
  .addEventListener("input", clearPasswordError);

function clearPasswordError() {
  document.querySelector(".password-error").textContent = "";
  document.getElementById("old-password").style.outline = "none";
  document.getElementById("new-password").style.outline = "none";
  document.getElementById("confirm-password").style.outline = "none";
}

// Sign out
const signoutBtn = document.getElementById("sign-out");
signoutBtn.addEventListener("click", function () {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.top.location.href = "http://localhost";
    }
  };
  xhttp.open("POST", "./jsToPhp/signOut.php", true);
  xhttp.send();
});

// Delete account
const showDeleteAccount = document.getElementById("delete-account-show");
const deleteShield = document.querySelector(".delete-account-shield");
const deleteDiv = document.querySelector(".delete-account");
const deleteInput = document.getElementById("confirm-delete");
const confirmDeleteBtn = document.querySelector(".confirm-delete-btn");
const cancelDeleteAcc = document.getElementById("delete-cancel");

showDeleteAccount.addEventListener("click", function () {
  deleteShield.style.display = "flex";
});

deleteInput.addEventListener("input", function () {
  if (deleteInput.value == "I UNDERSTAND") {
    confirmDeleteBtn.id = "delete-confirm";
  } else {
    confirmDeleteBtn.id = "delete-confirm-disabled";
  }
});

confirmDeleteBtn.addEventListener("click", function () {
  if (confirmDeleteBtn.id == "delete-confirm") {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        window.top.location.href = "http://localhost";
      }
    };
    xhttp.open("POST", "./jsToPhp/deleteAccount.php", true);
    xhttp.send();
  }
});

deleteShield.addEventListener("click", function () {
  if (!event.target.closest(".delete-account")) {
    deleteShield.style.display = "none";
    deleteInput.value = "";
  }
});

cancelDeleteAcc.addEventListener("click", function () {
  deleteShield.style.display = "none";
  deleteInput.value = "";
});
