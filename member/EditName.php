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
                    <label for="Name">ชื่อจริง</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $row["firstname"]; ?>" placeholder="ชื่อจริง" required>
                </div>

                <div class="form-group">
                    <label for="Lastname">นามสกุล </label>
                    <input type="text" class="form-control" id="lname" name="lname" value="<?= $row["lastname"]; ?>" placeholder="นามสกุล" required>
                </div>


            <?php } ?>

            <button type="submit" class="btn btn-primary" id="submit" name="submit">ยืนยัน</button>
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

if (isset($_POST['submit'])) {

    $fname = $_POST['name'];
    $lname = $_POST['lname'];

    if ($fname == " " || $lname == " ") {
        echo "<script language='javascript'>";
        echo 'alert("ดำเนินการไม่สำเร็จ กรุณากรอกข้อมูลให้ครบถ้วน");';
        echo 'window.location.replace("EditProfile");';
        echo "</script>";
    }  else {
        $query = "UPDATE user_table SET firstname='$fname',lastname='$lname' WHERE id='$user_id' ";
        $query_run = mysqli_query($conn, $query);
        echo "<script language='javascript'>";
        echo 'alert("ดำเนินการสำเร็จ");';
        echo 'window.location.replace("EditProfile");';
        echo "</script>";
    }
}
?>
<!-- END SQL EDIT -->