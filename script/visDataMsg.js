
var msgDiv = document.getElementById('dbInsertMsg');
var msg = document.createElement('div');

function successMsg() {
    alert("The data has been saved and uploaded successfully!");
    setTimeout(function () {
        window.close();
    }, 5000);
}
function unsuccessMsg() {
    alert("The data has been saved successfully but not uploaded!");
    setTimeout(function () {
        window.close();
    }, 5000);
}
function dbnaMsg() {
    alert("The data has not been saved or uploaded successfully!");
    setTimeout(function () {
        window.close();
    }, 5000);
}

