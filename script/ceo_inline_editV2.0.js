function inlineEdit(button) {
    var InlineBtnTxt = $("#inline_edit_button").text();
    var Ceo_master_td = $("td");
    var th_txt;
    var clientUId;

    if (InlineBtnTxt == "Inline Edit Enable") {
        $("#inline_edit_button").html("Inline Edit Disable");
        let Ceo_master_ths = $('#ceo_master_table th');
        let sp_TdClsList = ["Client_Detailstd", "first_resp", "Resp_2", "Resp_3"];

        for (let i = 1; i < Ceo_master_td.length; i++) {
            let shouldAddEditable = true;

            for (let j = 0; j < sp_TdClsList.length; j++) {
                if (Ceo_master_td[i].classList.contains(sp_TdClsList[j])) {

                    if (sp_TdClsList[j] == "Client_Detailstd") {
                        let tdDiv = $(Ceo_master_td[i]);

                        $(Ceo_master_td[i]).find('.clientDD-content').remove();

                        let containerDiv = $('<div>').addClass('clientDD-content');
                        tdDiv.append(containerDiv);

                        let anchorTag = $(Ceo_master_td[i]).find('a');
                        anchorTag.addClass('editClient');
                        anchorTag.removeAttr('onclick');
                        $(tdDiv).on('click', '.editClient', function (event) {
                            event.preventDefault();
                            editClient(Ceo_master_td, i, containerDiv);
                        });
                        shouldAddEditable = false;
                    }
                    else {
                        var presentName = Ceo_master_td[i].innerText;
                        Ceo_master_td[i].innerText = '';

                        // Create a new select element
                        let select = $('<select>', {
                            class: 'selectName',
                            accessKey: i
                        }).append($('<option>', {
                            value: presentName,
                            text: presentName,
                            selected: true
                        }));

                        // Prepare the data for the AJAX request
                        var value = {
                            name_data: presentName,
                            action_name: "send present value"
                        };

                        $.ajax({
                            url: "../action/MasterTableDD_Config.php",
                            type: "POST",
                            data: value,
                            dataType: "JSON",
                            success: function (response) {
                                // Populate the select element with options based on the response
                                $.each(response, function (j, option) {
                                    $('<option>', {
                                        value: option.name,
                                        text: option.name
                                    }).appendTo(select);
                                });

                                // Append the new dropdown to the table cell
                                Ceo_master_td[i].appendChild(select[0]);

                                // Set up event handlers for the select element
                                $('#ceo_master_table .selectName').on('click', function () {
                                    // Click event functionality
                                    presVal = this.value; // Store the current value
                                }).on('change', function () {
                                    // Change event functionality
                                    updatedVal = this.value;
                                    var select_tdElement = $(this).parent();
                                    var clientUId = select_tdElement.attr('value');
                                    var columnIndex = select_tdElement.index();
                                    var headerName = Ceo_master_ths[columnIndex].accessKey;
                                    console.log("presVal", presVal, 'updatedVal', updatedVal, 'clientUId', clientUId, 'headerName', headerName);
                                    var values = {
                                        orig_Text: presVal,
                                        current_Text: updatedVal,
                                        header_col: headerName,
                                        clientUId: clientUId,
                                        action_title: "Update present value"
                                    };

                                    $.ajax({
                                        url: "../action/MasterTableDD_Updt.php",
                                        type: "POST",
                                        data: values,
                                        dataType: "JSON",
                                        success: function (response) {
                                            // console.log(response);
                                        }
                                    });
                                });
                            },
                            error: function (xhr, status, error) {
                                console.error("An error occurred during the AJAX request:", error);
                            }
                        });
                        shouldAddEditable = false;
                    }

                }
            }

            if (shouldAddEditable) {
                $(Ceo_master_td[i]).addClass("editable");
            }

        }

        var EditableCells = document.querySelectorAll('.editable');

        for (var i = 0; i < EditableCells.length; i++) {
            EditableCells[i].onclick = function () {
                let InlineBtnTxt = document.getElementById("inline_edit_button").innerHTML;
                if (this.hasAttribute('data-clicked')) {
                    return;
                }
                if (InlineBtnTxt == "Inline Edit Disable") {
                    //getting particular header name with accesskey
                    var th = $('#ceo_master_table th').eq($(this).index());
                    th_txt = th.attr('accessKey');
                    clientUId = $(this).attr('value');

                    // make all cell clickable or editable
                    this.setAttribute('data-clicked', 'yes');
                    this.setAttribute('data-text', this.innerHTML);


                    // create textarea and insert into td
                    var textarea = document.createElement('textarea');
                    textarea.value = this.innerText;

                    if (this.classList.contains("Remarkstd")) {
                        textarea.style.width = "200px";
                        textarea.style.height = "300px";
                    } else {
                        textarea.style.width = this.offsetWidth - (this.clientLeft * 2) + "px";
                        textarea.style.height = this.offsetHeight - (this.clientTop * 2) + "px";
                    }
                    textarea.style.overflow = "auto";
                    textarea.style.border = "0px";
                    textarea.style.fontSize = 'inherit';
                    textarea.style.textAlign = "left";
                    textarea.style.backgroundColor = "transparent";
                    textarea.style.resize = "none"; // disable the textarea resize functionality
                    console.log("textarea", textarea.value); // log the textarea value

                    textarea.onblur = function () {
                        var tdElement = textarea.parentElement;
                        var orig_text = textarea.parentElement.getAttribute('data-text').trim();
                        var current_text = this.value;

                        if (orig_text != current_text || orig_text === "") {
                            //if there are changes in the cell's text the save to db with Ajax

                            tdElement.removeAttribute('data-clicked');
                            tdElement.removeAttribute('data-text');
                            tdElement.innerHTML = current_text;
                            tdElement.style.cssText = 'padding: 8px;';

                            var value = {
                                orig_Text: orig_text,
                                current_Text: current_text,
                                header_col: th_txt,
                                clientUId: clientUId,
                            }
                            // console.log("value:", value);
                            $.ajax({
                                url: "../action/inline_edit_config.php",
                                type: "POST",
                                data: value,
                                dataType: "JSON",
                                success: function (response) {
                                    console.log("Inline editing Response", response);
                                }
                            });
                        } else {
                            tdElement.removeAttribute('data-clicked');
                            tdElement.removeAttribute('data-text');
                            tdElement.innerHTML = current_text;
                            tdElement.style.cssText = 'padding: 8px;';
                        }
                    }
                    this.innerHTML = '';
                    this.style.cssText = 'padding:0px 0px';
                    this.append(textarea);
                    this.firstElementChild.select();
                }
                else {

                    for (let i = 1; i < Ceo_master_td.length; i++) {
                        Ceo_master_td[i].classList.remove("editable");
                        Ceo_master_td[i].removeAttribute("style");
                        Ceo_master_td[i].removeAttribute('data-clicked');
                    }
                }
            }
        }

    }
    else if (InlineBtnTxt == "Inline Edit Disable") {
        for (let i = 1; i < Ceo_master_td.length; i++) {
            let htmltext = Ceo_master_td[i];

            let selectElement = htmltext.querySelector('.selectName');
            let client = htmltext.classList.contains("Client_Detailstd");
            if (selectElement) {
                removeSelect(selectElement, Ceo_master_td, i);
            }
            if (client) {
                remClientEdit(Ceo_master_td, i);
            }

            remvEditfunctionality(Ceo_master_td, i);
        }
        document.getElementById("inline_edit_button").innerHTML = "Inline Edit Enable";
    }
}


