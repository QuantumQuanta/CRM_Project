$o = jQuery.noConflict();

function createULFromArray(dataArray) {

    var ul = $o('<ul>');
    var i = 1;
    dataArray.forEach(function (item) {


        var itemData = item.split('|');
        var li = $o('<li>');
        var checkbox = $o('<input type="checkbox">');
        var btn = $o('<button>').text('Edit').addClass('cReqEditBtn');
        btn.attr('data-value', item);
        var span = $o('<span>').text(i + " : " + itemData[2] + " " + itemData[3] + " " + itemData[4] + " " + itemData[6]);
        li.append(span);
        li.append("<br>");
        li.append(checkbox);
        li.append(btn);
        ul.append(li);
        ul.append("<br>");
        i++;
    },);
    $("#c_REQ").empty();
    // Append the ul to the body or any other container element
    $o('#c_REQ').append(ul);
}

function uniq_id_input_2(input_val_2) {
    var value_2 = {
        uniq_id_2: input_val_2,
    };
    //console.log(value);
    //$.session.set("uniq_id", input_val);
    $.ajax({
        url: "../action/crm_config2.php",
        type: "POST",
        data: value_2,
        dataType: "JSON",
        success: function (data) {
            //console.log(data.client_name);
            $o('#offcanvas_client_name_2').html(data.client_name);
            $o('#offcanvas_client_contact_2').html(data.client_contact);
            $o('#offcanvas_client_email_2').html(data.client_email);
            $o('#offcanvas_client_state_2').html(data.client_state);
            $o('#offcanvas_client_city_2').html(data.client_city);
            $o('#offcanvas_code_2').html(data.code);
            $o('#offcanvas_reference_2').html(data.reference);
            $o('#offcanvas_category_2').html(data.category);
            $o('#offcanvas_doa_1_2').html(data.doa_1);
            $o('#offcanvas_1st_resp_2').html(data.first_resp);
            $o('#offcanvas_doa_2_2').html(data.doa_2);
            $o('#offcanvas_2nd_resp_2').html(data.second_resp);
            $o('#offcanvas_doa_3_2').html(data.doa_3);
            $o('#offcanvas_3rd_resp_2').html(data.third_resp);
            $o('#offcanvas_uniq_id_2').html(data.uniq_id);
            $o('#cReqClientID').html(data.uniq_id + " : " + data.code + data.client_name + data.client_state);
            $o('#cReqEditClientID').html(data.uniq_id + " : " + data.code + data.client_name + data.client_state);
            $o('#editThroughname').val(data.first_resp);
            $o('#throughName').val(data.first_resp);
            //document.getElementById('input_client_uniq_id').value = data.uniq_id;
            // var ObjID = {
            //     clntIDresp: data.uniq_id,
            // };
            // var queryParam = $.param(ObjID);
            // Define the new URL
            // var newURL = "../action/c_requirement.php?" + queryParam;
            // $.get(newURL, function(data) {
            //     // Handle the response from the PHP script
            //     console.log("Response from PHP: " + data);
            // });
            // $o('#sub_cReqRESP').attr("href", newURL);

        }

    });

    //For Crequirement
    var creqData = {
        keyData: "DocLoad",
        creq_client: input_val_2,
    }
    $.ajax({
        url: "../action/cReq_config.php",
        type: "POST",
        data: creqData,
        dataType: "JSON",
        success: function (response) {
            // console.log(response);
            createULFromArray(response);
            // $n("#subBtnCREQ").html("SUCCESS!");
            // setTimeout(function() {
            //     $n('#subBtnCREQ').html('SUBMIT');
            // }, 3000);
        }
    });

}
$o(document).ready(function () {
    var modal = $o('#creqDiv');
    var btn = $o('#sub_cReqRESP');
    var span = $o('#creqDivClose');

    // Show modal when the button is clicked
    btn.click(function () {
        modal.css('display', 'block');
    });

    // Close modal when the close button is clicked
    span.click(function () {
        modal.css('display', 'none');
    });

    // Close modal when clicking outside the modal content
    $o(window).click(function (event) {
        if (event.target === modal[0]) {
            modal.css('display', 'none');
        }
    });
});