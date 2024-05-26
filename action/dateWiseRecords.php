<?php
require '../action/session_control.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../action/index.php");
} else if ($_SESSION['desg_code'] == 'CEO' || $_SESSION['desg_code'] == 'CRTR') {
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    //$clientUniqueId = $_SESSION['clientUniqueId'];
} else {
    header("location: ../action/index.php");
}
?>

<?php
date_default_timezone_set('Asia/Kolkata');
$date = date("g:i A d.m.y "); //dS F Y, g:i A
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheet/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../stylesheet/dateWiseRecords.css">
    <title>Date Wise Records</title>
</head>

<body>
    <?php
    require '../layout/header_login.php';
    ?>
    <!-- page body with sidenav start -->
    <div id="contentMain">
        <?php require '../layout/sidebar.php'; ?>
        <div id="contentBody">
            <div id="selectRec">
                <h3 id="dwr_headingText">Select a start date and end date to display records</h3>
                <div id="dwr_nameDD" name="dwr_nameDD">
                    <label id="dwr_DDlabel">Select Name:</label>
                </div>
                <br>
                &nbsp
                <br>
                <div id="datePickers">
                    <label for="dwr_fdate" class="datePicker">Start Date:</label>
                    <input type="datetime-local" name="dwr_fdate" id="dwr_fdate">
                    <br>
                    &nbsp
                    <br>
                    <label for="dwr_ldate" class="datePicker">End Date:</label>
                    <input type="datetime-local" name="dwr_ldate" id="dwr_ldate">
                    <br>
                    &nbsp
                    <br>
                    <button id="dwr_searchBtn">Search</button>
                </div>
            </div>

            <div id="TableDiv" style="display: none;">
                <table id="dwr_table"></table>
            </div>
        </div>
    </div>
    <?php require '../layout/footer.php'; ?>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" type="text/javascript"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.slim.min.js" type="text/javscript"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../script/dataTables_min.js" type="text/javascript"></script>
    <script>
        $z = jQuery.noConflict();

        function createDropDown(dataObj) {
            var dropdown = $z('<select>').attr('id', 'dwr_dropdown').appendTo('#dwr_nameDD');
            var chooseOption = $z('<option>').val('').text('Choose');
            dropdown.append(chooseOption);
            $z.each(dataObj, function(key, value) {
                var parts = value.split('|');
                var option = $z('<option>').val(key + "|" + parts[2]).text(parts[1]);
                dropdown.append(option);
            });
            var allOption = $z('<option>').val('all|all').text('All');
            dropdown.append(allOption);
        }

        function createTable(data, dsg) {
            var table = $('#dwr_table');
            table.empty();
            var thead = $('<thead>').appendTo(table);
            var tbody = $('<tbody>').appendTo(table);
            var headers = [];
            // Adding table headers
            if (dsg == 'PRO') {
                headers = ["Client-Name w_S/C", "Date-Time", "User-Name", "Contacted Us", "KYC Stat", "PCR-Priority", "PCR-ET", "Call Type", "Call Stat", "Category", "Source", "Comment-PRO", "Client Stat", "PCR-Resp", "PCR-PT", "Client Rating"];
            } else if (dsg == '2NDRESP') {
                headers = ["Client-Name w_S/C", "Date-Time", "User-Name", "Comment", "Client Stat", "PCR-Resp", "PCR-PT", "PCR-PRC", "Client Rating"];
            } else if (dsg == 'all') {
                headers = ["Client-Name w_S/C", "Date-Time", "PRO-Name", "Contacted Us", "KYC Stat", "PCR-Priority", "PCR-ET", "Call Type", "Call Stat", "Category", "Source", "Comment-PRO", "Client Stat-1", "PCR-Resp-1", "PCR-PT-1", "Client Rating-1", "2ndResp-Name", "Comment-2Resp", "Client Stat-2", "PCR-Resp-2", "PCR-PT-2", "PCR-PRC", "Client Rating-2"];
            }
            var headerRow = $('<tr>').appendTo(thead);
            headers.forEach(function(header) {
                var headerCol = $('<th>');
                if (header == "Comment-PRO" || header == "Comment" || header == "Comment-2Resp") {
                    headerCol.addClass('special-col-h');

                }
                headerCol.text(header).appendTo(headerRow);

            });

            // Adding table rows
            data.forEach(function(rowData) {
                var row = $('<tr>').appendTo(tbody);
                var rowDataArray = rowData.split("|");
                var clDetails = rowDataArray.pop();

                rowDataArray.forEach(function(cellData, index) {
                    var clientData = clDetails.split("+");
                    var cell = $z('<td>');
                    cell.attr('class', 'fixedCol');
                    if (headers[index] === "Client-Name w_S/C") {
                        var aTag = $z('<a>');
                        aTag.attr('href', '#');/*+ clientData[4] */
                        aTag.text(clientData[3] + clientData[0] + clientData[2]+'('+clientData[1]+')');
                        aTag.appendTo(cell);
                        cell.appendTo(row);
                        cell.hover(function() {
                            // clName=clientData[0];
                            var cldet = "CID: " + cellData ;
                            $(this).attr('title', cldet);
                        });
                    } else if (headers[index] === "Comment-PRO" || headers[index] === "Comment" || headers[index] === "Comment-2Resp") {
                        cell.text(cellData).appendTo(row);
                        cell.attr('class', 'special-col-d');
                    } else {
                        cell.text(cellData).appendTo(row);
                    }
                });
            });

            // Append the table to the container
            $('#TableDiv').append(table);
            $('#TableDiv').css('display', 'block');
            sessionStorage.setItem('tableData', table.html());

        }


        var data = {
            docLoad: 'yes',
        }
        $z(document).ready(function() {
            $.ajax({
                url: '../action/dwr_config.php',
                type: 'POST',
                data: data,
                dataType: 'JSON',
                success: function(response1) {
                    createDropDown(response1);
                }
            });

            var storedData = sessionStorage.getItem('tableData');
            if (storedData) {
                $('#dwr_table').html(storedData);
                $('#TableDiv').css('display', 'block');
            }
            

            var firstInDT = localStorage.getItem('firstInDT');
            var lastInDT = localStorage.getItem('lastInDT');

            if (firstInDT) {
                $z('#dwr_fdate').val(firstInDT);
            }

            if (lastInDT) {
                $z('#dwr_ldate').val(lastInDT);
            }

            $z('#dwr_searchBtn').on('click', function() {
                if ($z('#dwr_dropdown').val() == '') {
                    alert("Please select an option from the dropdown!");
                } else if ($z('#dwr_fdate').val() == '') {
                    alert("Please select a start date and time!");
                } else if ($z('#dwr_ldate').val() == '') {
                    alert("Please select an end date and time!");
                } else {
                    var nval = $z('#dwr_dropdown').val();
                    var part = nval.split('|');
                    var dsg = part[1];
                    console.log(dsg);
                    var data = {
                        flag: 'up',
                        name: $z('#dwr_dropdown').val(),
                        fdate: $z('#dwr_fdate').val(),
                        ldate: $z('#dwr_ldate').val(),
                    }
                    
                    var fdt = $z('#dwr_fdate').val();
                    var ldt = $z('#dwr_ldate').val();

                    // console.log(data);
                    localStorage.setItem('firstInDT', fdt);
                    localStorage.setItem('lastInDT', ldt);

                    $.ajax({
                        url: '../action/dwr_config.php',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        success: function(response) {
                            // console.log(response);
                            createTable(response, dsg);
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>