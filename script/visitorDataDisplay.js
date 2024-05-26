function visDataDisplay(visId) {
    visName = document.getElementById('visName'+visId).textContent;
    document.getElementById('visDataModalLabel').innerHTML = visName;
    
    var value = {
        visId: visId
    }
    

    $.ajax({
        url: '../action/vistorDataDisplay.php',
        data: value,
        type: 'POST',
        dataType: 'JSON',
        success: function (response) {
            visallData = response.data;
            dataSetNum = response.rowNo;
            var visTable = $("<table>").attr("id", "visTable").addClass("table resizable-table");
            var visHeaderRow = $("<tr>").append(
                $("<th>").text("Date&time").attr("id", "visTable_dt"),
                $("<th>").text("ETA").attr("id", "visTable_eta"),
                $("<th>").text("ATA").attr("id", "visTable_ata"),
                $("<th>").text("Associates' Name").attr("id", "visTable_assName"),
                $("<th>").text("To Meet").attr("id", "visTable_toMeet"),
                $("<th>").text("Meeting Room").attr("id", "visTable_meetRoom"),
                $("<th>").text("Visitor's Id").attr("id", "visTable_visId"),
                $("<th>").text("Associates' Id").attr("id", "visTable_assId"),
                $("<th>").text("KYC Status").attr("id", "visTable_kycStat"),
                $("<th>").text("Visitor's Address").attr("id", "visTable_visAdd"),
                $("<th>").text("Email").attr("id", "visTable_email"),
                $("<th>").text("Comments").attr("id", "visTable_com"),
            );
            visTable.append(visHeaderRow);
            for (i = 0; i < dataSetNum; i++) {
                var visRow = $("<tr>").append(
                    $('<td>').text(visallData['vis_dt' + i]).addClass(""),
                    $('<td>').text(visallData['vis_eta' + i]).addClass(""),
                    $('<td>').text(visallData['vis_ata' + i]).addClass(""),
                    $('<td>').text(visallData['vis_assname' + i]).addClass("visTable_assName"),
                    $('<td>').text(visallData['vis_tomeet' + i]).addClass(""),
                    $('<td>').text(visallData['vis_meetroom' + i]).addClass(""),
                    $('<td>').text(visallData['vis_idno' + i]).addClass("visTable_visId"),
                    $('<td>').text(visallData['vis_assidno' + i]).addClass("visTable_assId"),
                    $('<td>').text(visallData['vis_kycstat' + i]).addClass(""),
                    $('<td>').text(visallData['vis_address' + i]).addClass("visTable_visAdd"),
                    $('<td>').text(visallData['vis_email' + i]).addClass("visTable_email"),
                    $('<td>').text(visallData['vis_comment' + i]).addClass("visTable_com")

                );
                visTable.append(visRow);
            }
            $("#visDataModalbody").empty().append(visTable);
        }

    });
}