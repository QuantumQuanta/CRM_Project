const VisdropDown = document.getElementById("visHide_myDropdown");
$("#visHide_dropbtn").on("click", function (e) {
  e.preventDefault();
  VisdropDown.style.display = (VisdropDown.style.display === "none") ? "block" : "none";
});

const toggleButtons = [
  "#visId_no_tgl", "#visName_tgl", "#fillBy_tgl", "#fill_DT_tgl",
  "#exp_DT_tgl", "#actual_DT_tgl", "#asso_name_tgl", "#meet_tgl",
  "#meet_room_tgl", "#visId_tgl", "#assoId_tgl", "#KYC_tgl",
  "#Add_tgl", "#Email_tgl", "#Comments_tgl"
];

const table = document.querySelector("#visitor_log_table");

function toggleColumn(targetColIndex) {
  const cells = table.querySelectorAll(
    `td:nth-of-type(${targetColIndex}), th:nth-of-type(${targetColIndex})`
  );

  cells.forEach((cell) => {
    cell.classList.toggle("hidden");
  });

  localStorage.setItem(`visCol-${targetColIndex}`, cells[0].classList.contains("hidden"));
}

toggleButtons.forEach((button, index) => {
  const toggleButton = document.querySelector(button);
  toggleButton.addEventListener("click", () => toggleColumn(index + 1));

  const isHidden = localStorage.getItem(`visCol-${index + 1}`) === "true";
  if (isHidden) {
    toggleColumn(index + 1);
  }
});

const buttons = document.querySelectorAll("button");

buttons.forEach((viBbutton) => {
  let isBlue = localStorage.getItem(viBbutton.id) === "true";

  if (isBlue) {
    viBbutton.classList.add("blue-button");
  }

  viBbutton.addEventListener("click", () => {
    viBbutton.classList.toggle("blue-button");
    localStorage.setItem(viBbutton.id, viBbutton.classList.contains("blue-button"));
  });
});

