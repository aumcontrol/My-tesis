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
                            รายชื่อผู้ป่วย
                        </div>
                        <div class="card-body">

                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#insertpatient" style="margin-bottom: 15px;">เพิ่มผู้ป่วย</button>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="30%">รหัสประจำตัวผู้ป่วย</th>
                                            <th>ชื่อ</th>
                                            <th>นามสกุล</th>
                                            <th>จัดการ</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = "SELECT * FROM patient_table";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {

                                        ?>
                                            <tr>
                                                <td><?php echo $row['hn_id']; ?></td>
                                                <td><?php echo $row['first_name']; ?></td>
                                                <td><?php echo $row['last_name']; ?></td>
                                                <td class='text-center'>
                                                    <span class='text-center'><a href="read_patient?id=<?= $row['hn_id']; ?>" target="_blank" style="color: black;" title="View Record"><i class='fa fa-eye black' aria-hidden='true'></i></a></span>
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





        <!-- modals insert patient -->
        <!-- Modal -->
        <div class="modal fade" id="insertpatient" tabindex="-1" aria-labelledby="insert" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insert">เพิ่มผู้ป่วย</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <form action="insert_patient" method="POST" class="needs-validation" novalidate>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>รหัสประจำตัวผู้ป่วย</label>
                                <input type="number" class="form-control" name="hnid" placeholder="รหัสประจำตัวผู้ป่วย" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกรหัสประจำตัวผู้ป่วย
                                </div>

                            </div>
                            <div class="form-group">
                                <label>ชื่อจริง</label>
                                <input type="text" class="form-control" name="firstname" placeholder="ชื่อจริง" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกชื่อจริงผู้ป่วย
                                </div>
                            </div>
                            <div class="form-group">
                                <label>นามสกุล</label>
                                <input type="text" class="form-control" name="lastname" placeholder="นามสกุล" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกนามสกุลผู้ป่วย
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">

                            <button type="submit" name="insertdata" class="btn btn-primary">ยืนยัน</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- end modals insert patient -->

        <!-- modals edit patient -->
        <!-- Modal -->
        <div class="modal fade" id="editpatient" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">แก้ไขผู้ป่วย</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <form action="edit_patient" method="POST" class="needs-validation" novalidate>
                        <div class="modal-body">

                            <!-- <input type="hidden" name="id" id="id"> -->

                            <div class="form-group">
                                <label>รหัสประจำตัวผู้ป่วย</label>
                                <input type="number" class="form-control" name="hnid" id="hnid1" disabled>
                                <input type="hidden" name="hnid" id="hnid">
                            </div>
                            

                            <div class="form-group">
                                <label>ชื่อจริง</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="ชื่อจริง" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกชื่อจริงผู้ป่วย
                                </div>
                            </div>
                            <div class="form-group">
                                <label>นามสกุล</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="นามสกุล" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกนามสกุลผู้ป่วย
                                </div>
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
        <div class="modal fade" id="deletepatient" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">ลบผู้ป่วย</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <form action="delete_patient" method="POST">
                        <div class="modal-body">

                            <!-- <input type="hidden" name="id" id="id"> -->

                            
                                <input type="hidden" name="delete_hn" id="delete_hn">
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
                $('#editpatient').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#hnid').val(data[0]);
                $('#firstname').val(data[1]);
                $('#lastname').val(data[2]);

            });
        });
    </script>




    <script>
        $(function() {
            // $("#editbtn").on('click', function() {
            $(document).on('click', '#editbtn', function() {
                jQuery.noConflict();
                $('#editpatient').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#hnid1').val(data[0]);

            });
        });
    </script>
    <!-- End Scripte Edit -->

    <!-- End Scripte Delete -->
    <script>
        $(function() {
            // $("#editbtn").on('click', function() {
            $(document).on('click', '#deletebtn', function() {
                jQuery.noConflict();
                $('#deletepatient').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_hn').val(data[0]);

            });
        });
    </script>
    <!-- End Scripte Delete -->



<?php } ?>