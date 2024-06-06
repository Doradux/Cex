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
