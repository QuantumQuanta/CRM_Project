/*function editDetails(client_unqid) {
    const uniqId = document.querySelectorAll(".edt_cl");
    for (var i = 0; i < uniqId.length; i++) {
        console.log('uniqId: ', uniqId[i]);
    }
    /*
    var idValue = {
        client_unqid: client_unqid,
    };
    console.log(client_unqid);
    $.ajax({
        url: '../action/edit_client_details_config.php',
        type: "POST",
        data: idValue,
        dataType: "JSON",
        success: function (data) {
            $('#editDOC').val(data.doc);
            $('#editDOA1').val(data.doa_1)
            $('#editPeriod').val(data.period);
            $('#editCode').val(data.code);
            $('#editClientName').val(data.client_name);
            $('#editClientState').val(data.client_state);
            $('#editClientContact').val(data.client_contact);
            $('#editBCR').val(data.bcr);
            $('#editVerified').val(data.verified);
            $('#editPCR').val(data.pcr);
            $('#edit1Resp').val(data.first_resp);
            $('#editDOA2').val(data.doa_2);
            $('#edit2Resp').val(data.second_resp);
            $('#editDOA3').val(data.doa_3)
            $('#edit3Resp').val(data.third_resp);
            $('#editRemarks').val(data.remarks);
            $('#client_uniq_id').val(data.uniq_id);
        }
    })
}*/
$(document).ready(function () {
    $('#submit_edt').on('click', function (e) {
        var checkboxArray = [];
        var checkboxes = document.getElementsByName('edt_uniq_id[]');
        for (var i = 0;i < checkboxes.length;i++){
            if(checkboxes[i].checked){
                checkboxArray.push(checkboxes[i].value);
            }
        }
        document.getElementById('edit_uniq_ids').value = checkboxArray;
        e.preventDefault();
        document.getElementById('editModal').style.display = 'block';
    })
})