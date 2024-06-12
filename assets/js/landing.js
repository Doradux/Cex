const sections = document.querySelectorAll(".section");
const iframe = document.getElementById("iframe");

sections.forEach((section) => {
  section.addEventListener("click", function () {
    if (section.textContent == "All") {
      iframe.src = "../controller/contacts.php";
    } else if (section.textContent == "Pending") {
      iframe.src = "../controller/pending.php";
    } else if (section.textContent == "Add friend") {
      iframe.src = "../controller/add-friend.php";
    } else if (section.textContent == "Public servers") {
      iframe.src = "../controller/public-servers.php";
    }
  });
});
