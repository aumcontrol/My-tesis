<section class="content">
    <div class="container-fluid">
        <form action="" method="POST">


            <div class="form-group">
                <label for="password">รหัสผ่านเก่า</label>
                <input type="password" class="form-control" id="opassword" name="opassword" placeholder="รหัสผ่านเก่า" required>
            </div>

            <div class="form-group">
                <label for="password">รหัสผ่านใหม่</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่านใหม่" required>
            </div>

            <div class="form-group">
                <label for="cpassword">ยืนยันรหัสผ่านใหม่</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="ยืนยันรหัสผ่านใหม่" required>
            </div>

            <button type="submit" class="btn btn-primary" id="subbmit1" name="submit1">ยืนยัน</button>
        </form>
        <br>
    </div>
</section>

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


<!-- SQL EDIT -->
<?php

if (isset($_POST['submit1'])) {
    $user_id1 = $_SESSION['userid'];
    $opassword = $_POST['opassword'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $sql = "SELECT * FROM user_table WHERE id = $user_id1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $p = $row['password'];
            $pp =md5($opassword);

// echo $p;

    if($password == " " || $cpassword == " "){
        echo "<script language='javascript'>";
        echo 'alert("ดำเนินการไม่สำเร็จ กรุณากรอกข้อมูลให้ครบถ้วน");';
        echo 'window.location.replace("EditProfile");';
        echo "</script>";
    } else if ($p != $pp) {
        echo "<script>alert('รหัสผ่านเก่าไม่ถูกต้อง');</script>";
    }
    else if ($password != $cpassword) {
        echo "<script>alert('รหัสผ่านไม่ตรงกัน');</script>";
    }
    else if($p == $pp && $password == $cpassword){
        $passwordenc = md5($password);
        $query1 = "UPDATE user_table SET password='$passwordenc'WHERE id='$user_id' ";
        $query_run1 = mysqli_query($conn, $query1);
        echo "<script language='javascript'>";
        echo 'alert("ดำเนินการสำเร็จ");';
        echo 'window.location.replace("EditProfile");';
        echo "</script>";
    }
}
?>
<!-- END SQL EDIT -->