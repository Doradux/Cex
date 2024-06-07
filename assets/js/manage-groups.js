const cancelCreate = document.getElementById("addGroup-cancel");
const postCreate = document.getElementById("addGroup-create");
const addGroupDiv = document.querySelector(".addGroup");
const groupInput = document.getElementById("addGroup-input");
const addGroupBtn = document.getElementById('add-group-btn');

cancelCreate.addEventListener("click", function () {
  addGroupDiv.style.display = "none";
});

addGroupBtn.addEventListener('click', function() {
    addGroupDiv.style.display = "flex";
})
