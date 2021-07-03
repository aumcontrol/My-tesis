<?php

session_start();
session_destroy();


require_once "connection.php";

if (isset($_POST['submit'])) {
  session_start();

  $username = $_POST['username'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $email = $_POST['email'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];

  $user_check = "SELECT * FROM user_table WHERE username = '$username'";
  $result = mysqli_query($conn, $user_check);
  // $user = mysqli_fetch_assoc($result);
  $numusername = mysqli_num_rows($result);

  $email_check = "SELECT * FROM user_table WHERE email = '$email'";
  $result1 = mysqli_query($conn, $email_check);
  // $user = mysqli_fetch_assoc($result);
  $numemail = mysqli_num_rows($result1);

  if ($numusername > 0) {
    echo "<script>alert('บัญชีผู้ใช้งานนี้ถูกใช้งานแล้ว');</script>";
  } else if ($numemail > 0) {
    echo "<script>alert('อีเมล์นี้ถูกใช้งานแล้ว');</script>";
  } else if ($password != $cpassword) {
    echo "<script>alert('รหัสผ่านไม่ตรงกัน');</script>";
  } else {
    $passwordenc = md5($password);

    $query = "INSERT INTO user_table (username, password, firstname, lastname, email, userlevel)
                        VALUE ('$username', '$passwordenc', '$firstname', '$lastname','$email', 'm')";
    $result1 = mysqli_query($conn, $query);


    if ($result1) {
      $_SESSION['success'] = "สมัครบัญชีผู้ใช้งานสำเร็จ";
      header("Location: index");
    } else {
      $_SESSION['error'] = "เกิดข้อผิดพลาดในการสมัครบัญชีผู้ใช้งาน";
      header("Location: index");
    }
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>สมัครบัญชีผู้ใช้งาน</title>
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

      <!-- Login Form -->
      <form class="validate-form" action="register" method="post">

        <div class="fadeIn second" data-validate="Enter Username">
          <input type="text" id="username" class="input100" name="username" placeholder="บัญชีผู้ใช้งาน" required>
        </div>

        <div class="fadeIn second" data-validate="Enter Password">
          <input type="password" id="password" class="input100" name="password" placeholder="รหัสผ่าน" required>
        </div>

        <div class="fadeIn second" data-validate="Confirm Password">
          <input type="password" id="cpassword" class="input100" name="cpassword" placeholder="ยืนยันรหัสผ่าน" required>
        </div>

        <div class="fadeIn second" data-validate="Enter Email">
          <input type="email" id="email" class="form-control" name="email" placeholder="อีเมล์" required>
        </div>

        <div class="fadeIn second" data-validate="Enter Firstname">
          <input type="text" id="firstname" class="input100" name="firstname" placeholder="ชื่อจริง" required>
        </div>

        <div class="fadeIn second" data-validate="Enter Lastname">
          <input type="text" id="lastname" class="input100" name="lastname" placeholder="นามสกุล" required>
        </div>

        <input type="submit" class="fadeIn fourth" name="submit" value="สมัครบัญชีผู้ใช้งาน">


      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <span style="color: #999999;">มีบัญชีผู้ใช้งาน?</span>
        <a class="underlineHover" href="index">เข้าสู่ระบบ</a>
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