const cancelCreate = document.getElementById("addGroup-cancel");
const postCreate = document.getElementById("addGroup-create");
const addGroupDiv = document.querySelector(".addGroup");
const groupInput = document.getElementById("newName");
const addGroupBtn = document.querySelector(".add-new-group");

cancelCreate.addEventListener("click", function () {
  addGroupDiv.style.display = "none";
  clearGroupInputError();
});

groupInput.addEventListener("click", function () {
  clearGroupInputError();
});

addGroupBtn.addEventListener("click", function () {
  addGroupDiv.style.display = "flex";
  clearGroupInputError();
});

postCreate.addEventListener("click", function () {
  const newGroupName = groupInput.value.trim();
  if (newGroupName == "") {
    displayGroupInputError("Invalid name");
    return;
  }

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      if (response.success) {
        window.location.reload();
        addGroupDiv.style.display = "none";
      } else {
        console.error(response.error);
      }
    }
  };
  xhttp.open("POST", "./jsToPhp/postGroup.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params = "groupName=" + encodeURIComponent(newGroupName);
  xhttp.send(params);
});

function displayGroupInputError(message) {
  groupInput.style.outline = "1px solid crimson";
  groupInput.style.color = "crimson";
  groupInput.value = message;
}

// Function to clear error message and outline
function clearGroupInputError() {
  groupInput.style.color = "white";
  groupInput.style.outline = "none";
}

// Delete group
const groups = document.querySelectorAll(".group");
groups.forEach((group) => {
  group.querySelector(".group-delete").addEventListener("click", function () {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        response = JSON.parse(this.response);
        if (response.success) {
          window.location.reload();
          group.remove();
        } else {
          console.error(response);
        }
      }
    };
    xhttp.open("POST", "./jsToPhp/deleteGroup.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params = "groupId=" + encodeURIComponent(group.getAttribute("groupId"));
    xhttp.send(params);
  });
});

// Modify group name
var modifyShield = document.querySelector(".modify-group-shield");
const editGroupBtns = document.querySelectorAll(".group-modify");
let currentBtn = null;

editGroupBtns.forEach((btn) => {
  btn.addEventListener("click", function () {
    currentBtn = btn;
    var groupName = btn.parentElement.parentElement.getAttribute("groupName");
    document.getElementById("newName").value = groupName;
    modifyShield.style.display = "flex";
    clearGroupInputError();
  });
});

// Confirm modify
var confirmModifyBtn = document.getElementById("confirmModify");
confirmModifyBtn.addEventListener("click", function () {
  if (currentBtn) {
    var groupModifyId =
      currentBtn.parentElement.parentElement.getAttribute("groupId");
    var newName = document.getElementById("newName").value.trim();
    if (newName !== "") {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          var response = JSON.parse(this.response);
          if (response.success) {
            window.location.reload();
            modifyShield.style.display = "none";
            currentBtn.parentElement.parentElement.querySelector(
              "p"
            ).innerHTML = newName;
          } else {
            console.error(this.response);
          }
        }
      };
      xhttp.open("POST", "./jsToPhp/modifyGroup.php", true);
      xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      var params =
        "groupId=" +
        encodeURIComponent(groupModifyId) +
        "&groupNewName=" +
        encodeURIComponent(newName);
      xhttp.send(params);
    } else {
      displayGroupInputError("Invalid name");
    }
  }
});

modifyShield.addEventListener("click", function (event) {
  if (!event.target.closest(".modify-group")) {
    modifyShield.style.display = "none";
    clearGroupInputError();
  }
});
