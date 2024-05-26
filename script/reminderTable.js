$p = jQuery.noConflict();
$p(document).ready(function () {
    var load_Tblval = {
        userid: $p("#userid").val(),
        user_name: $p("#user_name").val(),
        userUnqId: $p("#userUnqId").val()
    };

    $p.ajax({
        url: '../action/reminTble_config.php',
        type: 'post',
        data: load_Tblval,
        dataType: 'JSON',
        success: function (response) {
            // console.log(response);
            buildTable(response);

        }
    });

    $p("#submit_remine_input").on("click", function (event) {
        var rem_data = {
            userid: $p("#userid").val(),
            user_name: $p("#user_name").val(),
            remin_dT: $p("#remin_dT").val(),
            priority: $p("#priority").val(),
            remType: $p("#remType").val(),
            rem_title: $p("#rem_title").val(),
            rem_details: $p("#rem_details").val(),
            sherewith: $p("#sherewith").val(),
            userUnqId: $p("#userUnqId").val()
        };
        // console.log('rem_data', rem_data);
        if ($p("#remin_dT").val() && $p("#rem_title").val() && $p("#rem_details").val()) {
            event.preventDefault();
            $("#errorText").empty();
            $p.ajax({
                url: "../action/reminTble_config.php",
                type: "POST",
                data: rem_data,
                dataType: "JSON",
                success: function (response) {
                    // console.log(response);
                    buildTable(response);
                    $p("#myForm").css("display", "none");
                    $p("#userid").val('');
                    $p("#remin_dT").val('');
                    $p("#priority").val(null).trigger('change');
                    $p("#remType").val(null).trigger('change');
                    $p("#rem_title").val('');
                    $p("#rem_details").val('');
                    $p("#sherewith").val(null).trigger('change'); // Reset and trigger change event
                    $p("#selectedItems").text('Selected items:');
                }
            });
        } else {
            let errorText = "** Datetime, Subject, and Description, fields are mandatory. **";
            $("#errorText").empty().text(errorText);

        }

    });

    function buildTable(response) {
        rem_res = response.data;
        remLoop = response.rem_rowNum;

        var table1 = $("<table>").addClass("table_thead2");
        var table2 = $("<table>").addClass("table_thead2");
        var m = 0, n = 0;
        for (let i = 0; i < remLoop; i++) {
            if (rem_res['userid' + i] == load_Tblval.userid) {
                var row1 = buildDataRow(rem_res, i, m)
                m++;
            } else {
                var sharewith = rem_res['sharewith' + i];
                var user_name = $('#user_name').val();
                // console.log(sharewith.search(user_name));
                if (sharewith.search(user_name) != -1) {
                    var row2 = buildDataRow(rem_res, i, n);
                } else {
                    var row2 = buildDataRow(rem_res, i, n);
                }
                n++;
            }
            table1.append(row1);
            table2.append(row2);
        }
        if (m == 0) {
            let rowM = buildEmptyRow()
            table1.append(rowM);
        }
        if (n == 0) {
            let rowN = buildEmptyRow();
            table2.append(rowN);
        }
        $("#rem_table1").empty().append(table1);
        $("#rem_table2").empty().append(table2);

        //reminder search using calender date
        const daysList = document.querySelector(".days");
        const dataTable = document.querySelector(".table_thead2");
        let previousClickedDay = null;
        daysList.addEventListener("click", function (event) {
            const clickedDay = event.target;

            if (!clickedDay.classList.contains("inactive")) {
                const selectedDate = clickedDay.getAttribute("data-value");
                // //console.log("selectedDate", selectedDate);

                if (previousClickedDay) {
                    previousClickedDay.classList.remove("clickactive");
                }
                clickedDay.classList.add("clickactive");
                previousClickedDay = clickedDay;

                var table1 = $("<table>").addClass("table_thead2");
                var table2 = $("<table>").addClass("table_thead2");
                var matchingReminders1 = [];
                var matchingReminders2 = [];

                for (let i = 0; i < remLoop; i++) {
                    if (rem_res['date' + i] == selectedDate && rem_res['userid' + i] == load_Tblval.userid) {
                        let row = pushRemData(rem_res, i);
                        matchingReminders1.push(row);
                    }
                    if (rem_res['date' + i] == selectedDate && rem_res['userid' + i] != load_Tblval.userid) {
                        let row = pushRemData(rem_res, i);
                        matchingReminders2.push(row);
                    }
                }

                matchingReminders1.sort(function (a, b) {
                    return a.time.localeCompare(b.time);
                });
                matchingReminders2.sort(function (a, b) {
                    return a.time.localeCompare(b.time);
                });
                if (matchingReminders1.length > 0) {
                    var m1 = 0;
                    for (let i = 0; i < matchingReminders1.length; i++) {
                        let row1 = searchDataRow(matchingReminders1, i, m1);
                        m1++;
                        table1.append(row1);
                    }
                    $("#rem_table1").empty().append(table1);
                } else {
                    let row1 = buildEmptyRow();
                    table1.append(row1);
                    $("#rem_table1").empty().append(table1);
                }
                if (matchingReminders2.length > 0) {
                    var n1 = 0;
                    for (let i = 0; i < matchingReminders2.length; i++) {
                        let row1 = searchDataRow(matchingReminders2, i, n1);
                        n1++;
                        table2.append(row1);
                    }
                    $("#rem_table2").empty().append(table2);
                } else {
                    let row1 = buildEmptyRow();
                    table2.append(row1);
                    $("#rem_table2").empty().append(table2);
                }
            }
        });


        var todaysReminders1 = [];
        var todaysReminders2 = [];
        var currentDate = new Date().toLocaleDateString('en-CA'); // Adjust 'en-CA' based on your locale
        // currentDate = '2023-12-01';
        for (var i = 0; i < remLoop; i++) {
            if (rem_res['date' + i] == currentDate && rem_res['bg_color' + i] == 'alert-info') {
                let container = pushTdayRemData(rem_res, i);
                todaysReminders1.push(container);
            }
            if (rem_res['date' + i] == currentDate && rem_res['bg_color' + i] == 'alert-danger') {
                let container = pushTdayRemData(rem_res, i);
                todaysReminders2.push(container);
            }
        }
        todaysReminders2.sort(function (a, b) {
            return a.time.localeCompare(b.time);
        });
        todaysReminders1.sort(function (a, b) {
            return a.time.localeCompare(b.time);
        });

        var remAlertContainer = $("<div>");
        buildTdayRem(todaysReminders2, remAlertContainer);
        buildTdayRem(todaysReminders1, remAlertContainer);
        $("#todayReminDiv").empty().append(remAlertContainer);
        document.querySelectorAll(".alert").forEach(function (alertElement) {
            alertElement.addEventListener('click', function () {
                let reminCardTexts = this.querySelectorAll(".reminCardText");

                reminCardTexts.forEach(function (reminCardText) {
                    // Toggle styles based on the current state
                    if (reminCardText.style.overflow === "visible") {
                        reminCardText.style.overflow = "hidden";
                        reminCardText.style.whiteSpace = "nowrap";
                        reminCardText.style.textOverflow = "ellipsis";
                    } else {
                        reminCardText.style.overflow = "visible";
                        reminCardText.style.whiteSpace = "normal";
                        reminCardText.style.textOverflow = "unset";
                    }
                });
            });
        });


    }
    function buildDataRow(rem_res, i, m) {
        let sharewith = rem_res['sharewith' + i];
        let user_name = $('#user_name').val();
        let load_userid = $p("#userid").val();
        var row1 = $("<tr>").append(
            $('<td>').text(m + 1).addClass('slTh'),
            $('<td>').text(rem_res['date_time' + i]).addClass('DandTTh clickable-td'),
            sharewith.search(user_name) != -1 || rem_res['userid' + i] == load_userid ?
                $('<td>').text(rem_res['rem_title' + i]).addClass('idTh clickable-td')
                :
                $('<td>').text('Busy schedule').addClass('idTh clickable-td'),
            sharewith.search(user_name) != -1 || rem_res['userid' + i] == load_userid ?
                $('<td>').text(rem_res['rem_details' + i]).addClass('reminTh clickable-td')
                :
                $('<td>').text('Busy schedule').addClass('reminTh clickable-td'),
            rem_res['userid' + i] == load_userid ? $('<td>').text(rem_res['sharewith' + i]).addClass('shareTh clickable-td') : $('<td>').text(rem_res['userOG_name' + i]).addClass('shareTh clickable-td'),
            $('<td>').html('<a href="delete_reminder.php?id=' + encodeURIComponent(rem_res['slNo' + i]) + '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are You Sure ?\')">Delete</a>').addClass('delTh')
        );
        return row1;
    }
    function searchDataRow(rem_res, i, m) {
        console.log('rem_res', rem_res);
        var sharewith = rem_res[i].sharewith;
        var user_name = $('#user_name').val();
        let searchUserid = $p("#userid").val();
        console.log('sharewith', searchUserid, rem_res[i].userid);
        // var j = 0;

        var searchRow = $("<tr>").append(
            $('<td>').text(m + 1).addClass('slTh'),
            $('<td>').text(rem_res[i].date_time).addClass('DandTTh clickable-td'),
            sharewith.search(user_name) != -1 || rem_res[i].userid == searchUserid ?
                $('<td>').text(rem_res[i].rem_title).addClass('idTh clickable-td')
                :
                $('<td>').text('Busy schedule').addClass('idTh clickable-td'),
            sharewith.search(user_name) != -1 || rem_res[i].userid == searchUserid ?
                $('<td>').text(rem_res[i].rem_details).addClass('reminTh clickable-td')
                :
                $('<td>').text('Busy schedule').addClass('reminTh clickable-td'),
            rem_res[i].userid == searchUserid ? $('<td>').text(rem_res[i].sharewith).addClass('shareTh clickable-td') : $('<td>').text(rem_res[i].userOG_name).addClass('shareTh clickable-td'),
            $('<td>').html('<a href="delete_reminder.php?id=' + encodeURIComponent(rem_res[i].slNo) + '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are You Sure ?\')">Delete</a>').addClass('delTh')
        );
        return searchRow;
    }
    function buildEmptyRow() {
        let row = $("<tr>").append(
            $('<td>').text("No Reminder").addClass('slTh'),
            $('<td>').text("No Reminder").addClass('DandTTh clickable-td'),
            $('<td>').text("No Reminder").addClass('idTh clickable-td'),
            $('<td>').text("No Reminder").addClass('reminTh clickable-td'),
            $('<td>').text("No Reminder").addClass('shareTh clickable-td'),
            $('<td>').text("").addClass('delTh')
        );
        return row;
    }
    function pushRemData(rem_res, i) {
        var row = {
            slNo: rem_res['slNo' + i],
            date_time: rem_res['date_time' + i],
            time: rem_res['time' + i],
            remType: rem_res['remType' + i],
            userid: rem_res['userid' + i],
            rem_title: rem_res['rem_title' + i],
            rem_details: rem_res['rem_details' + i],
            sharewith: rem_res['sharewith' + i],
            userOG_name: rem_res['userOG_name' + i]
        }
        return row;
    }
    function pushTdayRemData(rem_res, i) {
        var TdayContain = {
            slNo: rem_res['slNo' + i],
            userid: rem_res['userid' + i],
            bg_color: rem_res['bg_color' + i], // Fix: Use square brackets for array indexing
            date_time: rem_res['date_time' + i],
            time: rem_res['time' + i],
            rem_title: rem_res['rem_title' + i],
            rem_details: rem_res['rem_details' + i],
            sharewith: rem_res['sharewith' + i],
            userOG_name: rem_res['userOG_name' + i],
            remType: rem_res['remType' + i],
        }
        return TdayContain;
    }

    function buildTdayRem(todaysReminders, remAlertContainer) {
        for (var i = 0; i < todaysReminders.length; i++) {
            const rem_row = todaysReminders[i];
            var sharewith = rem_row.sharewith;
            var user_name = $('#user_name').val();
            let searchUserid = $p("#userid").val();

            const shareWithData = rem_row.userid == load_Tblval.userid ? '<b>Share with : </b>' + rem_row.sharewith + '<br>' : '<b>Share By : </b>' + rem_row.userOG_name + '<br>';
            const priority = rem_row.bg_color == 'alert-danger' ? ' Important! Reminder' : ' Reminder'
            let reminderDiv = $('<div>').addClass('alert alert-info ' + rem_row.bg_color + ' mb-3 pt-4 pb-4').attr('href', '#');
            // Append child elements to the div
            var row = reminderDiv.append(
                $('<i>').addClass('fa fa-bell').attr('aria-hidden', 'true'),
                priority,
                $('<p>').addClass('reminCardText').html(shareWithData),
                sharewith.search(user_name) != -1 || rem_row.userid == searchUserid ?
                    $('<p>').addClass('reminCardText').html('<b>Massage : </b>' + rem_row.rem_title + '<br>') :
                    $('<p>').addClass('reminCardText').html('<b>Massage : </b> Busy schedule <br>'),
                sharewith.search(user_name) != -1 || rem_row.userid == searchUserid ?
                    $('<p>').addClass('reminCardText').html('<b>Details : </b>' + rem_row.rem_details + '<br>') :
                    $('<p>').addClass('reminCardText').html('<b>Details : </b> Busy schedule <br>'),
                '<br>',
                $('<i>').addClass('fa-solid fa-business-time'),
                ' ' + rem_row.date_time
            );
            remAlertContainer.append(row);
        }
    }
    $('body').on('click', '.clickable-td', expandFunction);
    function expandFunction(event) {
        this.classList.toggle("expanded");
    }
});
