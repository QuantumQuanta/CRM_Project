
const dropDown = document.getElementById("hide_myDropdown");
$("#hide_dropbtn").on("click", function (e) {
    e.preventDefault();
    dropDown.style.display = (dropDown.style.display === "none") ? "block" : "none";
});

const toggleButtons = [
    "#sl_btn", "#DOC_btn", "#DOA_1_btn", "#Period_btn",
    "#Clientdetails_btn", "#Contact_btn", "#BCR_btn", "#Verified_btn",
    "#PCR_btn", "#firstresp_btn", "#DOA2_btn", "#secnd_resp_btn",
    "#DOA3_btn", "#third_resp_btn", "#Remarks", "#Email_btn"
];

var tablesWithClass = document.querySelectorAll('.ceo_master_table');

function toggleColumn(targetColIndex) {
    tablesWithClass.forEach(function (table) {
        // Select all table cells and header cells within the current table
        var cells = table.querySelectorAll(`td:nth-child(${targetColIndex}), th:nth-child(${targetColIndex})`);

        cells.forEach((cell) => {
            cell.classList.toggle("hidden");
        });

        localStorage.setItem(`col-${targetColIndex}`, cells[0].classList.contains("hidden"));
    });
}
toggleButtons.forEach((button, index) => {
    // //console.log("toggleButtons",button);
    const toggleButton = document.querySelector(button);
    toggleButton.addEventListener("click", () => toggleColumn(index + 1));

    const isHidden = localStorage.getItem(`col-${index + 1}`) === "true";
    if (isHidden) {
        toggleColumn(index + 1);
    }
});

const buttons = document.querySelectorAll("#hide_Btn button");

buttons.forEach((button) => {
    let isBlue = localStorage.getItem(button.id) === "true";

    if (isBlue) {
        button.classList.add("blue-button");
    }

    button.addEventListener("click", () => {
        button.classList.toggle("blue-button");
        localStorage.setItem(button.id, button.classList.contains("blue-button"));
    });
});
