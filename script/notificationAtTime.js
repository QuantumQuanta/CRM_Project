// 02-12-23
$(document).ready(function () {
    const notifyContainer = $("#notify_container")[0];
    var user_name = $('#user_name').val();

    function updateTime() {
        const currentTime = new Date();
        const year = currentTime.toLocaleString("default", { year: "numeric" });
        const month = currentTime.toLocaleString("default", { month: "2-digit" });
        const day = currentTime.toLocaleString("default", { day: "2-digit" });

        const hours = currentTime.getHours().toString().padStart(2, '0');
        const minutes = currentTime.getMinutes().toString().padStart(2, '0');


        var curr_date = `${year}-${month}-${day}`;
        const currtime = `${hours}:${minutes}`;
        const data = {
            time: currtime,
            curr_date: curr_date,
            userName: user_name,
        };
        // //console.log("curr_date",data);

        $.ajax({
            url: '../action/notification_config.php',
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: function (response) {
                // //console.log("response", response);
                // Array.isArray(response)  checking weather the response is array or not
                $("#notify_container")[0].innerHTML = '';
                if (Array.isArray(response) && response.length > 0) {
                    response.forEach(function (notification, index) {
                        const slNo = notification.slNo;
                        var notificationKey = `${user_name}notification${slNo}`;
                        var isCheckNotify = localStorage.getItem(notificationKey);

                        // If the slNo does not exist, add the notification to local storage
                        if (!isCheckNotify) {
                            // //console.log("new notification");
                            let noti_time = notification.time.slice(0, -3);

                            if (currtime === noti_time) {
                                createToastElement(notifyContainer, notification);
                            }
                            if (currtime > noti_time) {
                                createToastElement(notifyContainer, notification);
                            }
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                // console.error("AJAX request failed:", status);
            }
        });
        setTimeout(updateTime, 1000);
    }

    updateTime();
    function createToastElement(container, notification) {
        const { date, time, bg_color, rem_details, rem_title, userid, userOG_name } = notification;
        let noti_time = notification.time.slice(0, -3);
        // let notificationTime = notification.time.slice(0, -3);

        // Assuming notificationTime is in the format "HH:mm"
        let hours = parseInt(noti_time.split(":")[0]);

        // Determine whether it's AM or PM
        let period = hours >= 12 ? "PM" : "AM";

        let shareBy = '';
        if (user_name != userid) {
            shareBy = 'Share By ';
        }
        const toastHtml = `<div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true" > 
                <div class="toast-header" >
                <a href="../action/reminders.php"> 
                <img class="bd-placeholder-img rounded me-2" src="../image/envolta_icon.jpg" width="20" height="20" alt="Alternative Text" > 
                </a>
                <strong class="me-auto" >${shareBy}${userOG_name}</strong> 
                <small class="text-muted" >${noti_time} ${period}</small> 
                
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" data-slno="${notification.slNo}" ></button> 
                </div> 
                <div class='toast-body' >                
                ${bg_color === 'alert-danger' ? "<b class='bellRed'><i class='fa fa-bell'></i> Important!!</b><br>" : "<b class='toast-body bellG' ><i class='fa fa-bell' ></i></b>"} 
                <b class="Massage">Massage: </b>${rem_details}<br>
                <b>Details: </b> ${rem_title}<br> 
                on <b>${date}  ${noti_time} ${period}</b>
                </div> 
                </div>
            `;

        const toastElement = $(toastHtml);
        container.appendChild(toastElement[0]);
        container.style.display = "block";
    }

    $(document).on("click", ".btn-close", function () {
        const slNo = $(this).data("slno");
        // //console.log("slNo", slNo);
        localStorage.setItem(`${user_name}notification${slNo}`, JSON.stringify("check"));

    });
});











