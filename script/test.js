/*$('#click_me').on('click', function (e) {
    e.preventDefault();
    var data_id = {
        id: "1",
    };
    $.ajax({
        url: '../action/test.php',
        data: data_id,
        type: 'POST',
        dataType: 'JSON',
        success: function (array_data) {
            console.log(array_data);
        }
    })

})*/
$(document).ready(function () {
    $('#ok').on('click', function (e) {
        e.preventDefault();
        let data = {
            resp1: $('#resp').val,
            doc: $('#doc').val,
            client_name: $('#client_name').val,
        }
        $.ajax({
            url: '../action/test3.php',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                if (response) {
                    alert('Success! for PRO');
                }
            }
        })
    })

    $('#ok2').on('click', function (e) {
        e.preventDefault();
        let data = {
            resp2: $('#resp_2').val,
            doc2: $('#doc_2').val,
            client_state: $('#client_state').val,
        }
        $.ajax({
            url: '../action/test3.php',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                if (response) {
                    alert('Success! for 2ndResp');
                }
            }
        })
    })
})


//function to clear up the dropdown items
function removeChild(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild)
    }
}


$('#respWise').on('click', function () {
    // const respondentBtn = document.getElementById('respWise');
    const selectBox = document.getElementById('select_respWise');
    const dropDown = document.getElementById('dd_respWise');
    if (selectBox.hasChildNodes()) {
        removeChild(selectBox);
        dropDown.style.display = 'none';
    }
    else {
        data1 = {
            val1: '1',
        }
        $.ajax({
            url: '../action/ceo_stat_config.php',
            type: 'POST',
            data: data1,
            dataType: 'JSON',
            success: function (response) {
                // console.log(response);
                var arr = [];
                i = 0;
                var listFopt = document.createElement('option');
                listFopt.textContent = 'Choose..';
                listFopt.setAttribute('selected', 'selected');
                selectBox.appendChild(listFopt);
                response.forEach(function (e) {
                    arr = e.split('|');
                    var userUNIQId = arr[0];
                    var userName = arr[1];
                    var userDesgCode = arr[2];
                    var userList = document.createElement('option');
                    userList.textContent = userName + '(' + userDesgCode + ')';
                    userList.value = userName;
                    selectBox.appendChild(userList);
                });
                // console.log(a);
                dropDown.style.display = 'block';
            }
        })
    }

})

$('#clientWise').on('click', function () {
    const selectBox2 = document.getElementById('select_clWise');
    const dropDown2 = document.getElementById('dd_clWise');
    if (selectBox2.hasChildNodes()) {
        removeChild(selectBox2);
        dropDown2.style.display = 'none';
    }
    else {
        data2 = {
            val2: '1',
        }
        $.ajax({
            url: '../action/ceo_stat_config2.php',
            type: 'POST',
            data: data2,
            dataType: 'JSON',
            success: function (response) {
                // console.log(reponse);
                var arr1 = [];
                i = 0;
                var listFOpt2 = document.createElement('option');
                listFOpt2.textContent = 'Choose..';
                listFOpt2.setAttribute('selected', 'selected');
                selectBox2.appendChild(listFOpt2);
                response.forEach(function (e) {
                    arr1 = e.split('|');
                    var clUNIQId = arr1[0];
                    var clName = arr1[1];
                    var clContact = arr1[2];
                    var userList = document.createElement('option');
                    userList.textContent = clName + '-' + clContact;
                    userList.value = clUNIQId;
                    selectBox2.appendChild(userList);
                });
                // console.log(a);
                dropDown2.style.display = 'block';
            }
        });
    }
});




$('#select_respWise').change(function () {
    var selectedOpt = $(this).val();
    if (selectedOpt) {
        var userNameEle = document.getElementById('userNameP');
        userNameEle.innerHTML = selectedOpt;
    }
    else {
        console.log('Oops!Not an dropdown option!');
    }
})

$('#select_clWise').change(function(){
    
})