var $m = jQuery.noConflict();
//global declaration to use it anywhere
var dataValue;

//searching function for tables
(function () {
    'use strict';

    var TableFilter = (function () {
        var Arr = Array.prototype;
        var input;

        function onInputEvent(e) {
            input = e.target;
            var table1 = document.getElementsByClassName(input.getAttribute('data-table'));
            Arr.forEach.call(table1, function (table) {
                Arr.forEach.call(table.tBodies, function (tbody) {
                    Arr.forEach.call(tbody.rows, filter);
                });
            });
        }

        function filter(row) {
            var text = row.textContent.toLowerCase();
            //console.log(text);
            var val = input.value.toLowerCase();
            //console.log(val);
            row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
        }

        return {
            init: function () {
                var inputs = document.getElementsByClassName('table-filter');
                Arr.forEach.call(inputs, function (input) {
                    input.oninput = onInputEvent;
                });
            }
        };

    })();

    /*console.log(document.readyState);
      document.addEventListener('readystatechange', function() {
          if (document.readyState === 'complete') {
        console.log(document.readyState);
              TableFilter.init();
          }
      }); */

    TableFilter.init();
})();

function ajaxStatToConfig(dataObj) {
    $.ajax({
        url: '../action/statistics_config.php',
        type: 'POST',
        data: dataObj,
        dataType: 'JSON',
        success: function (response) {
            console.log(response);
            var dtValueArr = dataValue.split("|");
            var fltr = dtValueArr[2];
            var dtKey = dtValueArr[0];
            // console.log(fltr+" "+dtKey);
            createCustomTable(fltr, dtKey,response['finalResp']);
        }
    });
}

// const mainElement = document.querySelector('main');
//userName div selection
var userName = $m('#userNameP').html();

secRespFlDiv = $m('#secRespFilterDiv');
secRespFlDiv.on('click', function (e) {
    if ($m(e.target).is('a')) {
        dataValue = $m(e.target).data('value');
        // console.log (userName);
        dataObj = {};
        if (dataValue != null) {
            dataObj = {
                data: dataValue,
                user: userName,
            }
            // console.log(dataObj);
            ajaxStatToConfig(dataObj);
        }
    }
})
//for PRO
proFlDiv = $m('#proFilterDiv');
proFlDiv.on('click', function (e) {
    if ($m(e.target).is('a')) {
        dataValue = $m(e.target).data('value');
        // console.log (userName);
        dataObj = {};
        if (dataValue != null) {
            dataObj = {
                data: dataValue,
                user: userName,
            }
            // console.log(dataObj);
            ajaxStatToConfig(dataObj);
        }
    }
})