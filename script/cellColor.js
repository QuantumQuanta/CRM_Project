// var table = document.getElementById("ceo_master_table");
// var cells = table.getElementsByTagName("td");
// var colorPicker = document.getElementById("colorPicker");

// for (var i = 0; i < cells.length; i++) {
//   // Retrieve stored cell color from local storage, if available
//   var cellId = cells[i].getAttribute("id"); // Assuming each cell has a unique ID attribute
//   var storedCellColor = localStorage.getItem(cellId + "_color");
//   if (storedCellColor) {
//     cells[i].style.backgroundColor = storedCellColor;
//   }

//   // Add a click event listener to each table cell
//   cells[i].addEventListener("click", function () {
//     // Retrieve the selected color from the color picker
//     var color = colorPicker.value;

//     // Set the background color of the clicked cell to the selected color
//     this.style.backgroundColor = color;

//     // Store the updated cell color information in local storage
//     var cellId = this.getAttribute("id"); // Assuming each cell has a unique ID attribute
//     localStorage.setItem(cellId + "_color", color);
//   });
// }

// colorPicker.addEventListener("input", function () {
//   var color = colorPicker.value;

//   // Store background color in local storage
//   localStorage.setItem("bgColor", color);
// });

// // Retrieve stored background color from local storage, if available
// var storedColor = localStorage.getItem("bgColor");
// if (storedColor) {
//   table.style.backgroundColor = storedColor;
//   colorPicker.value = storedColor;
// }

 var table = document.getElementById("ceo_master_table");
  var cells = table.getElementsByTagName("td");
  var colorPicker = document.getElementById("colorPicker");

  colorPicker.addEventListener("input", function () {
    var color = colorPicker.value;

    for (var i = 0; i < cells.length; i++) {
      cells[i].removeEventListener("click", changeColor);
      cells[i].addEventListener("click", changeColor);
    }
  });

  function changeColor() {
    this.style.backgroundColor = colorPicker.value;
    for (var i = 0; i < cells.length; i++) {
      cells[i].removeEventListener("click", changeColor);
    }
  }

  var table = document.createElement("table");
for (var i = 0; i < 5; i++) {
  var row = table.insertRow();
  for (var j = 0; j < 5; j++) {
    var cell = row.insertCell();
    cell.textContent = "Cell " + (i + 1) + "," + (j + 1);
  }
}
