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
