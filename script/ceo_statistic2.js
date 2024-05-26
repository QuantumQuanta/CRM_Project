var $l = jQuery.noConflict();

const btn1 = $l('#dropDownbtn1');
const btn2 = $l('#dropDownbtn2');

const div1Ele = $l('#respWiseDropdown');
const div2Ele = $l('#clntWiseDropdown');
const tblHd_resp = $l('#tblHd_resp');
const tblHd_clnt = $l('#tblHd_clnt');
const respiplbl = $l('#respiplbl')
const clntiplbl = $l('#clntiplbl');

function showFunction1() {
    $l("#respWiseDropdown").toggleClass("show");
    var respDiv = $l("#respWiseFilterdiv");
    if (respDiv.css('display') === 'none') {
        respDiv.css('display', 'block');
    }
    else if (respDiv.css('display') === "block") {
        respDiv.css('display', 'none');
    }

    if ((btn1.val() === "off") && (btn2.val() === "off")) {
        //action
        btn1.prop('disabled', false);
        btn2.prop('disabled', true);
        //value change
        btn1.val("on");
        btn2.val("off");
    }
    else if ((btn1.val() === "on") && (btn2.val() === "off")) {
        //action
        btn1.prop('disabled', false);
        btn2.prop('disabled', false);
        //value change
        btn1.val("off");
        btn2.val("off");
        respiplbl.css('display', 'none');
    }
    else {
        console.log("Error from showFunction1! Both buttons are ON")
    }

}
function showFunction2() {
    $l("#clntWiseDropdown").toggleClass("show");
    var clntDiv = $l("#clntWiseFilterdiv");
    if (clntDiv.css('display') === 'none') {
        clntDiv.css('display', 'block');
    }
    else if (clntDiv.css('display') === 'block') {
        clntDiv.css('display', 'none');
    }

    if ((btn2.val() === "off") && (btn1.val() === "off")) {
        //action
        btn2.prop('disabled', false);
        btn1.prop('disabled', true);
        //value change
        btn2.val('on');
        btn1.val('off');
    }
    else if ((btn2.val() === "on") && (btn1.val() === "off")) {
        //action
        btn2.prop('disabled', false);
        btn1.prop('disabled', false);
        //value change
        btn1.val('off');
        btn2.val('off');

        clntiplbl.css('display', 'none');
    }
    else {
        console.log("Error from showFunction2! Both buttons are ON")
    }

}

function filterFunction() {
    var input, filter, ul, li, a, i;
    input = $l("#respWiseInput");
    filter = input.val().toUpperCase();
    div = $l("#respWiseDropdown");
    a = div.find("a");
    a.each(function () {
        var txtValue = $(this).text();
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}
function filterFunction1() {
    var input, filter, ul, li, a, i;
    input = $l("#clntWiseInput");
    filter = input.val().toUpperCase();
    div = $l("#clntWiseDropdown");
    a = div.find("a");
    a.each(function () {
        var txtValue = $(this).text();
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

//to show selected option by user to user

div1Ele.on('click', 'a', function () {
    var dtVal1 = $l(this).attr('data-value');
    var splitGetDsg = dtVal1.split("|");
    // var dtArr = e.target.textContent.split("|");
    // var dtDsg = dtArr[1];

    // tblHd_resp.innerText = "for :" + dtVal1;
    // console.log(dtVal1);
    if(splitGetDsg[1] ==="PRO"){
        $("#pcr_prcID").css('display','none');
    }else{
        $("#pcr_prcID").css('display','block');
    }
    respiplbl.html(dtVal1);
    tblHd_resp.css('display', 'none');
    respiplbl.css('display', 'block');


});
div2Ele.on('click', 'a', function () {

    var dtVal2 = $l(this).attr('data-value');
    var dtArr = $l(this).text().split("-");
    var dtName = dtArr[0];
    // tblHd_clnt.innerText = "for :" + dtVal2;
    // console.log(dtVal2);
    clntiplbl.html(dtVal2 + "|" + dtName);
    tblHd_clnt.css('display', 'none');
    clntiplbl.css('display', 'block');



});

