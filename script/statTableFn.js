function createCustomTable(filter, dataKeyStr, data) {
    // Get a reference to the table
    var table = $('#statDataDisTable');
    var tableDiv = $('#statTableDiv');
    //for input field and close button
    var tablebtns = $('#statTablebtnDiv')
    var tableHeading = $('#statTableHeading');

    // Clear the table's contents
    table.empty();

    if (tablebtns.find(".statTableClsBtn").length === 0) {
        //A close button to close the table
        var closeButton = $("<button class='statTableClsBtn'>Close</button>");

        // Add a click event handler to the close button
        closeButton.on('click', function () {
            tableDiv.css('display', 'none'); 
        });

        // Append the close button to the div
        tablebtns.prepend(closeButton);
    }


    // Create the table header (thead) and body (tbody)
    var thead = $('<thead>');
    var tbody = $('<tbody>');

    // Create the header row
    var headerRow = $('<tr>');

    //changing the dataKey value accordingly
    switch (dataKeyStr) {
        case 'pcr_resp':
            dataKeyStr = 'PCR-Resp';
            break;
        case 'pcr_pt':
            dataKeyStr = 'PCR-PT';
            break;
        case 'pcr_prc':
            dataKeyStr = 'PCR-PRC';
            break;
        case 'pcr_client_rating':
            dataKeyStr = 'PCR-Client Rating';
            break;
        case 'client_stat':
            dataKeyStr = 'Client Status';
            break;
        default:
            dataKeyStr = dataKeyStr;
    }

    // Define column headers based on the filter value
    if (filter === 'pro' || filter === 'resp' || filter === 'ceo_R') {
        headerRow.append($('<th>').text("Cl-Id"));
        headerRow.append($('<th>').text("Name"));
        headerRow.append($('<th>').text("Contact"));
        headerRow.append($('<th>').text("Date-time"));
        headerRow.append($('<th>').text(dataKeyStr));
    } else if (filter === 'ceo_C') {
        headerRow.append($('<th>').text("PRO Name"));
        headerRow.append($('<th>').text("Date-time1"));
        headerRow.append($('<th>').text(dataKeyStr));
        headerRow.append($('<th>').text("Resp2 Name"));
        headerRow.append($('<th>').text("Date-time2"));
        headerRow.append($('<th>').text(dataKeyStr));
    }

    // Append the header row to the thead
    thead.append(headerRow);

    // Append the thead to the table
    table.append(thead);

    // Clear the table's contents
    tbody.empty();
    //creating a variable to hold the ceo_C data string which is in two different keys of an arrayObj
    var dataString = "";

    // Loop through the data and create rows
    if (filter === 'pro' || filter === 'resp' || filter === 'ceo_R') {
        if (data != null) {
            $.each(data, function (key, value) {
                var rowData = value.split('|');
                var row = $('<tr>');
                row.append($('<td>').text(key));
                row.append($('<td>').text(rowData[2]));
                row.append($('<td>').text(rowData[3]));
                row.append($('<td>').text(rowData[1]));
                row.append($('<td>').text(rowData[0]));


                // Append the row to the table body
                tbody.append(row);
            });
        }
        else {
            var row = $('<tr>');
            row.append($('<td>').text('No Data'));
            row.append($('<td>').text('No Data'));
            row.append($('<td>').text('No Data'));
            row.append($('<td>').text('No Data'));
            row.append($('<td>').text('No Data'));
            // Append the row to the table body
            tbody.append(row);
        }

    } else if (filter === 'ceo_C') {
        var keyID = "";
        var countKey = 0;
        console.log(data);
        if (data != null) {
            $.each(data, function (key, value) {
                keyID = key.split('_');
                dataString += data[key] + "|";
                // console.log(keyID);
                countKey++;
            });
            //  console.log(dataString);
            var rowDataStr = dataString.split('|');
            // console.log(rowDataStr);
            var row = $('<tr>');
            if (countKey > 1) {
                row.append($('<td>').text(rowDataStr[2]));
                row.append($('<td>').text(rowDataStr[1]));
                row.append($('<td>').text(rowDataStr[0]));
                row.append($('<td>').text(rowDataStr[5]));
                row.append($('<td>').text(rowDataStr[4]));
                row.append($('<td>').text(rowDataStr[3]));
            }
            else {
                if (dataKeyStr === 'PCR-PRC') {
                    row.append($('<td>').text("-"));
                    row.append($('<td>').text("-"));
                    row.append($('<td>').text("-"));
                    row.append($('<td>').text(rowDataStr[2]));
                    row.append($('<td>').text(rowDataStr[1]));
                    row.append($('<td>').text(rowDataStr[0]));
                }
                else {
                    if (keyID[2] === '1') {
                        row.append($('<td>').text(rowDataStr[2]));
                        row.append($('<td>').text(rowDataStr[1]));
                        row.append($('<td>').text(rowDataStr[0]));
                        row.append($('<td>').text("No Data"));
                        row.append($('<td>').text("No Data"));
                        row.append($('<td>').text("No Data"));
                    }
                    else if (keyID[2] === '2') {
                        row.append($('<td>').text("No Data"));
                        row.append($('<td>').text("No Data"));
                        row.append($('<td>').text("No Data"));
                        row.append($('<td>').text(rowDataStr[2]));
                        row.append($('<td>').text(rowDataStr[1]));
                        row.append($('<td>').text(rowDataStr[0]));
                    } else {
                        console.log("I'm in abyss!");
                    }
                }

            }


            // Append the row to the table body
            tbody.append(row);
        }
        else {
            var row = $('<tr>');
            row.append($('<td>').text('No Data'));
            row.append($('<td>').text('No Data'));
            row.append($('<td>').text('No Data'));
            row.append($('<td>').text('No Data'));
            row.append($('<td>').text('No Data'));
            row.append($('<td>').text('No Data'));
            // Append the row to the table body
            tbody.append(row);
        }




    }
    // Append the tbody to the table
    table.append(tbody);

    //hiding the H3 tag which is the stat table heading
    tableHeading.html("Statistics Data");
    //Showing the #statTableDiv
    tableDiv.css('display', 'block');
}