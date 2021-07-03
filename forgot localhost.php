<?php

session_start();
session_destroy();

?>
<?php
// include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;

// require 'vendor/phpmailer/phpmailer/src/Exception.php';
// require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require 'vendor/phpmailer/phpmailer/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ลืมรหัสผ่าน</title>
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

</head>
<style>
    #email {
        background-color: #f6f6f6;
        border: none;
        color: #0d0d0d;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 5px;
        width: 85%;
        border: 2px solid #f6f6f6;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;

    }
</style>

<body>


    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="img/logo.png" id="icon" alt="User Icon" />
            </div>
            <p style="margin-top: 20px;font-size: 14px; color: #666666;">ลืมรหัสผ่าน?</p>
            <p style="margin-top: -15px;font-size: 14px; color: #666666;">กรอกอีเมล์เพื่อรีเซ็ตรหัสผ่าน</p>


            <!-- Login Form -->
            <form class="validate-form" action="" method="post">

                <div class="fadeIn second validate-input" data-validate="Enter your Email">
                    <input type="email" id="email" name="email" class="form-control" placeholder="อีเมล์" style="margin-bottom: 20px;" required>
                </div>


                <input type="submit" class="fadeIn fourth" name="submit" id="submit" value="ยืนยัน">

            </form>

            <?php

            if (isset($_POST['submit'])) {
                include('connection.php');
                $email = $_POST['email'];

                $sel_query = "SELECT * FROM user_table WHERE email = '$email'";
                $results = mysqli_query($conn, $sel_query);
                $row = mysqli_num_rows($results);

                // echo $row;
                // echo $sel_query;

                if ($row == 0) {
                    echo "<script language='javascript'>";
                    echo 'alert("ไม่พบอีเมล์ กรุณากรอกใหม่");';
                    echo "</script>";
                } else if ($row > 0) {
                    // echo $row;
                    $key = md5(time());
                    $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                    $key = $key . $addKey;
                    // echo $key;

                    //autoload the PHPMailer
                    // require 'PHPMailer/PHPMailerAutoload.php';
                    require("vendor/autoload.php");
                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Host = "smtp.gmail.com"; // Enter your host here
                    $mail->Port = 587;

                    $mail->IsHTML(true);
                    $mail->CharSet = "utf-8";
                    $mail->ContentType = "text/html";
                    $mail->Username = "aichulapd@gmail.com"; // Enter your email here
                    $mail->Password = "@aichulapd0000"; //Enter your passwrod here

                    $mail->SetFrom("aichulapd@gmail.com", "ศูนย์ความเป็นเลิศทางการแพทย์โรคพาร์กินสัน");

                    $mail->Subject = "กู้คืนรหัสผ่าน";
                    $mail->Body = '<p>ศูนย์ความเป็นเลิศทางการแพทย์โรคพาร์กินสัน</p>
                    <p>โปรดคลิกลิงก์ข้างล่างเพื่อรีเซ็ตรหัสผ่านของคุณ</p>
                    <p><a href="http://localhost:8080/ProjectJop/web/ResetPassword?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">http://localhost:8080/ProjectJop/web/ResetPassword?key=' . $key . '&email=' . $email . '</a></p>';
                    $mail->AddAddress($email);
                    if (!$mail->Send()) {
                        echo "<script language='javascript'>";
                        // echo "Mailer Error: " . $mail->ErrorInfo;
                        echo 'alert("ส่งอีเมล์ไม่สำเร็จ");';
                        // echo 'window.location.replace("forgot");';
                        echo "</script>";
                    } else {
                        echo "<script language='javascript'>";
                        echo 'alert("ส่งอีเมล์สำเร็จ โปรดเช็คข้อความในอีเมล์เพื่อรีเซ็ตรหัสผ่าน");';
                        echo 'window.location.replace("index");';
                        echo "</script>";
                    }
                }
            }
            ?>
            <!-- Remind Passowrd -->
            <div id="formFooter">
                <span style="color: #999999;">ไม่มีบัญชีผู้ใช้งาน? </span>
                <a class="underlineHover" href="register">สมัครบัญชีผู้ใช้งาน</a>
                <br>
                <span style="color: #999999;">มีบัญชีผู้ใช้งาน?</span>
                <a class="underlineHover" href="index">เข้าสู่ระบบ</a>
            </div>

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