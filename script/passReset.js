$y = jQuery.noConflict();


$y(document).ready(function () {
    var errMsgLbl_0 = $y('#forprePass');
    var errMsgLbl_1 = $y('#fornewPass');
    var errMsgLbl_2 = $y('#forcnewPass');
    var response_para = $y('#responseP');
    var countdown = 5;

    $y("#passResetSubBtn").prop("disabled", true);

    $y('#passFAQ').on('click', function () {
        alert("Your new 10-character password should contain minimum->\n 1. One special character[!@#$%^&*]\n 2. One Upper Case Letter\n 3. One digit");
    });

    $y('#newPass').on('input', function () {
        var inputPass = $y(this).val();
        // console.log(inputPass);

        if (inputPass.length != 0) {
            var match_regex = /^(?=.*[!@#$%^&*])(?=.*[A-Z])(?=.*\d).{10,}$/;

            if (!match_regex.test(inputPass)) {
                errMsgLbl_1.text("Weak Password! not accepted");
                errMsgLbl_1.css('color', 'red');
                errMsgLbl_1.css('display', 'block');
                $y("#passResetSubBtn").prop("disabled", true)
            }
            else {
                errMsgLbl_1.text("Strong Password! accepted");
                errMsgLbl_1.css('color', 'green');
                errMsgLbl_1.css('display', 'block');
                $y("#passResetSubBtn").prop("disabled", false);
            }
        } else {
            errMsgLbl_1.css('display', 'none');
            $y("#passResetSubBtn").prop("disabled", true)
        }
    });

    $y('#cnewPass').on('input', function () {
        var newPass = $y('#newPass').val();
        var cnewPass = $y(this).val();

        if (cnewPass.length != 0) {
            if (newPass === cnewPass) {
                errMsgLbl_2.text('Password matched!');
                errMsgLbl_2.css('color', 'green');
                errMsgLbl_2.css('display', 'block');
                $y("#passResetSubBtn").prop("disabled", false);
            }
            else {
                errMsgLbl_2.text('Password not matching!');
                errMsgLbl_2.css('color', 'red');
                errMsgLbl_2.css('display', 'block');
                $y("#passResetSubBtn").prop("disabled", true)
            }
        }
        else {
            errMsgLbl_2.css('display', 'none');
            $y("#passResetSubBtn").prop("disabled", true)
        }

    });
    $y('#prePass').on('input', function () {
        var prePass = $y('#prePass').val();
        if ($.trim(prePass) === '') {
            errMsgLbl_0.text("Previous password can't be blank !");
            errMsgLbl_0.css('color', 'red');
            errMsgLbl_0.css('display', 'block');
        }
        else {
            errMsgLbl_0.text("");
            errMsgLbl_0.css('display', 'none');
        }
    })

    $y('#passResetSubBtn').on('click', function () {
        var prePass = $y('#prePass').val();
        var newPass = $y('#newPass').val();
        var cnewPass = $y('#cnewPass').val();
        var userid = $y('#userIDIn').val();
        if ($.trim(prePass) === '') {
            errMsgLbl_0.text("Previous password can't be blank !");
            errMsgLbl_0.css('color', 'red');
            errMsgLbl_0.css('display', 'block');
        }
        else {
            errMsgLbl_0.css('display', 'none');
            var passData = {
                prePass: $.trim(prePass),
                newPass: $.trim(newPass),
                cnewPass: $.trim(cnewPass),
                userid: $.trim(userid),
            }
            console.log(passData);

            $y('#prePass').val('');
            $y('#newPass').val('');
            $y('#cnewPass').val('');
            errMsgLbl_1.css('display', 'none');
            errMsgLbl_2.css('display', 'none');
            $y("#passResetSubBtn").prop("disabled", true);
            $.ajax({
                url: '../action/passResetconfig.php',
                type: 'POST',
                data: passData,
                dataType: 'JSON',
                success: function (response) {
                    // console.log(response);
                    if (response == "Password has been changed successfully") {
                        var countdownInterval = setInterval(function () {
                            response_para.text(response + '--You will be logged out in ' + countdown + 's..')
                            response_para.css('color', 'green');
                            response_para.css('display', 'block');
                            countdown--;

                            // Stop the countdown when it reaches 0
                            if (countdown < 0) {
                                clearInterval(countdownInterval);
                                window.location.href = '../action/index.php';
                            }
                            
                        }, 1000);


                    }
                    else {
                        response_para.text(response);
                        response_para.css('color', 'red');
                        response_para.css('display', 'block');
                        response_para.delay(5000).fadeOut();

                    }

                }
            });

        }



    });
});