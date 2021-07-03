<?php

session_start();
include('../connection.php');

if ($_SESSION['userlevel'] == 'a') {
    header("Location: ../index");
}

if ($_SESSION['userlevel'] == 's') {
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
        <title>Member</title>
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
                include('navbar_member.php');
                ?>
                <div class="container-fluid" style="margin-top: 20px;">

                    <div class="card card-pink mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            รายชื่อผู้ป่วย
                        </div>
                        <div class="card-body">
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
                                                <td>
                                                    <div class='text-center'><a href="read_patient?id=<?= $row['hn_id']; ?>" target="_blank" style="color: black;" title="View Record"><i class='fa fa-eye black' aria-hidden='true'></i></a></div>
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


    </body>

    </html>
    <script src="../js/navbar.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables.js"></script>


<?php } ?>