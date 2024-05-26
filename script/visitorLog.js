const radioButtons = document.querySelectorAll('input[type="radio"]');
function createInputElement(name, placeholder) {
    visDiv = document.getElementById('visidproofno');
    let visIdInput = document.createElement('input');
    visIdInput.type = 'text';
    visIdInput.placeholder = placeholder;
    visIdInput.name = name;
    visDiv.appendChild(visIdInput);
}
function createInputElementAss(name, placeholder) {
    visAssDiv = document.getElementById('visAssidproofno');
    let visAssIdInput = document.createElement('input');
    visAssIdInput.type = 'text';
    visAssIdInput.placeholder = placeholder;
    visAssIdInput.name = name;

    visAssDiv.appendChild(visAssIdInput);
}
function createInputElementExAss(name, placeholder) {
    exvisAssDiv = document.getElementById('exvisAssidproofno');
    let exvisAssIdInput = document.createElement('input');
    exvisAssIdInput.type = 'text';
    exvisAssIdInput.placeholder = placeholder;
    exvisAssIdInput.name = name;

    exvisAssDiv.appendChild(exvisAssIdInput);
}
radioButtons.forEach((radioButton) => {
    radioButton.addEventListener('click', () => {
        const selectedValue = radioButton.value;
        if (selectedValue === 'AADHAR CARD') {
            createInputElement('visaadharno[]', 'Aadhaar No.');
        }
        else if (selectedValue === 'VOTER CARD') {
            createInputElement('visvoterno[]', 'Voter No.');
        }
        else if (selectedValue === 'PAN CARD') {
            createInputElement('vispanno[]', 'PAN No.');
        }
        else if (selectedValue === 'DRIVING LICENCE') {
            createInputElement('visdlno[]', 'DL No.');
        }
        else if (selectedValue === 'PASSPORT') {
            createInputElement('vispassno[]', 'Passport No.');
        }
        else if (selectedValue === 'OTHER') {
            createInputElement('visother[]', 'Other No.');
        }
        else if (selectedValue === 'ASS AADHAR CARD') {
            createInputElementAss('visAssaadharno[]', 'Aadhaar No.');
        }
        else if (selectedValue === 'ASS VOTER CARD') {
            createInputElementAss('visAssvoterno[]', 'Voter No.');
        }
        else if (selectedValue === 'ASS PAN CARD') {
            createInputElementAss('visAsspanno[]', 'PAN No.');
        }
        else if (selectedValue === 'ASS DRIVING LICENCE') {
            createInputElementAss('visAssdlno[]', 'DL No.');
        }
        else if (selectedValue === 'ASS PASSPORT') {
            createInputElementAss('visAsspassno[]', 'Passport No.');
        }
        else if (selectedValue === 'ASS OTHER') {
            createInputElementAss('visAssother[]', 'Other No.');
        }
        else if (selectedValue === 'EX ASS AADHAR CARD') {
            createInputElementExAss('exvisAssaadharno[]', 'Aadhaar No.');
        }
        else if (selectedValue === 'EX ASS VOTER CARD') {
            createInputElementExAss('exvisAssvoterno[]', 'Voter No.');
        }
        else if (selectedValue === 'EX ASS PAN CARD') {
            createInputElementExAss('exvisAsspanno[]', 'PAN No.');
        }
        else if (selectedValue === 'EX ASS DRIVING LICENCE') {
            createInputElementExAss('exvisAssdlno[]', 'DL No.');
        }
        else if (selectedValue === 'EX ASS PASSPORT') {
            createInputElementExAss('exvisAsspassno[]', 'Passport No.');
        }
        else if (selectedValue === 'EX ASS OTHER') {
            createInputElementExAss('exvisAssother[]', 'Other No.');
        }
        else {
            console.log('Error!');
        }
    });
});

$('#newVisTrig').on('click', function (e) {
    e.preventDefault();
    newEntry = document.getElementById('new_entry').style.display;
    if (newEntry === 'none') {
        document.getElementById('new_entry').style.display = 'block';
        document.getElementById('exist_entry').style.display = 'none';
    }
    else if (newEntry === 'block') {
        document.getElementById('new_entry').style.display = 'none';
        document.getElementById('exist_entry').style.display = 'none';
    }
    else {
        alert('Error');
    }
})

$('#exVisTrig').on('click', function (e) {
    e.preventDefault();
    exiEntry = document.getElementById('exist_entry').style.display;
    if (exiEntry === 'none') {
        document.getElementById('exist_entry').style.display = 'block';
        document.getElementById('new_entry').style.display = 'none';
    }
    else if (exiEntry === 'block') {
        document.getElementById('exist_entry').style.display = 'none';
        document.getElementById('new_entry').style.display = 'none';
    }
    else {
        alert('Error');
    }
})
