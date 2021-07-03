<?php

session_start();
session_destroy();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เข้าสู่ระบบ</title>
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

            <!-- Login Form -->
            <form class="validate-form" action="login" method="post">

                <div class="fadeIn second">
                    <input type="text" id="username" class="input100" name="username" placeholder="บัญชีผู้ใช้งาน" required>
                </div>

                <div class="fadeIn third">
                    <input type="password" id="password" class="input100" name="password" placeholder="รหัสผ่าน" required>
                </div>

                <input type="submit" class="fadeIn fourth" name="submit" value="เข้าสู่ระบบ">

                <!-- Alert Register -->
                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="success">
                        <?php
                        echo $_SESSION['success'];
                        ?>
                    </div>
                <?php endif; ?>


                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="error">
                        <?php
                        echo $_SESSION['error'];
                        ?>
                    </div>
                <?php endif; ?>

            </form>
            <!-- Remind Passowrd -->
            <div id="formFooter">
                <span style="color: #999999;">ไม่มีบัญชีผู้ใช้งาน? </span>
                <a class="underlineHover" href="register">สมัครบัญชีผู้ใช้งาน</a>
                <br>
                <a class="underlineHover" href="forgot">ลืมรหัสผ่าน?</a>
            </div>

        </div>
    </div>



    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/validate.js"></script>
</body>

</html>

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

<?php

if (isset($_SESSION['success']) || isset($_SESSION['error'])) {
    session_destroy();
}

?>