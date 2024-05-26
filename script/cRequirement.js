$n = jQuery.noConflict();
function createULFromArray(dataArray) {
    var ul = $n('<ul>');
    var i = 1;
    dataArray.forEach(function (item) {

        var itemData = item.split('|');
        var li = $n('<li>');
        var checkbox = $n('<input type="checkbox">');
        var btn = $n('<button>').text('Edit').addClass('cReqEditBtn');
        btn.attr('data-value',item);
        var span = $n('<span>').text(i + " : " + itemData[2] + " " + itemData[3] + " " + itemData[4] + " " + itemData[6]);
        li.append(span);
        li.append("<br>");
        li.append(checkbox);
        li.append(btn);
        ul.append(li);
        ul.append("<br>");
        i++;
    },);
    $n("#c_REQ").empty();
    // Append the ul to the body or any other container element
    $n('#c_REQ').append(ul);
}


$n(document).ready(function () {

    $n("#subBtnCREQ").click(function () {
        // Retrieve values from input fields
        var creqFormData = {
            keyData: "SubBtn",
            creq_priority: $n("#prioritySel").val(),
            creq_proposalSharedOn: $n("#proposalSharedOn").val(),
            creq_proposalDetails: $n("#proposalDetails").val(),
            creq_proposalSite: $n("#proposalSite").val(),
            creq_proposalState: $n("#proposalState").val(),
            creq_quote: $n("#quote").val(),
            creq_currency: $n("#currency").val(),
            creq_fsaDetails: $n("#fsaDetails").val(),
            creq_client: $n("#cReqClientID").text(),
            creq_ownRemarks: $n("#ownRemarks").val(),
            creq_throughName:$n("#throughName").val(),
        }
        // console.log(creqFormData);
        $n('#subBtnCREQ').prop('disabled', true);

        setTimeout(function () {
            $n('#subBtnCREQ').prop('disabled', false);
        }, 8000);

        $("#prioritySel").val($("#prioritySel option:first").val());
        $n("#proposalSharedOn").val('');
        $n("#proposalDetails").val('');
        $n("#proposalSite").val('');
        $n("#proposalState").val($("#proposalState option:first").val());
        $n("#quote").val('');
        $("#currency").val($("#currency option:first").val());
        $n("#fsaDetails").val('');
        $n("#ownRemarks").val('');

        $.ajax({
            url: "../action/cReq_config.php",
            type: "POST",
            data: creqFormData,
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                createULFromArray(response);
                $n("#subBtnCREQ").html("SUCCESS!");
                setTimeout(function () {
                    $n('#subBtnCREQ').html('SUBMIT');
                }, 3000);
            }
        })


    });

    //C-Req Edit
    $n('#c_REQ').on('click', '.cReqEditBtn', function () {
        // Your code to handle the click event
        var dataValue = $n(this).data('value');
        var dataArr = dataValue.split("|");
        var modal = $n('#creqEditDiv');
        var btn = $n('.cReqEditBtn');
        var span = $n('#creqEditDivClose');

        modal.css('display', 'block');

        span.click(function () {
            modal.css('display', 'none');
        });

        $n(window).click(function (event) {
            if (event.target === modal[0]) {
                modal.css('display', 'none');
            }
        });
        // console.log(dataValue);
        // console.log(dataArr);
        $n('#prioritySelEdit').val(dataArr[2]);
        $n('#proposalSharedOnEdit').val(dataArr[3]);
        $n('#proposalDetailsEdit').val(dataArr[4]);
        $n('#proposalSiteEdit').val(dataArr[5]);
        $n('#proposalStateEdit').val(dataArr[6]);
        $n('#quoteEdit').val(dataArr[7]);
        $n('#currencyEdit').val(dataArr[8]);
        $n('#fsaDetailsEdit').val(dataArr[10]);
        $n('#ownRemarksEdit').val(dataArr[9]);     
        $n('#dateForEdit').val(dataArr[0]);
    });

    $n('#subBtnCREQEdit').on('click', function(){
        var creqEditFormData = {
            keyData: "EditBtn",
            creEdit_preDate:$n('#dateForEdit').val(),
            creqEdit_priority: $n("#prioritySelEdit").val(),
            creqEdit_proposalSharedOn: $n("#proposalSharedOnEdit").val(),
            creqEdit_proposalDetails: $n("#proposalDetailsEdit").val(),
            creqEdit_proposalSite: $n("#proposalSiteEdit").val(),
            creqEdit_proposalState: $n("#proposalStateEdit").val(),
            creqEdit_quote: $n("#quoteEdit").val(),
            creqEdit_currency: $n("#currencyEdit").val(),
            creqEdit_fsaDetails: $n("#fsaDetailsEdit").val(),
            creqEdit_client: $n("#cReqEditClientID").text(),
            creqEdit_ownRemarks: $n("#ownRemarksEdit").val(),
            creqEdit_throughName: $n("#editThroughname").val(),
        }
        $n('#subBtnCREQEdit').prop('disabled', true);

        setTimeout(function () {
            $n('#subBtnCREQEdit').prop('disabled', false);
        }, 8000);
        // console.log(creqEditFormData);
        $("#prioritySelEdit").val($("#prioritySelEdit option:first").val());
        $n("#proposalSharedOnEdit").val('');
        $n("#proposalDetailsEdit").val('');
        $n("#proposalSiteEdit").val('');
        $n("#proposalStateEdit").val($("#proposalStateEdit option:first").val());
        $n("#quoteEdit").val('');
        $("#currencyEdit").val($("#currencyEdit option:first").val());
        $n("#fsaDetailsEdit").val('');
        $n("#ownRemarksEdit").val('');

        //Edit data Ajax
        $.ajax({
            url: "../action/cReq_config.php",
            type: "POST",
            data: creqEditFormData,
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                createULFromArray(response);
                $n("#subBtnCREQEdit").html("SUCCESS!");
                setTimeout(function () {
                    $n('#subBtnCREQEdit').html('EDIT');
                }, 3000);
            }
        })
    });
});








