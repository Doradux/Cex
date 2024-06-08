const cancelCreate = document.getElementById("addGroup-cancel");
const postCreate = document.getElementById("addGroup-create");
const addGroupDiv = document.querySelector(".addGroup");
const groupInput = document.getElementById("addGroup-input");
const addGroupBtn = document.querySelector(".add-new-group");

cancelCreate.addEventListener("click", function () {
  addGroupDiv.style.display = "none";
});

addGroupBtn.addEventListener("click", function () {
  addGroupDiv.style.display = "flex";
});

postCreate.addEventListener("click", function () {
  const newGroupName = groupInput.value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      if (response.success) {
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
