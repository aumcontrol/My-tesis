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
        ?>
        <div class="container-fluid" style="margin-top: 20px;">




          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div>
                <h1> วิธีติดตั้งเกมและดาวน์โหลดเกม </h1>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">ขั้นตอนการติดตั้งและดาวน์โหลดเกม </h3>
                </div> <!-- /.card-body -->
                <div class="card-body">

                  <div class="callout callout-danger">
                    <h5>1. แตะปุ่มด้านล่างเพื่อดาวน์โหลดเกม </h5>
                    <a href="../game/PDGames.apk" download>
                      <button type="button" class="btn btn-success">ดาวน์โหลดเกม</button>
                    </a>
                  </div>

                  <div class="callout callout-info">
                    <h5>2. ไปตำแหน่งที่ดาวน์โหลดเกม แล้วแตะที่ไฟล์ PD Games.apk</h5>
                    <div class="row">
                      <div class="col-sm-12">
                        <img src="../img/InstallGame/1.jpg" class="img-rounded" style="width: 50%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                      </div>
                    </div>
                  </div>

                  <div class="callout callout-warning">
                    <h5>3. จะเข้าสู่หน้าติดตั้งให้แตะที่ปุ่มติดตั้ง (Install) </h5>
                    <div class="row">
                      <div class="col-sm-12">
                        <img src="../img/InstallGame/2.jpg" class="img-rounded" style="width: 50%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                      </div>
                    </div>
                  </div>

                  <div class="callout callout-success">
                    <h5>4. เมื่อติดตั้งเสร็จแล้วให้แตะปุ่มเสร็จสิ้น (Done) </h5>
                    <div class="row">
                      <div class="col-sm-12">
                        <img src="../img/InstallGame/3.jpg" class="img-rounded" class="img-rounded" style="width: 50%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                      </div>
                    </div>
                  </div>

                  <div class="callout callout-danger">
                    <h5>5. กลับไปที่หน้าจอหลัก จะเห็นแอปพลิเคชันเกมชื่อ PD Games อยู่บนหน้าจอมือถือ</h5>
                    <div class="row">
                      <div class="col-sm-12">
                        <img src="../img/InstallGame/4.jpg" class="img-rounded" style="width: 50%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                      </div>
                    </div>
                  </div>

                  <div class="callout callout-info">
                    <h5>6. เมื่อเปิดแอปพลิเคชันเกม PD Games ขึ้นมา ตัวเกมจะขออนุญาตสิทธิ์ในการเข้าถึงให้แตะที่ปุ่ม "อนุญาต"</h5>
                    <div class="callout callout-info">
                      <h5>ขออนุญาตสิทธิ์กล้องถ่ายรูป</h5>
                      <div class="row">
                        <div class="col-sm-12">
                          <img src="../img/InstallGame/5.jpg" class="img-rounded" style="width: 50%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                        </div>
                      </div>
                    </div>
                    <div class="callout callout-info">
                      <h5>ขออนุญาตสิทธิ์ตำแหน่ง</h5>
                      <div class="row">
                        <div class="col-sm-12">
                          <img src="../img/InstallGame/6.jpg" class="img-rounded" style="width: 50%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                        </div>
                      </div>
                    </div>
                    <div class="callout callout-info">
                      <h5>ขออนุญาตสิทธิ์พื้นที่เก็บข้อมูล</h5>
                      <div class="row">
                        <div class="col-sm-12">
                          <img src="../img/InstallGame/7.jpg" class="img-rounded" style="width: 50%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="callout callout-warning">
                    <h5>7. จะเข้าสู่หน้าล็อกอิน ให้ล็อกอินด้วยรหัสประจำตัวผู้ป่วย ที่ลงทะเบียนโดยแพทย์</h5>
                    <div class="row">
                      <div class="col-sm-12">
                        <img src="../img/InstallGame/8.jpg" class="img-rounded" style="width: 50%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                      </div>
                    </div>
                  </div>

                  <div class="callout callout-success">
                    <h5>8. เมื่อล็อกอินเรียบร้อยแล้ว จะพบหน้าเมนูหลักของเกม PG Games</h5>
                    <div class="row">
                      <div class="col-sm-12">
                        <img src="../img/InstallGame/9.jpg" class="img-rounded" style="width: 50%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                      </div>
                    </div>
                  </div>

                </div><!-- /.card-body -->
              </div>
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->







        </div>
      </div>
    </div>
  </body>

  </html>
  <script src="../js/navbar.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="..\js\datatables.js"></script>

<?php } ?>