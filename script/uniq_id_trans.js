$(function () {
    $('#btn_uniq_id').on('click', function (e) {
        e.preventDefault();
        var id = document.getElementById('offcanvas_uniq_id').innerText;
        var C_name=document.getElementById('offcanvas_client_name').innerText;
        var C_state=document.getElementById('offcanvas_client_state').innerText;
        var C_city=document.getElementById('offcanvas_client_city').innerText;
        var C_code=document.getElementById('offcanvas_code').innerText;

        let data = {
            id: id,
            clientName:C_name,
            clientState:C_state,
            clientcity:C_city,
            clientCode:C_code
        }
        console.log("data",data);
        $.ajax({
            url: "../action/crm_config_pro_table.php",
            type: "POST",
            data: data,
            success: function (response) {
                window.location.href = "../action/pro_workable.php";
                //console.log(response);
            }
        })
    });

})

