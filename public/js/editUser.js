const editUserButton = document.querySelector(".edit-button");
const editInputRows = document.querySelectorAll(".row-user-edit");

let isOpen = false;

const editUserEventHandler = () => {
  if (isOpen) {
    editInputRows.forEach((row) => (row.style.display = "none"));
    isOpen = false;
  } else {
    editInputRows.forEach((row) => (row.style.display = "table-row"));
    isOpen = true;
  }
};

editUserButton.addEventListener("click", editUserEventHandler);
