const searchBar = document.querySelector(".search input"),
    searchIcon = document.querySelector(".search button"),
    usersList = document.querySelector(".users-list");

searchIcon.onclick = () => {
    searchBar.classList.toggle("show");
    searchIcon.classList.toggle("active");
    searchBar.focus();
    if (searchBar.classList.contains("active")) {
        searchBar.value = "";
        searchBar.classList.remove("active");
    }
}

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    // console.log("searchTerm", searchTerm)
    if (searchTerm != "") {
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }

    $.ajax({
        url: '../action/chat_actionPage.php',
        method: "post",
        data: { searchText: searchTerm },
        success: function (data) {
            // console.log("searchTerm data", data);
        }
    });
}



setInterval(() => {
    var action = "users_List";
    $.ajax({
        url: "../action/chat_actionPage.php",
        method: "POST",
        data: { action_userList: action },
        success: function (data) {
            // console.log("data",data);
            if (!searchBar.classList.contains("active")) {
                usersList.innerHTML = '<ul class="list-unstyled chat-list chat-user-list">' + data + '</ul>';
            }
        },
        error: function (xhr, status, error) {
            console.error("An error occurred during the request.");
        }
    });
}, 500);



