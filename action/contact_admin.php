<!doctype html>
<html lang="en">

<head>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <!-- index CSS -->
    <!-- <link rel="stylesheet" href="../stylesheet/index.css"> -->
    <link rel="stylesheet" href="../stylesheet/contact-file.css">
    <title>contact_admin</title>
</head>

<body>
    <script src="../script/backPre.js" type="text/javascript"></script>
    <div id="contentBody">
        <!--heder top body End-->
        <?php
        require '../layout/header.php';
        ?>

        <?php
        require '../constant/encrypt_decrypt.php';
        if (isset($_GET['data'])) {
            $response = decryptData($_GET['data']);
            echo $response;
            // switch ($response) {
            //     case "1":
            //         echo '
            //                 <div class="alert alert-success alert-dismissible fade show" role="alert">
            //                     <strong>Yay!!</strong> Your concern has been reported to the administrator. The administrator will get in touch soon. Keep your specific ticket number close by.
            //                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //                 </div>
            //             ';
            //         break;

            //     case "0":
            //         echo '
            //                 <div class="alert alert-success alert-dismissible fade show" role="alert">
            //                     <strong>Oops!</strong> Your request to the administrator was not properly submitted.Please try again later.
            //                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //                 </div>
            //             ';
            //         break;

            //     default:
            //         echo '404 Error!';
            // }
        }
        ?>

        <div class="container">
            <div class="form-box">
                <form action="../action/contact_admin_process.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3 text-container">
                        <input type="text" class="form-control" id="contact_admin_name" placeholder="Name" name="contact_admin_name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 text-container">
                        <input type="text" class="form-control" id="contact_admin_empid" placeholder="Employee Id :" name="contact_admin_empid">
                    </div>
                    <div class="mb-3 text-container">
                        <input type="email" class="form-control" id="contact_admin_email" name="contact_admin_email" placeholder="Official Email Id" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 text-container">
                        <textarea class="form-control" id="contact_admin_issue" placeholder="Describe your issue here" name="contact_admin_issue" rows="4"></textarea>
                    </div>
                    <div class="mb-3 text-container">
                        <input class="form-control form-control-sm" id="contact_admin_ss" placeholder="Reference Screenshot" name="contact_admin_ss" type="file" >
                    </div>
                    <?php
                    date_default_timezone_set('Asia/Kolkata');
                    $d_t = date("Y-m-d H:i:s");
                    ?>
                    <input type="hidden" id="contact_admin_dt" name="contact_admin_dt" value="<?php echo $d_t ?>">
                    <button type="submit" class="btn btn-login" id="contact_admin_submit">Submit</button>
                </form>
                <div class="back-btn">

                    <a type="button" href="../action/index.php"> Back to Login</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    require '../layout/footer.php';
    ?>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="../script/JQuery_2.0.js" type="text/javascript"></script>
    <script>
        /*$('.round').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('.arrow').toggleClass('bounceAlpha');
        });*/
    </script>
    
    <script src="../script/conAdminFileFilter.js" type="text/javascript"></script>
</body>

</html>