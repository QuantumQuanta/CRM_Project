$o = jQuery.noConflict();
//function to delete row
function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}
//function for appending bulk data as table rows
function generateTableRows(inputData) {
  // $("#myTable tbody").empty();

  var rows = inputData.split("\n");
  rows.forEach(function (row) {
    var cells = row.split("\t");
    var newBlkRow = $("<tr>");
    cells.forEach(function (cell) {
      newBlkRow.append($('<td contenteditable="true">').text(cell));
    });
    //Adding delete button at the last of every row
    // cells.forEach(function (index){
    //   if ($("#assign_table thead th").eq(index).text().trim() === "Action") {

    //   }
    // });
    newBlkRow.append('<td><button class="delete-btn" onclick="deleteRow(this)">Delete</button></td>');
    $o("#assign_table tbody").append(newBlkRow);
  });
}

$o(document).ready(function () {
  //Add new empty rows for data entry
  $o('#assg_addRowBtn').on('click', function () {
    var newRow = $("<tr>");
    var cols = '';
    for (var i = 0; i < 22; i++) {
      cols += '<td contenteditable="true"></td>';
    }
    cols += '<td><button class="delete-btn" onclick="deleteRow(this)">Delete</button></td>';

    newRow.append(cols);
    $o("#assign_table tbody").append(newRow);
  });

  //Bulk assign function
  $o('#assg_addBlkBtn').on('click', function () {
    var inputData = $("#clientAssgInput").val().trim();
    generateTableRows(inputData);
  });

  //To take the table data as input
  $o("#ceoAssgupload").on("click", function () {
    var assgDataArr = [];
    $o("#assign_table tbody tr").each(function () {
      var rowData = "";
      $o(this).find("td").each(function (index, element) {
        // var columnHeader = $("#assign_table thead th").eq(index).text();
        rowData += $(element).text() + "|";
      });
      assgDataArr.push(rowData);
    });
    console.log(assgDataArr);
    var rawClData = {
      CLDT: assgDataArr
    }
    $.ajax({
      url: "../action/ceo_client_assign_config.php",
      type: "post",
      data: rawClData,
      dataType: "JSON",
      success: function (response) {
        console.log(response);
        $o('#ceoAssgupload').html("SUCCESS!");
        $o('#subBtnCREQ').prop('disabled', true);
        setTimeout(function () {
          $o('#ceoAssgupload').html('SUBMIT');
          $o('#subBtnCREQ').prop('disabled', false);
        }, 5000);
      }

    });
  });




});