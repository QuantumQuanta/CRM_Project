// script.js

(function () {
    document.addEventListener("DOMContentLoaded", function () {
        document.body.classList.add("loaded");
        document.getElementById("loadingOverlay").style.opacity = "0";
    });

    function requestPermissions() {
        navigator.mediaDevices.getUserMedia({ audio: true, video: true })
            .then(function (stream) {
                // Permission granted
                redirectToNextPage();
            })
            .catch(function (error) {
                console.error('Error getting permissions:', error.message);
                alert("Please grant all permissions to proceed.");
            });
    }

    function redirectToNextPage() {
        localStorage.clear();
        // Redirect to another page after loading
        window.location.href = "https://crmenvolta.com/action";
    }

    // Expose only the necessary function
    window.requestPermissions = requestPermissions;
})();
