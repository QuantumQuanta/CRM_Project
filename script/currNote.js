function dataRetriAjax(dataObject){
    $.ajax({
        url: '../action/currNoteConfig.php',
        type: 'POST',
        data: dataObject,
        dataType: 'JSON',
        success: function (data) {
            
            if(jQuery.type(data) === 'array'){
                // console.log('data is an array!');
                dataFormatting(data);
            }else if(jQuery.type(data) === 'object'){
                console.error(data.error);
            }
        }
    })
}


function dataFormatting(dataArray) {
    $('#currentNoteData').empty();
    
    dataArray.forEach(function (element) {
        var splitValues = element.split('|');
        let $para = $('<p>',{
            id:''
        });
        let $editBtn = $('<button>',{
            text: 'EDIT',
            id:'currEditNoteBtn',
        });
        let $delBtn = $('<button>',{
            text: 'DELETE',
            id:'currDelNoteBtn',
        })
        $para.text(splitValues[1] + ': ' + splitValues[2]+'\n');
        $('#currentNoteData').append($para);
        $('#currentNoteData').append($editBtn);
        $('#currentNoteData').append($delBtn);
    });
    $('#currEditNoteBtn').on('click', function(){
        var data={
            action: "edit",
            clnt_id: clntid,
            resp_name: rspUN,
            dT:dateTime,
        }
        dataRetriAjax(data);
    });
    $('#currDelNoteBtn').on('click', function(){
        var data={
            action: "delete",
            clnt_id: clntid,
            resp_name: rspUN,
            dT:dateTime,
        }
        dataRetriAjax(data);
    });
}



$(document).ready(function () {
    if ($('#offcanvas_uniq_id_2').length > 0) {
        var observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.type === 'childList') {
                    var labelText = $('#offcanvas_uniq_id_2').text().trim();
                    if (labelText !== '') {
                        //default ajax for current note
                        var rspUN = $('#respUname').val();
                        var clntid = $('#offcanvas_uniq_id_2').text();
                        var defaultNoteData = {
                            default: "action",
                            clnt_id: clntid,
                            resp_name: rspUN,
                        }
                        $.ajax({
                            url: '../action/currNoteConfig.php',
                            type: 'POST',
                            data: defaultNoteData,
                            dataType: 'JSON',
                            success: function (data) {
                                // console.log(data);
                                // $('#currentNoteData').html(data);
                                
                                if(jQuery.type(data) === 'array'){
                                    // console.log('data is an array!');
                                    dataFormatting(data);
                                }else if(jQuery.type(data) === 'object'){
                                    console.error(data.error);
                                }
                            }
                        })

                    }
                }
            });
        });
        var observerConfig = { childList: true };
        
        observer.observe(document.getElementById('offcanvas_uniq_id_2'), observerConfig);
    }
    else {
        console.warn('404:Label Element not found!');
    }


    //After adding a new current note
    $('#currentNoteBtn').on('click', function (e) {
        e.preventDefault();
        var ClntID = $('#offcanvas_uniq_id_2').text();
        var ClntNote = $('#currentNote').val();
        var respUname = $('#respUname').val();
        // console.log(ClntID);
        $('#currentNote').val('');

        // Disable the button for 2 seconds
        $('#currentNoteBtn').prop('disabled', true);
        setTimeout(function () {
            $('#currentNoteBtn').prop('disabled', false);
        }, 4000);

        var DTOBJ = {
            ID: ClntID,
            NOTE: ClntNote,
            RESPNAME: respUname,
        }
        $.ajax({
            url: '../action/currNoteConfig.php',
            type: 'POST',
            data: DTOBJ,
            dataType: 'JSON',
            success: function (data) {
                
                if(jQuery.type(data) === 'array'){
                    // console.log('data is an array!');
                    dataFormatting(data);
                }else if(jQuery.type(data) === 'object'){
                    console.error(data.error);
                }
            }
        })
    });
    
});





