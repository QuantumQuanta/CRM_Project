
$(function () {
    $('#btn_uniq_id_2').on('click', function (e) {
        e.preventDefault();
        var id2 = document.getElementById('offcanvas_uniq_id_2').innerText;
        var C_name2=document.getElementById('offcanvas_client_name_2').innerText;
        var C_state2=document.getElementById('offcanvas_client_state_2').innerText;
        var C_city2=document.getElementById('offcanvas_client_city_2').innerText;
        var C_code2=document.getElementById('offcanvas_code_2').innerText;
        var data = {
            id2: id2,
            clientName2:C_name2,
            clientState2:C_state2,
            clientcity2:C_city2,
            clientCode2:C_code2
        }
        console.log("data",data);
        $.ajax({
            url: "../action/crm_config_2ndresp_table.php",
            type: "POST",
            data: data,
            success: function (response) {
                window.location.href = "../action/2ndresp_workable.php";
                //console.log(response);
            }
        })
    });

})