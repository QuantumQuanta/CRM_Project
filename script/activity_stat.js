// function activity_status(val1,loginT,empid,empname,dateTime) 
// {
//   var value = {
//     dataElem: val1.innerText,
//     empId: empid,
//     empName: empname,
//     date_time: dateTime,
//     loginTime:loginT
//   }
//   // console.log("activity_status emp",empname,"empid",empid);
//   // console.log("value", value);
//   console.log("loginT", loginT);
//   document.getElementById('btnData').innerHTML = val1.innerHTML;
//   document.getElementById("emp_stat-b").style.display = "none";

//   $.ajax({
//     url: "../action/active_stat_config.php",
//     type: "POST",
//     data: value,
//     dataType: "JSON",
//     success: function (data) {
//       console.log("Response_data" +data.dataElem+" "+data.empId);
//     }
//   });
// }


var checkInterval = setInterval(function () {
  checkActivity();
}, 10000);

function checkActivity() {
  $.ajax({
    url: '../constant/userActivityfn.php',
    type: 'post',
    data: 'type=ajax',
    success: function (response) {
      // console.log(response);
      if (response === 'activity_check') {
        window.location.href = '../action/activity_status.php';
        // console.log(response);
      }
    }

  });
}
//stops checking when the user navigates away or logs out
$(window).on('beforeunload', function () {
  clearInterval(checkInterval);
});
