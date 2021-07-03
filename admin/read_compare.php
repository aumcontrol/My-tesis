<?php

session_start();
include('../connection.php');

if ($_SESSION['userlevel'] == 'm') {
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
    <title>Admin</title>
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
        if (isset($_POST["submit"])) {
          $compare = $_POST["cp"];
          // echo $compare[0];
          // $compare1 = $_POST["cp"][0];
          // echo '<br>'.$compare1.'<br>';
        }
        ?>
        <div class="container-fluid" style="margin-top: 20px;">

          <!-- ./row -->
          <div class="row">
            <div class="col-12">
              <div class="card card-dark card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-one-Daily-tab" data-toggle="pill" href="#custom-tabs-one-Daily" role="tab" aria-controls="custom-tabs-one-Daily" aria-selected="true">Daily Report</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-Monthy-tab" data-toggle="pill" href="#custom-tabs-one-Monthy" role="tab" aria-controls="custom-tabs-one-Monthy" aria-selected="false">Monthy Report</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-Yearly-tab" data-toggle="pill" href="#custom-tabs-one-Yearly" role="tab" aria-controls="custom-tabs-one-Yearly" aria-selected="false">Yearly Report</a>
                    </li>
                  </ul>
                </div>

                <div class="card-body-fluid" style="margin-top: 20px;">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-Daily" role="tabpanel" aria-labelledby="custom-tabs-one-Daily-tab">
                      <?php include('Compare_Daily_Report.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-Monthy" role="tabpanel" aria-labelledby="custom-tabs-one-Monthy-tab">
                    <?php include('Compare_Monthy_Report.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-Yearly" role="tabpanel" aria-labelledby="custom-tabs-one-Yearly-tab">
                    <?php include('Compare_Yearly_Report.php'); ?>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
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