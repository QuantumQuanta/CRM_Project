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
//   // console.log("loginT", loginT);
//   document.getElementById('btnData').innerHTML = val1.innerHTML;
//   document.getElementById("emp_stat-b").style.display = "none";
  
//   $.ajax({
//     url: "../action/ headerActiveStat_Config.php",
//     type: "POST",
//     data: value,
//     dataType: "JSON",
//     success: function (data) {
//       console.log("Response_data" +data.dataElem+" "+data.empId);
//     }
//   });
// }
function activity_status(val1, loginT, empid, empname, dateTime) {
  // var value = {
  //     dataElem: val1.innerText,
  //     empId: empid,
  //     empName: empname,
  //     date_time: dateTime,
  //     loginTime: loginT
  // }
  console.log("activity_status emp", loginT,empname);
  // console.log("value", value);
  // console.log("loginT", loginT);
  // document.getElementById('btnData').innerHTML = val1.innerHTML;
  // document.getElementById("emp_stat-b").style.display = "none";

  // $.ajax({
  //   url: "../action/UserCurrStat_config.php",
  //   type: "POST",
  //   data: value,
  //   dataType: "JSON",
  //   success: function (data) {
  //     console.log("Response_data" +data.dataElem+" "+data.empId);
  //   }
  // });
}