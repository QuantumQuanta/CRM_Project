$('#inactSubBtn').on('click', function(event){
    event.preventDefault();
    var msgDiv = document.getElementById('showMsgdiv');
    let formdata ={
        lastActive : $('#lastActTime').val(),
        currActTime : $('#currActTime').val(),
        inactivityReason : $('#inactivity_reason').val(), 
        inactivityComment: $('#inactivity_comment').val(),
        userIdno : $('#userIdno').val(),
        currDay : $('#currDay').val()
    }
    // console.log(formdata);
    
    $.ajax({
        url:'../action/active_stat_config.php',
        type: 'post',
        data: formdata,
        dataType : 'JSON',
        success: function(response){
            if(response === "success"){
                
                let msgSuc="Your entry have been saved successfully! You will be redirected to the login page after 5 seconds.";
                msgDiv.innerHTML = msgSuc;
                msgDiv.style.display = "block";
                setTimeout(function(){
                    window.location.href = "../action/logout.php";
                },5000)
                
            }
            else{
                let msgUnsuc = "Your entry have not been saved! Please try again! "
                msgDiv.innerHTML = msgUnsuc;
                msgDiv.style.display = "block";
            }
            // console.log(response);
        }
    })
})