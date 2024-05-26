<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
    $user_id = $_SESSION['username'];
    $user_name = $_SESSION['name'];
    $desg_code = $_SESSION['desg_code'];
} else {
    $loggedin = false;
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>side_bar</title>
    <link rel="stylesheet" href="../stylesheet/sidebar.css">
</head>

<body>
    <?php
    if ($loggedin == true && $desg_code == 'PRO') {
        echo '
                <div id="mySidebar" onmouseover="openNav()" onmouseleave="closeNav()">
                    <a href="">
                        <span id="Envicon">
                            <img src="../image/envolta_logo.png" alt="homePng" height="auto" width="160px">
                        </span>
                    </a>
                    <aside id="sidebar" class=" break-point-sm has-bg-image">
                        <div id="mySidenav" class="sidenav">
                            <a href="../action/home.php">
                                <span class="icons"><img src="../image/sidebarImage/home.png" alt="homePng" height="auto">
                                </span>
                                <span class="menu-title">Home</span>
                            </a>
                            <a href="../action/crm.php">
                                <span class="icons"> <img src="..\image\sidebarImage\crm2.png" alt="CRMpng" height="auto"></span>
                                <span class="menu-title">CRM</span>
                            </a>
                            <a href="../action/reminders.php">
                                <span class="icons"><img src="..\image\sidebarImage\reminder.png" alt="reminderspng" height="auto"></span></span>
                                <span class="menu-title">Reminders</span>
                            </a>
                            <a href="../action/note.php">
                                <span class="icons"><img src="..\image\sidebarImage\note2.png" alt="notepng" height="auto"></span></span>
                                <span class="menu-title">Note</span>
                            </a>
                            <a href="../action/home.php">
                                <span class="icons"><img src="..\image\sidebarImage\file.png" alt="filepng" height="auto"></span></span>
                                <span class="menu-title">File Manager</span>
                            </a>
                            <a href="../action/home.php">
                                <span class="icons"><img src="..\image\sidebarImage\chat.png" alt="chatspng" height="auto"></span></span>
                                <span class="menu-title">Chats</span>
                            </a>
                            <a href="../action/visitor_log.php">
                                <span class="icons"><img src="..\image\sidebarImage\logbook.png" alt="visitorpng" height="auto"></span></span>
                                <span class="menu-title">Visitor Log Book</span>
                            </a>
                            <a href="../action/contact_admin.php">
                                <span class="icons"><img src="../image/sidebarImage/contact.png" alt="contactpng" height="auto"></span></span>
                                <span class="menu-title">Contact with Admin</span>
                            </a>
                        </div>
                    </aside>
                </div>
        ';
    } else if ($loggedin == true && $desg_code == '2NDRESP') {
        echo '
                <div id="mySidebar" onmouseover="openNav()" onmouseleave="closeNav()">
                    <a href="">
                        <span id="Envicon">
                            <img src="../image/envolta_logo.png" alt="homePng" height="auto" width="160px">
                        </span>
                    </a>
                    <aside id="sidebar" class=" break-point-sm has-bg-image">
                        <div id="mySidenav" class="sidenav">
                            <a href="../action/home_2nd_resp.php">
                                <span class="icons"><img src="../image/sidebarImage/home.png" alt="homePng" height="auto">
                                </span>
                                <span class="menu-title">Home</span>
                            </a>
                            <a href="../action/crm2.php">
                                <span class="icons"> <img src="..\image\sidebarImage\crm2.png" alt="CRMpng" height="auto"></span>
                                <span class="menu-title">CRM</span>
                            </a>
                            <a href="../action/reminders.php">
                                <span class="icons"><img src="..\image\sidebarImage\reminder.png" alt="reminderspng" height="auto"></span></span>
                                <span class="menu-title">Reminders</span>
                            </a>
                            <a href="../action/note.php">
                                <span class="icons"><img src="..\image\sidebarImage\note2.png" alt="notepng" height="auto"></span></span>
                                <span class="menu-title">Note</span>
                            </a>
                            <a href="../action/home_2nd_resp.php">
                                <span class="icons"><img src="..\image\sidebarImage\file.png" alt="filepng" height="auto"></span></span>
                                <span class="menu-title">File Manager</span>
                            </a>
                            <a href="../action/home_2nd_resp.php">
                                <span class="icons"><img src="..\image\sidebarImage\chat.png" alt="chatspng" height="auto"></span></span>
                                <span class="menu-title">Chats</span>
                            </a>
                            <a href="../action/contact_admin.php">
                                <span class="icons"><img src="../image/sidebarImage/contact.png" alt="contactpng" height="auto"></span></span>
                                <span class="menu-title">Contact with Admin</span>
                            </a>
                        </div>
                    </aside>
                </div>
        ';
    } else if ($loggedin == true && $desg_code == 'CEO') {
        echo '
                        <div id="mySidebar" onmouseover="openNav()" onmouseleave="closeNav()">
                        <a href="">
                        <span id="Envicon">
                            <img src="../image/envolta_logo.png" alt="homePng" height="auto" width="160px">
                        </span>
                        </a>
                        <aside id="sidebar" class=" break-point-sm has-bg-image">
                        <div id="mySidenav" class="sidenav">
                        <a href="../action/master_home.php">
                            <span class="icons"><img src="../image/sidebarImage/home.png" alt="homePng" height="auto">
                            </span>
                            <span class="menu-title">Home</span>
                        </a>
                        <a href="../action/ceo_client_assign.php">
                            <span class="icons"><img src="..\image\sidebarImage\priority.png" alt="homePng" height="auto"></span>
                            <span class="menu-title">Assignation</span>
                        </a>
                        <a href="../action/master_crm.php">
                            <span class="icons"> <img src="..\image\sidebarImage\crm2.png" alt="CRMpng" height="auto"></span>
                            <span class="menu-title">CRM</span>
                        </a>
                        <a href="../action/c_requirement.php">
                            <span class="icons"><img src="..\image\sidebarImage\crm2.png" alt="creqPng" height="auto"></span>
                            <span class="menu-title">C-Requirement</span>
                        </a>
                        <a href="../action/reminders.php">
                            <span class="icons"><img src="..\image\sidebarImage\reminder.png" alt="reminderspng" height="auto"></span></span>
                            <span class="menu-title">Reminders</span>
                        </a>
                        <a href="../action/note.php">
                            <span class="icons"><img src="..\image\sidebarImage\note2.png" alt="notepng" height="auto"></span></span>
                            <span class="menu-title">Note</span>
                        </a>
                        <a href="../action/new_user.php">
                            <span class="icons"><img src="..\image\sidebarImage\file.png" alt="filepng" height="auto"></span></span>
                            <span class="menu-title">Create User</span>
                        </a>
                        <a href="../action/master_home.php">
                            <span class="icons"><img src="..\image\sidebarImage\chat.png" alt="chatspng" height="auto"></span></span>
                            <span class="menu-title">Chats</span>
                        </a>
                        
                        <a href="../action/ceo_visitor_log.php">
                            <span class="icons"><img src="..\image\sidebarImage\logbook.png" alt="visitorpng" height="auto"></span></span>
                            <span class="menu-title">Visitor Log Book</span>
                        </a>
                        <a href="../action/contact_admin.php">
                            <span class="icons"><img src="../image/sidebarImage/contact.png" alt="contactpng" height="auto"></span></span>
                            <span class="menu-title">Contact with Admin</span>
                        </a>
                    </div>
                </aside>
            </div>
        ';
    }
    ?>
    <script src="../script/home_sideBar.js" type="text/javascript"></script>
</body>

</html>