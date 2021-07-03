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
    <!-- CSS Print -->
    <link rel="stylesheet" href="../css/print.css" media="print">

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

  </head>

  <body class="sb-nav-fixed">

    <div id="layoutSidenav">
      <div id="layoutSidenav_content">

        <?php
        include('navbar_admin.php');
        ?>
        <div class="container-fluid" style="margin-top: 20px;">
          <?php
          $play_id = $_GET['play_id'];
          // "---".$id ;
          ?>
          <div class="card card-lightGray mb-4">
            <div class="card-header" style="font-size: 18px; color:black;">
              <i class="fas fa-gamepad mr-1"></i>

              <?php
              $sql = "SELECT * FROM play_game3_table  WHERE play_id=$play_id ";
              $result = mysqli_query($conn, $sql);
              while ($data = mysqli_fetch_array($result)) {
              ?>
                เกมปริศนายา เลเวล <?= $data['level_id']; ?>
              <?php } ?>

              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="btn btn-dark" style="width: 80px; height:40px; margin-right:5px; color:white; font-size:15px;" href="#bar" data-toggle="tab">Bar</a>
                  </li>
                  <li class="nav-item">
                    <a class="btn btn-dark" style="width: 80px; height:40px; margin-right:5px; color:white; font-size:15px;" href="#stacked" data-toggle="tab">Stacked</a>
                  </li>
                  <li class="nav-item">
                    <a class="btn btn-dark" style="width: 80px; height:40px; margin-right:5px; color:white; font-size:15px;" href="#line" data-toggle="tab">Line</a>
                  </li>
                </ul>
              </div>


            </div>
            <div class="card-body">
              <div class="table-responsive">

                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="bar">
                    <div class="chart">
                      <!-- php chart -->
                      <?php
                      include('../connection.php');
                      $sql = "SELECT * FROM play_game3_table WHERE play_id=$play_id ";
                      $query = mysqli_query($conn, $sql);

                      $scoreGame3 = array();
                      $time = array();
                      $user = array();
                      $user1 = array();
                      while ($rs = mysqli_fetch_array($query)) {

                        $hn_id = $rs['hn_id'];
                        $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($rs_user = mysqli_fetch_array($query_user)) {
                          $user[] = "\"" . $rs_user['first_name'] . "\"";
                        }
                        $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                        $time[] = "\"" . $rs['time_game3'] . "\"";
                        // $user[] = "\"" . $rs['hn_id'] . "\"";
                      }
                      $scoreGame3 = implode(",", $scoreGame3);
                      $time = implode(",", $time);
                      $user = implode(",", $user);

                      ?>

                      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                      <canvas id="myChart" width="1200px" height="400px"></canvas>
                      <script>
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                            labels: [<?php echo $user;  ?>],
                            datasets: [{
                                label: 'คะแนน',
                                backgroundColor: "#1C3059",
                                data: [<?php echo $scoreGame3 ?>],
                              },
                              {
                                label: 'เวลาที่ใช้ไป(s)',
                                backgroundColor: "#EACED2",
                                data: [<?php echo $time; ?>],
                              }
                            ],
                          },
                          options: {
                            scales: {
                              yAxes: [{
                                ticks: {
                                  beginAtZero: true
                                }
                              }]
                            }
                          }
                        });
                      </script>
                      <!-- จบ php chart -->
                    </div>


                  </div>
                  <div class="chart tab-pane" id="stacked">
                    <div class="chart">
                      <!-- php chart -->
                      <?php
                      include('../connection.php');
                      $sql = "SELECT * FROM play_game3_table WHERE play_id=$play_id ";
                      $query = mysqli_query($conn, $sql);

                      $scoreGame3 = array();
                      $time = array();
                      $user = array();
                      $user1 = array();
                      while ($rs = mysqli_fetch_array($query)) {

                        $hn_id = $rs['hn_id'];
                        $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($rs_user = mysqli_fetch_array($query_user)) {
                          $user[] = "\"" . $rs_user['first_name'] . "\"";
                        }
                        $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                        $time[] = "\"" . $rs['time_game3'] . "\"";
                        // $user[] = "\"" . $rs['hn_id'] . "\"";
                      }
                      $scoreGame3 = implode(",", $scoreGame3);
                      $time = implode(",", $time);
                      $user = implode(",", $user);

                      ?>

                      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                      <canvas id="myChart11" width="1200px" height="400px"></canvas>
                      <script>
                        var ctx = document.getElementById('myChart11').getContext('2d');
                        var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                            labels: [<?php echo $user;  ?>],
                            datasets: [{
                                label: 'คะแนน',
                                backgroundColor: "#1C3059",
                                data: [<?php echo $scoreGame3 ?>],
                              },
                              {
                                label: 'เวลาที่ใช้ไป(s)',
                                backgroundColor: "#EACED2",
                                data: [<?php echo $time; ?>],
                              }
                            ],
                          },
                          options: {
                            scales: {
                              xAxes: [{
                                stacked: true
                              }],
                              yAxes: [{
                                stacked: true
                              }]
                            }
                          }
                        });
                      </script>
                      <!-- จบ php chart -->
                    </div>


                  </div>

                  <div class="chart tab-pane" id="line">
                    <div class="chart">
                      <!-- php chart -->
                      <?php
                      include('../connection.php');
                      $sql = "SELECT * FROM play_game3_table WHERE play_id=$play_id ";
                      $query = mysqli_query($conn, $sql);

                      $scoreGame3 = array();
                      $time = array();
                      $user = array();
                      $user1 = array();
                      while ($rs = mysqli_fetch_array($query)) {

                        $hn_id = $rs['hn_id'];
                        $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($rs_user = mysqli_fetch_array($query_user)) {
                          $user[] = "\"" . $rs_user['first_name'] . "\"";
                        }
                        $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                        $time[] = "\"" . $rs['time_game3'] . "\"";
                        // $user[] = "\"" . $rs['hn_id'] . "\"";
                      }
                      $scoreGame3 = implode(",", $scoreGame3);
                      $time = implode(",", $time);
                      $user = implode(",", $user);

                      ?>

                      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                      <canvas id="myChart111" width="1200px" height="400px"></canvas>
                      <script>
                        var ctx = document.getElementById('myChart111').getContext('2d');
                        var myChart = new Chart(ctx, {
                          type: 'line',
                          data: {
                            labels: [<?php echo $user;  ?>],
                            datasets: [{
                                label: 'คะแนน',
                                backgroundColor: "#1C3059",
                                data: [<?php echo $scoreGame3 ?>],
                                borderColor: "#1C3059",
                                fill: false,
                                cubicInterpolationMode: 'monotone',
                                tension: 0.5
                              },
                              {
                                label: 'เวลาที่ใช้ไป(s)',
                                backgroundColor: "#EACED2",
                                data: [<?php echo $time; ?>],
                                borderColor: "#EACED2",
                                fill: false,
                                cubicInterpolationMode: 'monotone',
                                tension: 0.5
                              }
                            ],
                          },
                          options: {
                            tooltips: {
                              mode: 'x-axis'
                            },
                            scales: {
                              x: {
                                display: true,
                                scaleLabel: {
                                  display: true
                                }
                              },
                              y: {
                                display: true,
                                scaleLabel: {
                                  display: true,
                                  labelString: 'Value'
                                }
                              }
                            }
                          }
                        });
                      </script>
                      <!-- จบ php chart -->
                    </div>


                  </div>

                </div>





                <table class="table table-bordered" width="100%" cellspacing="0" style="margin-top: 50px;">
                  <thead>
                    <tr>
                      <th>รหัสประจำตัว</th>
                      <th>ชื่อ</th>
                      <th>นามสกุล</th>
                      <th>คะแนน</th>
                      <th>เวลาที่ใช้ไป(s)</th>
                      <th>วันที่เล่น</th>
                      <th>สถานะ</th>
                      <th>จัดการ</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * , DATE_FORMAT(create_at, '%d-%m-%Y %H:%i:%s') AS create_at FROM play_game3_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE play_id=$play_id ";
                    // $sql = "SELECT * FROM play_game2_table WHERE hn_id = $id";
                    $result = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                      <tr>
                        <td><?= $data['hn_id']; ?></td>
                        <td><?= $data['first_name']; ?></td>
                        <td><?= $data['last_name']; ?></td>
                        <td><?= $data['score_game3']; ?></td>
                        <td><?= $data['time_game3']; ?></td>
                        <td><?= $data['create_at']; ?></td>
                        <td><?= $data['status_game3']; ?></td>
                        <td>
                          <div class='text-center' style="color: black;" title="Print" id="print" onclick="window.print()"><i class='fa fa-print black'></i></div>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>

              </div>
              <!-- จบ table details -->
            </div>
          </div>




        </div>
      </div>
  </body>

  </html>
  <script src="../js/navbar.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="../js/datatables-demo.js"></script>


<?php } ?>