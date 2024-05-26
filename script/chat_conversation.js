const form = document.querySelector(".typing-area");
const incoming_id = document.querySelector(".incoming_id").value;
inputField = document.querySelector(".input-field"); // Remove the dot (.) before "input-field"
sendBtn = document.getElementById("chat_sendMsg");
// chatBox = document.querySelector(".chat-box");
chatBox=document.getElementById("users-conversation");
let clickablechat;
// console.log("sendBtn", sendBtn, "incoming_id", incoming_id);



form.onsubmit = (e) => {
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value != "") {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = () => {
    // console.log("inside onclick function");
    var action = "users_send_message";
    var formData = new FormData(form);
    formData.append('action_sendMsg', action);

    $.ajax({
        url: 'chat_Conversation.php',
        method: "post",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            // console.log("inside response", response);
            inputField.value = "";
            scrollToBottom();
            fetchMesseges();
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

setInterval(() => {
    var action = "users_messageNotification";
    $.ajax({
        url: "chat_Conversation.php",
        method: "GET",
        data: { action_messageNotification: action },
        success: function (data) {
            // console.log("messageNotification", data);
            if (data == 'new message') {
                // console.log("inside ifnew message");
                fetchMesseges();
            }
            else {
                // console.log("inside else new message");
            }
        },
        error: function (xhr, status, error) {
            console.error("An error occurred during the request.");
        },
        contentType: "application/x-www-form-urlencoded"
    });

}, 1000);


function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}

fetchMesseges();
function fetchMesseges() {
    var action = "users_Get_message";
    $.ajax({
        url: "chat_Conversation.php",
        method: "GET",
        data: { incoming_id: incoming_id, action_GetMsg: action },
        success: function (data) {
            chatBox.innerHTML = data;
            if (!chatBox.classList.contains("active")) {
                scrollToBottom();
            }
            const clickablechat = document.querySelectorAll('.chat');
            // console.log('clickablechat',clickablechat);
            clickablechat.forEach(function (chat) {
                chat.addEventListener('click', expandFunction);
              });
        },

        error: function (xhr, status, error) {
            console.error("An error occurred during the request.");
        },
        contentType: "application/x-www-form-urlencoded"
    });
}

  function expandFunction(event) {
    // console.log("in chat expandFunction")
    const p_text = document.querySelectorAll(".chat p");
    p_text.forEach(function (p) {
      p.addEventListener("click", function () {
        this.classList.toggle("expanded");
      });
    });
  }

$(document).ready(function () {
    $('#chat_MediaSendBtn').unbind('click').bind('click', function () {
        var media_type = $('.media_type').val();
        // console.log("SendMessage", media_type);
        send_image_messages(media_type);
    });

    $('#showMore_InputOpt').unbind('click').bind('click', function (e) {
        // console.log('showMore_InputOpt');
        $('#mediaInput_list').toggle();
        e.stopPropagation();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#mediaInput_list, #showMore_InputOpt').length) {
            $('#mediaInput_list').hide();
        }
    });

    $('#select_image').unbind('click').bind('click', function () {
        $('#send_image').trigger('click');
        // console.log('select_image');
    });
    $('#select_anyfile').unbind('click').bind('click', function () {
        $('#send_anyfile').trigger('click');
    });
    $('#select_video').unbind('click').bind('click', function () {
        $('#send_video').trigger('click');
        // console.log('send_video');
    });
    $('#select_audio').unbind('click').bind('click', function () {
        $('#send_audio').trigger('click');
    });
    $(document).on('change', '#send_image', function () {
        selectMedia_Input('send_image')
    });
    $(document).on('change', '#send_anyfile', function () {
        selectMedia_Input('send_anyfile')
    });
    $(document).on('change', '#send_video', function () {
        selectMedia_Input('send_video')
    });
    $(document).on('change', '#send_audio', function () {
        selectMedia_Input('send_audio')
    });

    function selectMedia_Input(fileInputId) {
        var formData = new FormData();
        var inputFile = document.getElementById(fileInputId).files[0];
        formData.append("files", inputFile);
        formData.append("fileInputId", fileInputId);

        $.ajax({
            url: 'chat_actionPage.php',
            method: "post",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#mediaInput_list').hide();
                $('#file_Upload').addClass("show");
                $('#file_Upload').html("");
                $('#file_Upload').html(data);
                getmediaValue();
                $('#remove-attechedFile').unbind('click').bind('click', function () {
                    // console.log('remove-attechedFile')
                    $('#file_Upload').removeClass("show");
                    $('#file_Upload').html("");
                    $('#chat_sendMsg').show();
                    $('#chat_MediaSendBtn').hide();
                });
                // console.log("selectMedia_Input", data);
            }
        });
    }

    function getmediaValue() {
        var media_type = $('.media_type').val();
        // console.log("media_type", media_type);
        if (media_type.length > 0) {
            $('#chat_sendMsg').hide();
            $('#chat_MediaSendBtn').show();

        } else {
            $('#chat_sendMsg').show();
            $('#chat_MediaSendBtn').hide();
        }

    };
    function send_image_messages(fileInputId) {
        var formData = new FormData();
        var inputFile = document.getElementById(fileInputId).files[0];
        formData.append("sendfiles", inputFile);
        formData.append("incoming_id", incoming_id)
        // console.log("inputFile", inputFile, "formData", formData);

        $.ajax({
            url: 'chat_actionPage.php',
            method: "post",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                // console.log("send_image_messages", data);
                $('#file_Upload').removeClass("show");
                $('#file_Upload').html("");
                $('#media_type').val('');
                fetchMesseges();
            }
        });
    }

})

