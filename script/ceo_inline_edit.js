// final inline editing by click on the button
function inlineEdit(button) {
    var InlineBtnTxt = document.getElementById("inline_edit_button").innerHTML;
    var Ceo_master_td = document.getElementsByTagName("td");
    var th_txt;
    var clientUId;


    if (InlineBtnTxt == "Inline Edit Enable") {

        document.getElementById("inline_edit_button").innerHTML = "Inline Edit Disable";
        let table = document.getElementById('ceo_master_table');
        var Ceo_master_ths = table.getElementsByTagName('th');

        let sp_TdClsList = ["Client_Detailstd", "first_resp", "Resp_2", "Resp_3"];


        for (let i = 1; i < Ceo_master_td.length; i++) {
            let shouldAddEditable = true;

            for (let j = 0; j < sp_TdClsList.length; j++) {
                if (Ceo_master_td[i].classList.contains(sp_TdClsList[j])) {
                    if (sp_TdClsList[j] == "Client_Detailstd") {
                        shouldAddEditable = false;
                        break;
                    } else {
                        var presentName = Ceo_master_td[i].innerText;
                        Ceo_master_td[i].innerText = '';

                        // Create a new select element
                        let select = document.createElement('select');
                        let parentTr = Ceo_master_td[i].parentNode;
                        // parentTr.setAttribute('onclick', `yourFunction('yourValue')`);

                        select.className = 'selectName';

                        let initialOption = document.createElement('option');
                        initialOption.value = presentName;
                        initialOption.text = presentName;

                        select.appendChild(initialOption);
                        initialOption.setAttribute('selected', 'selected');
                        select.setAttribute('accessKey', i);


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
                                for (let j = 0; j < response.length; j++) {
                                    let opt = document.createElement('option');
                                    opt.value = response[j].name;
                                    opt.text = response[j].name;
                                    select.appendChild(opt);
                                }

                                // Append the new dropdown to the table cell
                                Ceo_master_td[i].appendChild(select);

                                var SelectCells = document.querySelectorAll('#ceo_master_table select');

                                // let only exsist inside the block and var available throughout the function in which they’re declared
                                var presVal = null, updatedVal = null;
                                SelectCells.forEach(function (selectElement) {
                                    selectElement.addEventListener('click', function () {
                                        // Click event functionality
                                        // console.log("Select element clicked:", this.value);
                                        presVal = this.value; // Store the current value
                                    });

                                    selectElement.addEventListener('change', function () {
                                        // Change event functionality
                                        updatedVal = this.value;
                                        var select_tdElement = this.parentElement;
                                        var clientUId = select_tdElement.getAttribute('value');
                                        var columnIndex = select_tdElement._DT_CellIndex['column']
                                        var headerName = Ceo_master_ths[columnIndex].accessKey;
                                        // console.log("Select element changed:", this.value);
                                        // Now, this.value holds the updated value
                                        console.log("presVal", presVal, 'updatedVal', updatedVal, 'clientUId', clientUId, 'headerName', headerName);
                                        var values = {
                                            orig_Text: presVal,
                                            current_Text: updatedVal,
                                            header_col: headerName,
                                            clientUId: clientUId,
                                            action_title: "Update present value"
                                        }
                                        // console.log('Header Name:', values);
                                        $.ajax({
                                            url: "../action/MasterTableDD_Updt.php",
                                            type: "POST",
                                            data: values,
                                            dataType: "JSON",
                                            success: function (response) {
                                                // console.log(response);
                                            }
                                        })
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
                Ceo_master_td[i].classList.add("editable");
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
                    // console.log("index", $(this));

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
                        // var orig_text = textarea.parentElement.getAttribute('data-text');
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
    } else if (InlineBtnTxt == "Inline Edit Disable") {


        for (let i = 1; i < Ceo_master_td.length; i++) {
            let selectElement = Ceo_master_td[i].querySelector('select');
            if (selectElement) {
                let selectedOption = selectElement.options[selectElement.selectedIndex].value;
                let textNode = document.createTextNode(selectedOption);
                Ceo_master_td[i].innerText = "";
                Ceo_master_td[i].appendChild(textNode);
            }

            Ceo_master_td[i].classList.remove("editable");
            Ceo_master_td[i].removeAttribute('onclick');
            Ceo_master_td[i].removeAttribute("style");
            Ceo_master_td[i].removeAttribute('data-clicked');
        }
        document.getElementById("inline_edit_button").innerHTML = "Inline Edit Enable";
    }
}
