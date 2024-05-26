// Function to check offcanvas display style
function checkOffcanvasDisplay() {
    let masterTable = document.getElementById("mastercrmDiv");
    // console.log("inside checkOffcanvasDisplay", masterTable);
    let offcanvasData = document.getElementById("offcanvas");
    let mixhide_dropdown = document.getElementById("mixhide_dropdown");
    // console.log("offcanvasData.style.display", offcanvasData.style.display)
    if (offcanvasData.style.display === "flex") {
        masterTable.style.display = "none";
        mixhide_dropdown.style.display = "none";
    } else {
        masterTable.style.display = "block";
    }
}

// Add a click event listener to the th element

var clientDetailsTd = document.querySelectorAll('.offcanvas_toggler');
clientDetailsTd.forEach(function(element) {
    element.addEventListener('click', checkOffcanvasDisplay);
});

var closebtn = document.getElementById('closebtn');
closebtn.addEventListener('click', checkOffcanvasDisplay);
