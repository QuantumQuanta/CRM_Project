function uniq_id_input(input_val) {
    var value = {
        uniq_id: input_val,
    };
    //console.log(value);
    //$.session.set("uniq_id", input_val);
    $.ajax({
        url: "../action/crm_config.php",
        type: "POST",
        data: value,
        dataType: "JSON",
        success: function (data) {
            //console.log(data.client_name);
            $('#offcanvas_client_name').html(data.client_name);
            $('#offcanvas_client_contact').html(data.client_contact);
            $('#offcanvas_client_email').html(data.client_email);
            $('#offcanvas_client_state').html(data.client_state);
            $('#offcanvas_client_city').html(data.client_city);
            $('#offcanvas_code').html(data.code);
            $('#offcanvas_reference').html(data.reference);
            $('#offcanvas_category').html(data.category);
            $('#offcanvas_doa_1').html(data.doa_1);
            $('#offcanvas_1st_resp').html(data.first_resp);
            $('#offcanvas_doa_2').html(data.doa_2);
            $('#offcanvas_2nd_resp').html(data.second_resp);
            $('#offcanvas_doa_3').html(data.doa_3);
            $('#offcanvas_3rd_resp').html(data.third_resp);
            $('#offcanvas_uniq_id').html(data.uniq_id);

            //document.getElementById('input_client_uniq_id').value = data.uniq_id;
        }

    })
}


