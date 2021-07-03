<section class="content">
    <div class="container-fluid">
        <form action="" method="POST">

            <?php
            $user_id = $_SESSION['userid'];
            $sql = "SELECT * FROM user_table WHERE id = $user_id";
            $result = mysqli_query($conn, $sql);

            ?>
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <div class="form-group">
                    <label for="Name">อีเมล์</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $row["email"]; ?>" placeholder="อีเมล์" required>
                </div>

            <?php } ?>

            <button type="submit" class="btn btn-primary" id="submit3" name="submit3">ยืนยัน</button>
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

if (isset($_POST['submit3'])) {

    $email = $_POST['email'];

    $email_check = "SELECT * FROM user_table WHERE email = '$email'";
    $result1 = mysqli_query($conn, $email_check);
    // $user = mysqli_fetch_assoc($result);
    $numemail = mysqli_num_rows($result1);


    $user_email = $_SESSION['userid'];
    $email_user = "SELECT email FROM user_table WHERE id = '$user_email'";
    $result11 = mysqli_query($conn, $email_user);
    $email_db = mysqli_fetch_assoc($result11);


    if ($email == " ") {
        echo "<script language='javascript'>";
        echo 'alert("ดำเนินการไม่สำเร็จ กรุณากรอกข้อมูลให้ครบถ้วน");';
        echo 'window.location.replace("EditProfile");';
        echo "</script>";
    } 
    else if($email_db['email'] == $email){
        echo "<script language='javascript'>";
        echo 'alert("อีเมล์นี้คุณกำลังใช้งานอยู่");';
        echo 'window.location.replace("EditProfile");';
        echo "</script>";
    }
    else if ($numemail > 0) {
        echo "<script language='javascript'>";
        echo 'alert("อีเมล์นี้ถูกใช้งานแล้ว");';
        echo 'window.location.replace("EditProfile");';
        echo "</script>";
    } else {
        $query = "UPDATE user_table SET email='$email' WHERE id='$user_id' ";
        $query_run = mysqli_query($conn, $query);
        echo "<script language='javascript'>";
        echo 'alert("ดำเนินการสำเร็จ");';
        echo 'window.location.replace("EditProfile");';
        echo "</script>";
    }
}
?>
<!-- END SQL EDIT -->