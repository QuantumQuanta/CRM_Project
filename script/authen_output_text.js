function blankUserMsg() {
    //alert("Username can't be blank!");
    var blkUsrMsg = "Username can't be blank!";
    document.getElementById('authen_msg_area').innerHTML = blkUsrMsg;
}
function blankPassMsg() {
    //alert("Password can't be blank!");
    var blkPssMsg = "Password can't be blank!";
    document.getElementById('authen_msg_area').innerHTML = blkPssMsg;
}
function invalidCredMsg() {
    //alert("Invalid Credentials!");
    var invCrdMsg = "Invalid Credentials!";
    document.getElementById('authen_msg_area').innerHTML = invCrdMsg;
}
function saveMsgPro() {
    document.getElementById('save_msg').textContent ='Data inserted successfully';
    
}
function saveMsgSecresp() {
    document.getElementById('save_msg2') = e;
    if (e.innerHTML === "Data Submission Pannel:") {
        e.innerHTML = "Entry saved successfully";
    }
}