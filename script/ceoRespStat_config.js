var $j = jQuery.noConflict();
var dataVal;

const eleDiv1 = $j('#respWiseFilterdiv');
const checkLbl1 = $j('#respiplbl');
const eleDiv2 = $j('#clntWiseFilterdiv');
const checkLbl2 = $j('#clntiplbl');

function ajaxToConfig(dt) {
    $j.ajax({
        url: '../action/ceoStatDT_config.php',
        type: 'POST',
        data: dt,
        dataType: 'JSON',
        success: function (response) {
            // console.log(response);
            var dtValArr = dataVal.split("|");
            var ceoFltr = dtValArr[2];
            var ceoDtKey = dtValArr[0];
            // console.log(ceoFltr+" "+ceoDtKey);
            createCustomTable(ceoFltr, ceoDtKey,response['finalResp']);
        }
    });
}

eleDiv1.on('click', function (e) {
    if ($j(e.target).is('a')) {
        if (checkLbl1.html() != "") {
            // console.log("a tag in #respWiseFilterdiv and also label has a selected name");
            dataVal = $j(e.target).data('value');
            var whoseDT = checkLbl1.text();
            // console.log(dataVal+whoseDT);
            dataObj = {
                data: dataVal,
                userName: whoseDT,
            }
            ajaxToConfig(dataObj);
            // console.log(dataObj);
        }
        else {
            console.log("a tag in #respWiseFilterdiv");
        }
    }
    // console.log("a tag in #respWiseFilterdiv");


});

eleDiv2.on('click', function (e) {
    // console.log("a tag in #respWiseFilterdiv");
    if ($j(e.target).is('a')) {
        if (checkLbl2.html() != "") {
            // console.log("a tag in #clntWiseFilterdiv and also label has a selected name");
            dataVal = $j(e.target).data('value');
            var whoseDT = checkLbl2.text();
            // console.log(dataVal+whoseDT);

            dataObj = {
                data: dataVal,
                userName: whoseDT,
            }
            ajaxToConfig(dataObj);
            // console.log(dataObj);
        }
        else {
            console.log("a tag in #clntWiseFilterdiv");
        }
    }


});