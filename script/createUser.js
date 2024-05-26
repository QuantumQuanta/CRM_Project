// function createUser(){

//     // const fileInput = document.getElementById('userPic');
//     // const file = fileInput.files[0];
//     console.log("clicked!");
//     // let createUserData = {
//     //     firstName:
//     //     lastName:
//     //     desgCode:
//     //     contactNo:
//     //     mailId:
//     //     userNameId:
//     //     pass:
//     //     userPic:file
//     // }
// }


// for choose fie
function displayFileName() {
    const fileInput = document.getElementById('userPic');
    const customFileLabel = document.querySelector('.-customfile-label');
    if (fileInput.files.length > 0) {
        // Display the selected file name            
        customFileLabel.textContent = fileInput.files[0].name;
    } else { // If no file selected, show the default label            
        customFileLabel.textContent = 'Choose file';
    }
}

// $('#nuSubBtn').on('click', function (e) {
//     e.preventDefault();
//     // console.log("clicked!");
//     const fileInput = document.getElementById('userPic');
//     const file = fileInput.files[0];
//     // console.log(file);
//     // let createUserData = {
//     //     firstName: $('#userfirstName').val(),
//     //     lastName: $('#userlastName').val(),
//     //     desgCode: $('#userDesgCode').val(),
//     //     contactNo: $('#userContactNo').val(),
//     //     mailId: $('#userEmailId').val(),
//     //     userNameId: $('#userUniqueId').val(),
//     //     pass: $('#userPass').val(),
//     // }
//     var data = new FormData();
//     for(var i=0;i<file.length;i++){
//         data.append(imageData,file[i]);
//     }
//     // console.log(createUserData);
//     $('#userfirstName').val('');
//     $('#userlastName').val('');
//     $('#userDesgCode').val('');
//     $('#userContactNo').val('');
//     $('#userEmailId').val('');
//     $('#userUniqueId').val('');
//     $('#userPass').val('');
//     $('#userPic').val('');

//     $.ajax({
//         url: '../action/new_user_config.php',
//         type: 'POST',
//         data: data,
//         dataType: 'JSON',
//         contentType: false,
//         processData: false,
//         success: function(response){
//             console.log(response);
//         }
//     });

// })