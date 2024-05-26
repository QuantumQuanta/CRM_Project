
function client_id_input(client_id_show) {
    let masterTable = document.getElementById("mastercrmDiv");
    var x = document.getElementById("offcanvas");
    var y = document.getElementById("mixedDataTableCont");

    if (x.style.display === "none") {
        masterTable.style.display = 'none';
        x.style.display = "flex";
    }
    else if (x.style.display === "flex" && client_id_show) {
        masterTable.style.display = 'none';
        x.style.display = "flex";
        y.style.display = "none";
    }
    else {
        masterTable.style.display = 'block';
        x.style.display = "none";
        y.style.display = "none";
    }
    var value = {
        client_id_val: client_id_show,
    };

    // console.log("catch client id", value);

    $.ajax({
        url: '../action/ceo_crm_config.php',
        type: 'POST',
        data: value,
        dataType: 'JSON',
        success: function (response) {
            // alert("data sent");
            document.getElementById('client_offcanvas_name').textContent = response.client_name;
            document.getElementById('client_offcanvas_contact').textContent = response.client_contact;
            document.getElementById('client_offcanvas_email').textContent = response.client_email;
            document.getElementById('client_offcanvas_id').textContent = response.uniq_id;
            document.getElementById('client_offcanvas_state').textContent = response.client_state;
            document.getElementById('client_offcanvas_city').textContent = response.client_city;
            document.getElementById('client_offcanvas_code').textContent = response.code;
            document.getElementById('client_offcanvas_ref').textContent = response.reference;
            document.getElementById('client_offcanvas_cat').textContent = response.category;
            document.getElementById('client_offcanvas_doa1').textContent = response.doa_1;
            document.getElementById('client_offcanvas_1resp').textContent = response.first_resp;
            document.getElementById('client_offcanvas_doa2').textContent = response.doa_2;
            document.getElementById('client_offcanvas_2resp').textContent = response.second_resp;
            document.getElementById('client_offcanvas_doa3').textContent = response.doa_3;
            document.getElementById('client_offcanvas_3resp').textContent = response.third_resp;
            //console.log(response.client_name);
            document.getElementById('mixedTableShow').style.display = 'block';
            var ObjID = {
                clntIDceo: response.uniq_id,
            };
            var queryParam = $.param(ObjID);
            // Define the new URL
            var newURL = "../action/c_requirement.php?" + queryParam;
            // $.get(newURL, function(data) {
            //     // Handle the response from the PHP script
            //     console.log("Response from PHP: " + data);
            // });
            $('#sub_cReqCEO').attr("href", newURL);
        }
    });


    $.ajax({
        url: '../action/ceo_crm_mixedTable.php',
        type: 'POST',
        data: value,
        dataType: 'JSON',
        success: function (response) {
            console.log('mix table', response)
            mixData = response.data;
            loop = response.rowNum;
            var table = $("<table>").attr("id", "mixedDataTable").addClass("table resizable-table");
            var headerRow = $("<tr>").append(
                $("<th>").text("Date&time").attr("id", "date_time_mx"),
                /*$("<th>").text("PRO Name"),*/
                $("<th>").text("Contacted Us").attr("id", "contact_us_mx").addClass(""),
                $("<th>").text("KYC Stat").attr("id", "kyc_mx").addClass(""),
                $("<th>").text("PCR Priority").attr("id", "pcr_pr_mx").addClass(""),
                $("<th>").text("PCR-ET").attr("id", "pcr_et_mx").addClass(""),
                $("<th>").text("Call Type").attr("id", "call_ty_mx").addClass(""),
                $("<th>").text("Call Stat").attr("id", "call_st_mx").addClass(""),
                $("<th>").text("Category").attr("id", "category_mx").addClass(""),
                $("<th>").text("Source").attr("id", "source_mx").addClass(""),
                $("<th>").text("Comment-1").attr("id", "com1_mx").addClass(""),
                $("<th>").text("Client Stat-1").attr("id", "client_st1_mx").addClass(""),
                $("<th>").text("PCR Resp 1").attr("id", "pcs_res1_mx").addClass(""),
                $("<th>").text("PCR-PT 1").attr("id", "pcr_pt1_mx").addClass(""),
                $("<th>").text("Client Rating 1").attr("id", "client_rt1_mx").addClass(""),
                /*$("<th>").text("Sec-resp Name"),*/
                $("<th>").text("Comment-2").attr("id", "com2_mx").addClass(""),
                $("<th>").text("Client Stat-2").attr("id", "client_st2_mx").addClass(""),
                $("<th>").text("PCR Resp 2").attr("id", "pcs_res2_mx").addClass(""),
                $("<th>").text("PCR-PT 2").attr("id", "pcr_pt2_mx").addClass(""),
                $("<th>").text("PCR-PRC").attr("id", "pcr_prc_mx").addClass(""),
                $("<th>").text("Client Rating 2").attr("id", "client_rt2_mx").addClass("")
            );
            table.append(headerRow);
            // console.log(loop);
            //var keys = Object.keys(data);
            for (i = 0; i < loop; i++) {
                // value = data[key];
                // console.log(key+' : '+value);
                var row = $("<tr>").append(
                    $('<td>').text(mixData['dt' + i]),
                    /*$('<td>').text(mixData['pro_name' + i]),*/
                    $('<td>').text(mixData['contacted_us' + i]).addClass(''),
                    $('<td>').text(mixData['kyc_stat' + i]).addClass(''),
                    $('<td>').text(mixData['pcr_priority' + i]).addClass(''),
                    $('<td>').text(mixData['pcr_et' + i]).addClass(''),
                    $('<td>').text(mixData['call_type' + i]).addClass('call_ty_mxTd'),
                    $('<td>').text(mixData['call_stat' + i]).addClass(''),
                    $('<td>').text(mixData['category' + i]).addClass(''),
                    $('<td>').text(mixData['source' + i]).addClass(''),
                    $('<td>').text(mixData['comment_1' + i]).addClass('com1_mxTd'),
                    $('<td>').text(mixData['client_stat_1' + i]).addClass('client_rt1_mxTd'),
                    $('<td>').text(mixData['pcr_resp_1' + i]).addClass(''),
                    $('<td>').text(mixData['pcr_pt_1' + i]).addClass(''),
                    $('<td>').text(mixData['client_rating_1' + i]).addClass(''),
                    /*$('<td>').text(mixData['sec_resp_name' + i]),*/
                    $('<td>').text(mixData['comment_2' + i]).addClass('com2_mxTd'),
                    $('<td>').text(mixData['client_stat_2' + i]).addClass('client_st2_mxTd'),
                    $('<td>').text(mixData['pcr_resp_2' + i]).addClass(''),
                    $('<td>').text(mixData['pcr_pt_2' + i]).addClass(''),
                    $('<td>').text(mixData['pcr_prc' + i]).addClass(''),
                    $('<td>').text(mixData['client_rating_2' + i]).addClass(''),
                );
                table.append(row);

                /*console.log(i + ' : ' + dt_mixData);
                console.log(i + ' : ' + pro_name_mixData);
                console.log(i + ' : ' + contacted_us_mixData);
                console.log(i + ' : ' + kyc_stat_mixData);
                console.log(i + ' : ' + pcr_priority_mixData);
                console.log(i + ' : ' + pcr_et_mixData);
                console.log(i + ' : ' + call_type_mixData);
                console.log(i + ' : ' + call_stat_mixData);
                console.log(i + ' : ' + category_mixData);
                console.log(i + ' : ' + source_mixData);
                console.log(i + ' : ' + comment_1_mixData);
                console.log(i + ' : ' + client_stat_1_mixData);
                console.log(i + ' : ' + pcr_resp_1_mixData);
                console.log(i + ' : ' + pcr_pt_1_mixData);
                console.log(i + ' : ' + client_rating_1_mixData);
                console.log(i + ' : ' + sec_resp_name_mixData);
                console.log(i + ' : ' + comment_2_mixData);
                console.log(i + ' : ' + client_stat_2_mixData);
                console.log(i + ' : ' + pcr_resp_2_mixData);
                console.log(i + ' : ' + pcr_pt_2_mixData);
                console.log(i + ' : ' + pcr_prc_mixData);
                console.log(i + ' : ' + client_rating_2_mixData);*/
            }

            var dropdownContent = $("<div>").attr("id", "mixTableHide_myDropdown").addClass("mixhide_dropdown_content").hide();

            var dropdownItems = [
                "Date&time", "Contacted Us", "KYC Stat", "PCR Priority", "PCR-ET",
                "Call Type", "Call Stat", "Category", "Source", "Comment-1",
                "Client Stat-1", "PCR Resp 1", "PCR-PT 1", "Client Rating 1",
                "Comment-2", "Client Stat-2", "PCR Resp 2", "PCR-PT 2", "PCR-PRC",
                "Client Rating 2"
            ];

            dropdownItems.forEach(function (item, index) {
                // console.log("up dropdownItems");
                if (item == "Date&time") {
                    var button = $("<button>").attr("id", "date_time_hidemx").addClass("tgl_btn_name");
                    var anchor = $("<a>").append(button, " " + item);
                    dropdownContent.append(anchor);

                    button.click(function () {
                        toggleColumn(index + 1);
                        toggleBlueButton(button);
                    });
                } else {
                    var buttonId = item.toLowerCase().replace(/\s+/g, "_") + "_hidemx";
                    var button = $("<button>").attr("id", buttonId).addClass("tgl_btn_name");
                    var anchor = $("<a>").append(button, " " + item);
                    dropdownContent.append(anchor);

                    button.click(function () {
                        toggleColumn(index + 1);
                        toggleBlueButton(button);
                    });
                }
            });

            $("#mixhide_dropdown").empty().append(
                $("<button>").attr("id", "mixTableHide_dropbtn").addClass("").css("vertical-align", "middle").append("<span>HIDE</span>"),
                dropdownContent
            );

            $("#mixTableHide_dropbtn").click(function () {
                $("#mixTableHide_myDropdown").toggle();

                if ($("#mixTableHide_dropbtn").hasClass("blue-button")) {
                    $("#mixTableHide_dropbtn").removeClass("blue-button");
                } else {
                    $("#mixTableHide_dropbtn").addClass("blue-button");
                }
            });


            $("#mixedDataTableCont").empty().append(table);



            // Function to toggle column visibility
            function toggleColumn(targetColIndex) {
                const MixTablecells = $(`#mixedDataTableCont td:nth-child(${targetColIndex}), #mixedDataTableCont th:nth-child(${targetColIndex})`);

                if (MixTablecells.hasClass("hidden")) {
                    MixTablecells.removeClass("hidden");
                } else {
                    MixTablecells.addClass("hidden");
                }
                localStorage.setItem(`mixcol-${targetColIndex}`, MixTablecells.hasClass("hidden"));
            }

            // Function to toggle blue button state
            function toggleBlueButton(mixbutton) {
                let isBlue = localStorage.getItem(mixbutton.attr("id")) === "true";
                // console.log("mixbutton", mixbutton.attr("id"), "isBlue", isBlue);
                if (isBlue) {
                    mixbutton.removeClass("blue-button");
                    localStorage.setItem(mixbutton.attr("id"), false);
                } else {
                    mixbutton.addClass("blue-button");
                    localStorage.setItem(mixbutton.attr("id"), true);
                }
                isBlue = !isBlue;
            }


            // Retrieve the stored state of the toggled columns and apply them on page load
            for (let i = 1; i <= 16; i++) {
                const isHidden = localStorage.getItem(`mixcol-${i}`) === "true";
                if (isHidden) {
                    toggleColumn(i);
                }
            }

            // Apply blue button state on page load
            dropdownItems.forEach(function (item) {
                // console.log("down dropdownItems");
                if (item == "Date&time") {
                    const button = $("#" + "date_time_hidemx");
                    // toggleBlueButton(button);
                    let isBlue = localStorage.getItem(button.attr("id")) === "true";
                    // console.log("mixbutton", button.attr("id"), "isBlue", isBlue);
                    if (isBlue) {
                        button.addClass("blue-button");
                    }
                } else {
                    const buttonId = item.toLowerCase().replace(/\s+/g, "_") + "_hidemx";
                    const button = $("#" + buttonId);
                    // toggleBlueButton(button);
                    let isBlue = localStorage.getItem(button.attr("id")) === "true";
                    // console.log("mixbutton", button.attr("id"), "isBlue", isBlue);
                    if (isBlue) {
                        button.addClass("blue-button");
                    }
                }
            });

        }
    });

}

$(document).on('click', '#closebtn', function () {
    let masterTable = $("#mastercrmDiv");
    let offcanvasData = $("#offcanvas");
    let mixhide_dropdown = $("#mixhide_dropdown");

    if (offcanvasData.css('display') === "flex") {
        masterTable.css('display', 'none');
        mixhide_dropdown.css('display', 'none');
    } else {
        masterTable.css('display', 'block');
    }

})

