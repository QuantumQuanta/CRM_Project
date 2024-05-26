$(document).ready(function () {
    var idArr = [];
    var idArr2 = [];
    // var checkArr = [];
    //var ceoTableCheckbox = document.getElementsByClassName('action_cl');

    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var ceoTableCheckboxAll = document.getElementById('actionAll');

    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', () => {
            // Check if at least one checkbox is checked
            if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
                // Show the button if at least one checkbox is checked
                document.getElementById('tableFnDiv').style.display = "block";
                //document.getElementById('submit_del').style.display = "block";
            } else {
                // Hide the button if no checkbox is checked
                document.getElementById('tableFnDiv').style.display = "none";
                // document.getElementById('submit_del').style.display = "none";
            }
        });
    }
    $(ceoTableCheckboxAll).on('change', function (e) {
        e.preventDefault();
        if (this.checked) {
            document.getElementById('tableFnDiv').style.display = "block";
            // document.getElementById('submit_del').style.display = "block";
        }
        else {
            //console.log("Checkbox is not checked.");
            document.getElementById('tableFnDiv').style.display = "none";
            // document.getElementById('submit_del').style.display = "none";
        }
    });

    // Get the modal
    var modal = document.getElementById("edit_div");//
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    $('#submit_edt').on('click', function (e) {
        e.preventDefault();
        $.each($("input[name='action_uniq_id[]']:checked"), function () {
            idArr.push($(this).val());
        });
        //console.log("Your selected ids: "+idArr.join(", "));
        // document.getElementById('edit_div').style.display = 'block';
        modal.style.display = "block";
    });
    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    $('#edit_client_save').on('click', function (e) {
        e.preventDefault();

        var edit_values = {
            uniqId: idArr,
            doc: $('#editDOC').val(),
            doa1: $('#editDOA1').val(),
            strPeriod: $('#str_period').val(),
            endPeriod: $('#end_period').val(),
            code: $('#editCode').val(),
            clientName: $('#editClientName').val(),
            clientState: $('#editClientState').val(),
            clientContact: $('#editClientContact').val(),
            bcr: $('#editBCR').val(),
            verified: $('#editVerified').val(),
            pcr: $('#editPCR').val(),
            proName: $('#edit1Resp').val(),
            doa2: $('#editDOA2').val(),
            secName: $('#edit2Resp').val(),
            doa3: $('#editDOA3').val(),
            thrName: $('#edit3Resp').val(),
            remarks: $('#editRemarks').val()
        };
        // console.log(edit_values);

        $("#editDOC").val("dd-mm-yyyy");
        $("#editDOA1").val("dd-mm-yyyy");
        $('#str_period').val("dd-mm-yyyy");
        $('#end_period').val("dd-mm-yyyy");
        $('#editCode').val('');
        $('#editClientName').val('');
        $('#editClientState').val('selectedIndex', 0);
        $('#editClientContact').val('');
        $('#editBCR').val('');
        $('#editVerified').val('');
        $('#editPCR').val('');
        $('#edit1Resp').val('');
        $('#editDOA2').val('');
        $('#edit2Resp').val('');
        $('#editDOA3').val('');
        $('#edit3Resp').val('');
        $('#editRemarks').val('');
        modal.style.display = "none";
        $.ajax({
            url: '../action/multiple_edit_ceo_config.php',
            type: 'POST',
            data: edit_values,
            dataType: 'JSON',
            success: function (response) {
                console.log("edit table",response);
                
                // $('#tableCont').load('../action/master_crm.php #tableCont');
                
            }

        });window.location.reload(true); 
    });

    $('#submit_del').on('click', function (e) {
        e.preventDefault();
        $.each($("input[name='action_uniq_id[]']:checked"), function () {
            idArr2.push($(this).val());
        });
        delIdVal = {
            uniqId2: idArr2,
        };
        console.log(delIdVal);
        let answer = confirm("Do you want to proceed with irreversable deletion?");
        //console.log(answer);
        if (answer) {
            $.ajax({
                url: '../action/delete_client.php',
                type: 'POST',
                data: delIdVal,
                dataType: 'JSON',
                success: function (response) {
                    // alert(response);
                    document.location.reload(true);
                    // $('#tableCont').load('../action/master_crm.php #tableCont');
                }
            });
        }
    });
});