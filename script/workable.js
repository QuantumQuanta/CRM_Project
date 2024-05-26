var $q = jQuery.noConflict();

$(document).ready(function () {



    if (window.location.pathname.indexOf('/pro_workable') !== -1) {

        var param_clID = $q('#client_uniq_id_trans').val();
        var param_uName = $q('#pro_name').val();
        var param_uDesg = $q('#proDesg').val();
        workableDTRetri(param_uName, param_clID, param_uDesg);
        worktbleAjax(param_clID, "pro_show_data");

        $q('#submit_pro_input').on('click', function () {

            var proInput = {
                token1: 'insertPRO',
                contact_stat: $q('#contact_stat').val(),
                kyc_stat: $q('#kyc_stat').val(),
                call_stat: $q('#call_stat').val(),
                call_type: $q('#call_type').val(),
                category: $q('#category').val(),
                source: $q('#source').val(),
                pcr_priority_1: $q('#pcr_priority_1').val(),
                pcr_et_1: $q('#pcr_et_1').val(),
                client_stat_1: $q('#client_stat_1').val(),
                pcr_resp_1: $q('#pcr_resp_1').val(),
                pcr_pt_1: $q('#pcr_pt_1').val(),
                client_rating_1: $q('#client_rating_1').val(),
                date_time_1: $q('#date_time_1').val(),
                pro_name: $q('#pro_name').val(),
                client_uniq_id_trans: $q('#client_uniq_id_trans').val(),
                comment_1: $q('#comment_1').val()
            }
            $q('#submit_pro_input').prop('disabled', true);

            setTimeout(function () {
                $q('#submit_pro_input').prop('disabled', false);
            }, 8000);
            $q.ajax({
                url: '../action/workable_input_config.php',
                type: 'POST',
                data: proInput,
                dataType: 'JSON',
                success: function (response) {
                    $q('#submit_pro_input').html("SUCCESS!");
                    buildWorkTble(response, "pro_show_data");
                }
            });


        });
    }
    else if (window.location.pathname.indexOf('/2ndresp_workable') !== -1) {
        var param_clID = $q('#client_uniq_id_trans_2').val();
        var param_uName = $q('#secresp_name').val();
        var param_uDesg = $q('#respDesg').val();
        workableDTRetri(param_uName, param_clID, param_uDesg);
        worktbleAjax(param_clID, "secresp_show_data");

        $q('#submit_2resp_input').on('click', function () {

            var respInput = {
                token2: 'insertRESP',
                client_stat_2: $q('#client_stat_2').val(),
                pcr_resp_2: $q('#pcr_resp_2').val(),
                pcr_pt_2: $q('#pcr_pt_2').val(),
                pcr_prc: $q('#pcr_prc').val(),
                client_rating_2: $q('#client_rating_2').val(),
                date_time_2: $q('#date_time_2').val(),
                secresp_name: $q('#secresp_name').val(),
                client_uniq_id_trans_2: $q('#client_uniq_id_trans_2').val(),
                comment_2: $q('#comment_2').val(),
            }

            $q('#submit_2resp_input').prop('disabled', true);

            setTimeout(function () {
                $q('#submit_2resp_input').prop('disabled', false);
            }, 8000);

            console.log(respInput);
            $q.ajax({
                url: '../action/workable_input_config.php',
                type: 'POST',
                data: respInput,
                dataType: 'JSON',
                success: function (response) {
                    $q('#submit_2resp_input').html("SUCCESS!");
                    buildWorkTble(response, "secresp_show_data");
                }
            });
        });
    }
    else {
        console.log(new Error("Unknown URL!"));
    }
});

var workableDTRetri = ((userName, clientUID, userDesg) => {
    var rqstData = {
        userName: userName,
        clientUID: clientUID,
        userDesg: userDesg
    }
    $.ajax({
        url: '../action/workableEaseData.php',
        type: 'POST',
        data: rqstData,
        dataType: 'JSON',
        success: function (response) {
            setPreData(response);
        }
    })

});

function worktbleAjax(param_clID, tblId) {
    workableTbl = {
        token: 'docLoad',
        client_uniq_id: param_clID,
    }
    $.ajax({
        url: '../action/workableTblDt.php',
        type: 'POST',
        data: workableTbl,
        dataType: 'JSON',
        success: function (response) {
            buildWorkTble(response, tblId)
        }
    });

}

var setPreData = ((dataObj) => {
    if (dataObj["desgCode"] == "PRO") {
        $.each(dataObj, function (key, value) {
            $q('#' + key).val(value);
        });
    }
    else if (dataObj["desgCode"] == "2RESP") {
        $.each(dataObj, function (key, value) {
            $q('#' + key).val(value);
        });
    }
});

function buildWorkTble(response, tblId) {

    var tbody = $q("<tbody>");
    $q("#" + tblId + " tbody").empty();
    $q.each(response, function (index, mixed_res) {
        var row = $q("<tr>").append(
            $q('<td>').text(mixed_res.dt).addClass(''),
            $q('<td>').text(mixed_res.contacted_us).addClass(''),
            $q('<td>').text(mixed_res.kyc_stat).addClass(''),
            $q('<td>').text(mixed_res.pcr_priority).addClass(''),
            $q('<td>').text(mixed_res.pcr_et).addClass(''),
            $q('<td>').text(mixed_res.call_type).addClass('call_type'),
            $q('<td>').text(mixed_res.call_stat).addClass(''),
            $q('<td>').text(mixed_res.category).addClass(''),
            $q('<td>').text(mixed_res.source).addClass(''),
            $q('<td>').text(mixed_res.comment_1).addClass('comment_1'),
            $q('<td>').text(mixed_res.client_stat_1).addClass('client_stat_1'),
            $q('<td>').text(mixed_res.pcr_resp_1).addClass(''),
            $q('<td>').text(mixed_res.pcr_pt_1).addClass(''),
            $q('<td>').text(mixed_res.client_rating_1).addClass(''),
            $q('<td>').text(mixed_res.comment_2).addClass('comment_2'),
            $q('<td>').text(mixed_res.client_stat_2).addClass('client_stat_2'),
            $q('<td>').text(mixed_res.pcr_resp_2).addClass(''),
            $q('<td>').text(mixed_res.pcr_pt_2).addClass(''),
            $q('<td>').text(mixed_res.pcr_prc).addClass(''),
            $q('<td>').text(mixed_res.client_rating_2).addClass(''),

        );
        tbody.append(row);
    });
    $q("#" + tblId).append(tbody);
}