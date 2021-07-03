<?php

session_start();
session_destroy();

$key = $_GET["key"];
$email = $_GET["email"];

if (!$email) {
    header("Location: index");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รีเซ็ตรหัสผ่าน</title>
    <!-- ----------------------------------------------------------------------------------------------- -->
    <link rel="icon" type="image/png" href="img/icon/logo.ico" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- ใช้เฉพาะ login , register -->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <style>
        #formContent {
            font-family: 'Kanit', sans-serif;
        }
    </style>

</head>


<body>


    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="img/logo.png" id="icon" alt="User Icon" />
            </div>

            <form class="validate-form" action="" method="post">

                <div class="fadeIn third validate-input" data-validate="Enter Password">
                    <input type="password" class="input100" name="pass1" placeholder="รหัสผ่าน" required>
                </div>

                <div class="fadeIn third validate-input" data-validate="Confirm Password">
                    <input type="password" class="input100" name="pass2" placeholder="ยืนยันรหัสผ่าน" required>
                </div>
                <input type="hidden" name="email" value="<?php echo $email; ?>" />

                <input type="submit" class="fadeIn fourth" name="submit" value="รีเซ็ตรหัสผ่าน">

            </form>

            <?php

            include('connection.php');



            if (isset($_POST["submit"])) {
                $pass1 = $_POST["pass1"];
                $pass2 = $_POST["pass2"];

                if ($pass1 == " " || $pass2 == " ") {
                    echo "<script>alert('ดำเนินการไม่สำเร็จ กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
                } else if ($pass1 != $pass2) {
                    echo "<script>alert('รหัสผ่านไม่ตรงกัน');</script>";
                } else {
                    $pass3 = md5($pass1);
                    mysqli_query($conn, "UPDATE user_table SET password = '$pass3' WHERE email= '$email'");
                    echo "<script language='javascript'>";
                    echo 'alert("ดำเนินการสำเร็จ");';
                    echo 'window.location.replace("index");';
                    echo "</script>";
                }
            }
            ?>

        </div>
    </div>


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/validate.js"></script>
</body>
<!-- Script Validate -->
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<!-- End Script Validate -->

</html>