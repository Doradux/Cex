const delInput = document.getElementById("confirmKey");
const deleteBtn = document.getElementById("delete-server");

delInput.addEventListener("input", function () {
  if (this.value == "I UNDERSTAND") {
    deleteBtn.style.backgroundColor = "crimson";
    deleteBtn.style.color = "white";
    deleteBtn.style.cursor = "pointer";
    deleteBtn.addEventListener("click", handleDeleteClick);
  } else {
    deleteBtn.style.cursor = "not-allowed";
    deleteBtn.style.backgroundColor = "gray";
    deleteBtn.removeEventListener("click", handleDeleteClick);
  }
});

function handleDeleteClick() {
  event.preventDefault(); // Prevent the default action (form submission or link navigation)
  if (delInput.value === "I UNDERSTAND") {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        response = JSON.parse(this.response);
        if (response.success) {
          window.top.top.location.reload();
        } else {
          console.error(response);
        }
      }
    };
    xhttp.open("POST", "./jsToPhp/deleteServer.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
  }
}
