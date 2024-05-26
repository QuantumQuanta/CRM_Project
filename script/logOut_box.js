
$(document).ready(function () {
  // Hide the div on page load
  $("#header_top_dropdown-content").hide();

  // Show the div when the button is clicked
  $("#header_top_dropdown").click(function (e) {
    e.stopPropagation(); // Prevents the click event from propagating to the document
    $("#header_top_dropdown-content").show();
  });

  // Hide the div when clicked outside of it
  $(document).click(function () {
    $("#header_top_dropdown-content").hide();
  });

  // Prevents the hide function from being called when clicking inside the div
  $("#header_top_dropdown").click(function (e) {
    e.stopPropagation(); // Prevents the click event from propagating to the document
  });
});
function toggleDiv() {
  var div = document.getElementById("emp_stat-b");
  if (div.style.display === "none") {
    div.style.display = "block";
  } else {
    div.style.display = "none";
  }
}
$(document).click(function () {
  $("#emp_stat-b").hide();
});