<?php

session_start();
include('../connection.php');

if ($_SESSION['userlevel'] == 'm') {
    header("Location: ../index");
}

if ($_SESSION['userlevel'] == 'a') {
    header("Location: ../index");
}

if (!$_SESSION['userid']) {
    header("Location: ../index");
} else {


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Super Admin</title>
        <!-- ----------------------------------------------------------------------------------------------- -->
        <link rel="icon" type="image/png" href="../img/icon/logo.ico" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- CSS Card -->
        <link rel="stylesheet" href="../css/adminlte.min.css">

        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    </head>

    <body class="sb-nav-fixed">

        <div id="layoutSidenav">
            <div id="layoutSidenav_content">

                <?php
                include('navbar_admin.php');
                ?>
                <div class="container-fluid" style="margin-top: 20px;">

                    <div class="card card-pink mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            รายชื่อผู้ใช้งาน
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable22" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">ไอดี</th>
                                            <th>ชื่อ</th>
                                            <th>นามสกุล</th>
                                            <th>สถานะ</th>
                                            <th>จัดการ</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = "SELECT * FROM user_table";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {

                                        ?>
                                            <tr>
                                                <td style="display:none;"><?= $row['id']; ?></td>
                                                <td><?php echo $row['firstname']; ?></td>
                                                <td><?php echo $row['lastname']; ?></td>
                                                <td><?php
                                                    if ($row['userlevel'] == 'm') {
                                                        echo "Member";
                                                    } else if ($row['userlevel'] == 'a') {
                                                        echo "Admin";
                                                    } else if ($row['userlevel'] == 's') {
                                                        echo "Super Admin";
                                                    }
                                                    ?></td>
                                                <td class='text-center'>
                                                    <span id="editbtn" class='text-center' style="color: black; margin-left:10px;" title="Edit Record"><i class='fa fa-edit black'></i></span>
                                                    <span id="deletebtn" class='text-center' style="color: black; margin-left:10px;" title="Delete Record"><i class='fa fa-trash-alt black'></i></span>
                                                    <!-- <button type="button" class="btn btn-success" id="editbtn"></button> -->
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>


        <!-- modals edit patient -->
        <!-- Modal -->
        <div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">แก้ไขผู้ใช้งาน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <form action="" method="POST" class="needs-validation" novalidate>
                        <div class="modal-body">

                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label>ชื่อจริง</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="ชื่อจริง" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกชื่อจริงผู้ใช้งาน
                                </div>
                            </div>


                            <div class="form-group">
                                <label>นามสกุล</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="นามสกุล" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกนามสกุลผู้ใช้งาน
                                </div>
                            </div>
                            <div class="form-group">
                                <label>สถานะ</label>
                                <select class="custom-select" name="userlevel" id="userlevel" required>
                                    <option value="m">Menber</option>
                                    <option value="a">Admin</option>
                                    <option value="s">Super Admin</option>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือกสถานะของผู้ใช้งาน</div>
                            </div>


                        </div>
                        <div class="modal-footer">

                            <button type="submit" name="editdata" class="btn btn-primary">ยืนยัน</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- end modals edit patient -->



        <!-- modals delete patient -->
        <!-- Modal -->
        <div class="modal fade" id="deleteuser" tabindex="-1" aria-labelledby="del" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="del">ลบผู้ใช้งาน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <form action="" method="POST">
                        <div class="modal-body">

                            <!-- <input type="hidden" name="id" id="id"> -->
                            <input type="hidden" name="id1" id="id1">
                            <h5 style="color: black; text-align:center;">ข้อมูลจะไม่สามารถกู้คืนมาได้</h5>
                            <h5 style="color: red; text-align:center;">ยืนยันการลบข้อมูล.</h5>



                        </div>
                        <div class="modal-footer">

                            <button type="submit" name="deletedata" class="btn btn-danger">ยืนยัน</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- end modals delete patient -->





    </body>

    </html>
    <script src="../js/navbar.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables.js"></script>

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


    <!-- Script Edit -->
    <script>
        $(function() {
            // $("#editbtn").on('click', function() {
            $(document).on('click', '#editbtn', function() {
                jQuery.noConflict();
                $('#edituser').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#id').val(data[0]);
                $('#firstname').val(data[1]);
                $('#lastname').val(data[2]);
                $('#userlevel').val(data[3]);

            });
        });
    </script>

    <!-- SQL EDIT -->
    <?php

    if (isset($_POST['editdata'])) {
        $id = $_POST['id'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $userlevel = $_POST['userlevel'];

        if ($_SESSION['userid'] == $id && $userlevel == "s") {
            $query11 = "UPDATE user_table SET firstname='$fname',lastname='$lname',userlevel='$userlevel' WHERE id='$id' ";
            $query_run11 = mysqli_query($conn, $query11);
            echo "<script language='javascript'>";
            echo 'alert("ดำเนินการสำเร็จ");';
            echo 'window.location.replace("find_user");';
            echo "</script>";
        } else if ($_SESSION['userid'] == $id && ($userlevel == "a" || $userlevel == "m")) {
            echo "<script language='javascript'>";
            echo 'alert("ดำเนินการไม่สำเร็จ ไม่สามารถเปลี่ยนสถานะที่กำลังใช้งานในขณะนี้ได้");';
            echo 'window.location.replace("find_user");';
            echo "</script>";
        } else if ($_SESSION['userid'] != $id && $userlevel == "s") {
            echo "<script language='javascript'>";
            echo 'alert("ดำเนินการไม่สำเร็จ ไม่สามารถเปลี่ยนสถานะเป็น Super Admin ได้");';
            echo 'window.location.replace("find_user");';
            echo "</script>";
        } else {

            $query = "UPDATE user_table SET firstname='$fname',lastname='$lname',userlevel='$userlevel' WHERE id='$id' ";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {

                echo "<script language='javascript'>";
                echo 'alert("ดำเนินการสำเร็จ");';
                echo 'window.location.replace("find_user");';
                echo "</script>";
            } else {
                echo "<script language='javascript'>";
                echo 'alert("ดำเนินการไม่สำเร็จ");';
                echo 'window.location.replace("find_user");';
                echo "</script>";
            }
        }
    }
    ?>
    <!-- END SQL EDIT -->

    <!-- End Scripte Edit -->



    <!-- End Scripte Delete -->
    <script>
        $(function() {
            // $("#editbtn").on('click', function() {
            $(document).on('click', '#deletebtn', function() {
                jQuery.noConflict();
                $('#deleteuser').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#id1').val(data[0]);

            });
        });
    </script>
    <!-- End Scripte Delete -->

    <?php

    if (isset($_POST['deletedata'])) {
        $id1 = $_POST['id1'];

        if ($_SESSION['userid'] == $id1) {
            echo "<script language='javascript'>";
            echo 'alert("ดำเนินการไม่สำเร็จ ไม่สามารถลบข้อมูลที่กำลังใช้งานในขณะนี้ได้");';
            echo 'window.location.replace("find_user");';
            echo "</script>";
        } else {

            $query11 = "DELETE FROM user_table WHERE id='$id1' ";
            $query_run11 = mysqli_query($conn, $query11);

            if ($query_run11) {

                echo "<script language='javascript'>";
                echo 'alert("ดำเนินการสำเร็จ");';
                echo 'window.location.replace("find_user");';
                echo "</script>";
            } else {
                echo "<script language='javascript'>";
                echo 'alert("ดำเนินการไม่สำเร็จ");';
                echo 'window.location.replace("find_user");';
                echo "</script>";
            }
        }
    }
    ?>



<?php } ?>