$(document).ready(function () {
    // Get the current URL
    var currentUrl = window.location.pathname;

    if (currentUrl.indexOf('/crm') !== -1) {
        responsive("pro_client_table");
        // console.log("from PRO");
    }
    if (currentUrl.indexOf('/crm2') !== -1) {
        responsive("secresp_client_table");
        // console.log("from 2RESP");
    }
    // Check if the URL contains a specific string
    
    function responsive(id) {
        new DataTable('#' + id, {
            scrollX: true,
            scrollY: 250,
            stateSave: true,
        });
        $('#' + id).on('click', 'td', function () {
            $(this).toggleClass('expanded');
        });
    }
    

    
});


// $(document).ready(function () {
//     // Get the current URL
//     var currentUrl = window.location.pathname;

//     // Check if the URL contains a specific string
//     if (currentUrl.includes("/crm")) {
//         responsive("pro_client_table");
//         // console.log("from PRO");
//     } 
//      if (currentUrl.includes("/crm2")) {
//         responsive("secresp_client_table");
//         // console.log("from 2RESP");
//     }

//     function responsive(id) {
//         new DataTable('#' + id, {
//             scrollX: true,
//             scrollY: 250
//         });
//         $('#' + id).on('click', 'td', function () {
//             $(this).toggleClass('expanded');
//         });
//     }
// });


// $(document).ready(function () {
//     // Get the current URL
//     var currentUrl = window.location.pathname;

//     // Check if the URL contains a specific string
//     if (currentUrl.includes("/crm")) {

//         responsive("pro_client_table");


//     } else if (currentUrl.includes("/crm2")) {
//             responsive("secresp_client_table");

//     }
//     function responsive(id) {

//         new DataTable('#' + id, {
//             scrollX: true,
//             scrollY: 250
//         });
//         document.getElementById(id).addEventListener('click', function (event) {
//             if (event.target.tagName === 'TD') {
//                 event.target.classList.toggle('expanded');
//             }
//         });
//     }
// })



// $(document).ready(function () {
//     new DataTable('#secresp_client_table', {
//         scrollX: true,
//         scrollY: 250
//     });
//     document.getElementById('secresp_client_table').addEventListener('click', function (event) {
//         if (event.target.tagName === 'TD') {
//             event.target.classList.toggle('expanded');
//         }
//     });
// })
