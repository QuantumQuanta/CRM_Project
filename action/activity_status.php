<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$last_activity = date("h:i:s A", $_SESSION['LAST_ACTIVE_TIME']);
$userIdno = $_SESSION['user_id_no'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inactive</title>
    <link rel="stylesheet" href="../stylesheet/activity_status.css">
    <style></style>
</head>

<body>
    <?php
    date_default_timezone_set('Asia/Kolkata');
    $currDay = date("d.m.y");
    ?>

    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <div class="inactive_timing">
                    <h1>
                        You Were Inactive.
                    </h1>
                    <h2>Time Frame : <p> from <?php echo $last_activity . "  "; ?> </p>
                        <p id="currTime"> </p>
                    </h2>
                    <hr>
                    <h3>Please Fill Up The Information And State The Reason For Your Inactivity</h3>
                </div>
                <form class="activityStat_form" action="" id="inactForm" name="inactForm">
                    <div>
                        <input type="hidden" name="lastActTime" id="lastActTime" value="<?php echo $last_activity; ?>">
                        <input type="hidden" name="currActTime" id="currActTime">
                        <input type="hidden" name="userIdno" id="userIdno" value="<?php echo $userIdno; ?>">
                        <input type="hidden" name="currDay" id="currDay" value="<?php echo $currDay; ?>">
                    </div>
                    <div class="activityStat__field">
                        <i class="login__icon fas fa-clipboard"></i>
                        <select name="inactivity_reason" id="inactivity_reason" class="login__input">
                            <option value="meeting" disabled>Reason for being inactive</option>
                            <option value="meeting">In a meeting(Client/Senior)</option>
                            <option value="lunch">Lunch Break</option>
                            <option value="no_internet">Internet connectivity issue</option>
                            <option value="training">Training</option>
                            <option value="leave">Leave</option>
                            <option value="other">Others..</option>
                        </select>
                    </div>
                    <div class="activityStat__field">
                        <i class="login__icon fas fa-comment"></i>
                        <input type="text" name="inactivity_comment" id="inactivity_comment" class="login__input" placeholder="Optional Comments">
                    </div>
                    <button class="button activityStat__submit" id="inactSubBtn" name="inactSubBtn">
                        <span class="button__text">SUBMIT</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
                <div id="showMsgdiv" class="showMsgdiv" style="display: hidden;">
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>





</body>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function updateClock() {
        let h = new Date().getHours();
        let m = new Date().getMinutes();
        let s = new Date().getSeconds();
        let ampm = "AM";
        if (h > 12) {
            h = h - 12;
            ampm = "PM";
        }
        h = addZero(h);
        m = addZero(m);
        s = addZero(s);

        currTime = h + ':' + m + ':' + s + ' ' + ampm;
        var lastAct = document.getElementById('currTime');
        lastAct.innerHTML = 'to ' + currTime;
        var currtimeval = document.getElementById('currActTime');
        currtimeval.value = currTime;
        setTimeout(() => {
            updateClock();

        }, 1000);
    }

    updateClock();
</script>
<script src="../script/inactivityFormData.js" type="text/javascript"></script>

</html>