function editClient(Ceo_master_td, i, containerDiv) {
    let tdDiv = $(Ceo_master_td[i]);

    // console.log('display', containerDiv.css('display'));

    if (containerDiv.css('display') === 'none' || containerDiv.css('display') === '') {
        containerDiv.css('display', 'block');
        containerDiv.html('');
        let parentTd = tdDiv.closest('.Client_Detailstd');
        let tdValue = parentTd.attr('value');

        createFormEle(containerDiv, tdValue);

        // Append the container div to the clientDDIv                                
        var editval = {
            clientid: tdValue,
            editClient: "edit client details"
        }
        console.log('editClient', editval);
        $.ajax({
            url: "../action/mas_crmClientEdit.php",
            type: "POST",
            data: editval,
            dataType: "JSON",
            success: function (response) {
                $('#nameInput' + tdValue).val(response.name);
                $('#stateInput' + tdValue).val(response.state);
                $('#codeInput' + tdValue).val(response.code);
            }
        });

        $('body').on('click', '#DDsubBtn', function (e) {
            e.preventDefault();
            let ddValue = {
                name: $('#nameInput' + tdValue).val(),
                state: $('#stateInput' + tdValue).val(),
                code: $('#codeInput' + tdValue).val(),
                clientid: tdValue,
                client_ddUpdate: "update the client details"
            }
            $.ajax({
                url: "../action/MasterTableDD_Updt.php",
                type: "POST",
                data: ddValue,
                dataType: "JSON",
                success: function (response) {
                    location.reload();

                }
            })
        })

    } else {
        containerDiv.css('display', 'none');
    }
    return containerDiv;

}
function createFormEle(containerDiv, tdValue) {
    const statesData = [
        { code: "", name: "Choose.." },
        { code: "AN", name: "Andaman and Nicobar Islands" },
        { code: "AP", name: "Andhra Pradesh" },
        { code: "AR", name: "Arunachal Pradesh" },
        { code: "AS", name: "Assam" },
        { code: "BR", name: "Bihar" },
        { code: "CG", name: "Chhattisgarh" },
        { code: "CH", name: "Chandigarh" },
        { code: "DD", name: "Daman and Diu" },
        { code: "DN", name: "Dadra & Nagar Haveli" },
        { code: "DL", name: "Delhi" },
        { code: "GA", name: "Goa" },
        { code: "GJ", name: "Gujarat" },
        { code: "HP", name: "Himachal Pradesh" },
        { code: "HR", name: "Haryana" },
        { code: "JH", name: "Jharkhand" },
        { code: "JK", name: "Jammu and Kashmir" },
        { code: "KA", name: "Karnataka" },
        { code: "KL", name: "Kerala" },
        { code: "LA", name: "Ladakh" },
        { code: "LD", name: "Lakshadweep" },
        { code: "MH", name: "Maharashtra" },
        { code: "ML", name: "Meghalaya" },
        { code: "MN", name: "Manipur" },
        { code: "MP", name: "Madhya Pradesh" },
        { code: "MZ", name: "Mizoram" },
        { code: "NL", name: "Nagaland" },
        { code: "OR", name: "Orissa/ Odisha" },
        { code: "PB", name: "Punjab" },
        { code: "PY", name: "Pondicherry/ Puducherry" },
        { code: "RJ", name: "Rajasthan" },
        { code: "SK", name: "Sikkim" },
        { code: "TG", name: "Telangana" },
        { code: "TN", name: "Tamil Nadu" },
        { code: "TR", name: "Tripura" },
        { code: "UK", name: "Uttarakhand" },
        { code: "UP", name: "Uttar Pradesh" },
        { code: "WB", name: "West Bengal" },
        { code: "NP", name: "Nepal" }
    ];

    containerDiv.append($('<span>').text('name : '))
        .append($('<input>').attr({ type: 'text', placeholder: 'name:', 'class': 'clientDDInputs', id: 'nameInput' + tdValue }))
        .append('<br>');
    containerDiv.append($('<span>').text('code : '))
        .append($('<input>').attr({ type: 'text', placeholder: 'code:', 'class': 'clientDDInputs', id: 'codeInput' + tdValue }))
        .append('<br>');
    const optionsHtml = statesData.map(state => `<option value="${state.code}">${state.name}</option>`).join('');

    containerDiv.append(`<span>state : </span><select class="clientDDInputs" id="stateInput${tdValue}">${optionsHtml}</select><br>`);

    let button = $('<input>').addClass('clientDDInputs').attr({ id: 'DDsubBtn', type: "button" }).val('Submit');
    containerDiv.append(button);
    return containerDiv;
}
function removeSelect(selectElement, Ceo_master_td, i) {
    let selectedOption = selectElement.options[selectElement.selectedIndex].value;
    let textNode = document.createTextNode(selectedOption);
    Ceo_master_td[i].innerText = "";
    Ceo_master_td[i].appendChild(textNode);
    return 0;
}
function remClientEdit(Ceo_master_td, i) {
    let anchorTag = $(Ceo_master_td[i]).find('a');
    anchorTag.removeClass('editClient');
    let parentTd = $(Ceo_master_td[i]).closest('.Client_Detailstd');
    let uniqId = parentTd.attr('value');
    $(Ceo_master_td[i]).find('a').attr('onclick', 'client_id_input(' + uniqId + ');');
    $(Ceo_master_td[i]).find('.clientDD-content').remove();
}
function remvEditfunctionality(Ceo_master_td, i) {
    Ceo_master_td[i].classList.remove("editable");
    Ceo_master_td[i].removeAttribute('onclick');
    Ceo_master_td[i].removeAttribute("style");
    Ceo_master_td[i].removeAttribute('data-clicked');
    return 0;
}


