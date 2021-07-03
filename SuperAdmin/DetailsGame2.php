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




          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div>
                <h1>เกมจับคู่ภาพยา</h1>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">กฎกติกาเกมจับคู่ภาพยา</h3>
                </div> <!-- /.card-body -->
                <div class="card-body">


                  <div class="callout callout-danger">
                    <h5>วิธีการเล่นเกมจับคู่ภาพยา</h5>
                    <p>
                    <ol>
                      <li>เมื่อเริ่มเกมจะเปิดหน้าการ์ดมีเวลาให้ผู้เล่นสังเกตภาพยาที่เหมือนกัน</li>
                      <li>เมื่อครบเวลาที่กำหนดการ์ดถูกปิดเป็นหลังการ์ด</li>
                      <li>ให้ผู้เล่นเปิดหน้าการ์ดเพื่อจับคู่ภาพยา ครั้งละ 1 คู่ จนกว่าจะหมดทุกคู่หรือจนกว่าเวลาจะหมด หากจับคู่ผิดการ์ดจะถูกปิด</li>
                    </ol>
                    </p>
                  </div>

                  <div class="callout callout-info">
                    <h5>การให้คะแนนเกมจับคู่ภาพยา</h5>
                    <p>
                    <ul>
                      <li>จับคู่ภาพถูก +1 คะแนน</li>
                      <li>จับคู่ภาพผิด –1 คะแนน</li>
                    </ul>
                    </p>
                  </div>

                  <div class="callout callout-warning">
                    <h5>เกมจับคู่ภาพยามีทั้งหมด 4 เลเวล</h5>

                    <div class="callout callout-warning">
                      <h5>เกมจับคู่ภาพยาเลเวล 1</h5>
                      <p>จับคู่ภาพยาทั้งหมด 3 คู่ มีเวลา 30 วินาที ในการเล่น</p>
                      <div class="row">
                        <div class="col-sm-12">
                          <img src="../img/game/G2/1.png" class="rounded" style="width: 100%;  display: block; margin-left: auto; margin-right: auto;" />
                        </div>
                      </div>
                    </div>

                    <div class="callout callout-warning">
                      <h5>เกมจับคู่ภาพยาเลเวล 2</h5>
                      <p>จับคู่ภาพยาทั้งหมด 5 คู่ มีเวลา 1 นาที (60 วินาที) ในการเล่น</p>
                      <div class="row">
                        <div class="col-sm-12">
                          <img src="../img/game/G2/2.png" class="rounded" style="width: 100%; display: block; margin-left: auto; margin-right: auto;" />
                        </div>
                      </div>
                    </div>

                    <div class="callout callout-warning">
                      <h5>เกมจับคู่ภาพยาเลเวล 3</h5>
                      <p>จับคู่ภาพยาทั้งหมด 8 คู่ มีเวลา 2 นาที (120 วินาที) ในการเล่น</p>
                      <div class="row">
                        <div class="col-sm-12">
                          <img src="../img/game/G2/3.png" class="rounded" style="width: 100%; display: block; margin-left: auto; margin-right: auto;" />
                        </div>
                      </div>
                    </div>

                    <div class="callout callout-warning">
                      <h5>เกมจับคู่ภาพยาเลเวล 4</h5>
                      <p>จับคู่ภาพยาทั้งหมด 10 คู่ มีเวลา 3 นาที (180 วินาที) ในการเล่น</p>
                      <div class="row">
                        <div class="col-sm-12">
                          <img src="../img/game/G2/4.png" class="rounded" style="width: 100%; display: block; margin-left: auto; margin-right: auto;" />
                        </div>
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