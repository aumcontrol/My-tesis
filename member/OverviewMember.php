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


          <!-- การ์ด Chart -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                  <!-- เกมจับคู่ภาพยา เลเวล 1 -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">เกมจับคู่ภาพยา เลเวล 1</h3>

                      <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#bar" data-toggle="tab">Bar</a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stacked" data-toggle="tab">Stacked</a>
                          </li>
                          <li class="nav-item ">
                            <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#line" data-toggle="tab">Line</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="card-body">

                      <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane" id="bar">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 1 AND (status_game2 = 'Success' || status_game2 = 'Stop')  ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart1" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart1').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'bar',
                                labels: [<?php echo $user;  ?>],
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    data: [<?php echo $scorePlus; ?>],
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    data: [<?php echo $scoreSub; ?>],
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    data: [<?php echo $time; ?>],
                                  }],
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
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 1 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart11" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart11').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'bar',
                                labels: [<?php echo $user;  ?>],
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    stack: 'Stack 0',
                                    data: [<?php echo $scorePlus; ?>],
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    stack: 'Stack 0',
                                    data: [<?php echo $scoreSub; ?>],
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    stack: 'Stack 1',
                                    data: [<?php echo $time; ?>],
                                  }],
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
                        <div class="chart tab-pane active" id="line">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 1 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart111" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart111').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    data: [<?php echo $scorePlus; ?>],
                                    borderColor: "#1C3059",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    data: [<?php echo $scoreSub; ?>],
                                    borderColor: "#BF213E",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    data: [<?php echo $time; ?>],
                                    borderColor: "#EACED2",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }],
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

                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                  <!-- เกมจับคู่ภาพยา เลเวล 3 -->
                  <div class="card card-success">
                    <div class="card-header">
                      <h3 class="card-title">เกมจับคู่ภาพยา เลเวล 3</h3>

                      <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#bar3" data-toggle="tab">Bar</a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stacked3" data-toggle="tab">Stacked</a>
                          </li>
                          <li class="nav-item ">
                            <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#line3" data-toggle="tab">Line</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="card-body">

                      <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane" id="bar3">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 3 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart3" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart3').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'bar',
                                labels: [<?php echo $user;  ?>],
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    data: [<?php echo $scorePlus; ?>],
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    data: [<?php echo $scoreSub; ?>],
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    data: [<?php echo $time; ?>],
                                  }],
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

                        <div class="chart tab-pane" id="stacked3">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 3 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart33" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart33').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'bar',
                                labels: [<?php echo $user;  ?>],
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    stack: 'Stack 0',
                                    data: [<?php echo $scorePlus; ?>],
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    stack: 'Stack 0',
                                    data: [<?php echo $scoreSub; ?>],
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    stack: 'Stack 1',
                                    data: [<?php echo $time; ?>],
                                  }],
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
                        <div class="chart tab-pane active" id="line3">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 3 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart333" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart333').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    data: [<?php echo $scorePlus; ?>],
                                    borderColor: "#1C3059",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    data: [<?php echo $scoreSub; ?>],
                                    borderColor: "#BF213E",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    data: [<?php echo $time; ?>],
                                    borderColor: "#EACED2",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }],
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

                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->



                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-6">
                  <!-- เกมจับคู่ภาพยา เลเวล 2 -->
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title">เกมจับคู่ภาพยา เลเวล 2</h3>

                      <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#bar2" data-toggle="tab">Bar</a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stacked2" data-toggle="tab">Stacked</a>
                          </li>
                          <li class="nav-item ">
                            <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#line2" data-toggle="tab">Line</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="card-body">

                      <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane" id="bar2">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 2 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart2" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart2').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'bar',
                                labels: [<?php echo $user;  ?>],
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    data: [<?php echo $scorePlus; ?>],
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    data: [<?php echo $scoreSub; ?>],
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    data: [<?php echo $time; ?>],
                                  }],
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

                        <div class="chart tab-pane" id="stacked2">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 2 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart22" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart22').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'bar',
                                labels: [<?php echo $user;  ?>],
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    stack: 'Stack 0',
                                    data: [<?php echo $scorePlus; ?>],
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    stack: 'Stack 0',
                                    data: [<?php echo $scoreSub; ?>],
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    stack: 'Stack 1',
                                    data: [<?php echo $time; ?>],
                                  }],
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
                        <div class="chart tab-pane active" id="line2">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 2 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart222" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart222').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    data: [<?php echo $scorePlus; ?>],
                                    borderColor: "#1C3059",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    data: [<?php echo $scoreSub; ?>],
                                    borderColor: "#BF213E",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    data: [<?php echo $time; ?>],
                                    borderColor: "#EACED2",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }],
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

                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                  <!-- เกมจับคู่ภาพยา เลเวล 4 -->
                  <div class="card card-warning">
                    <div class="card-header">
                      <h3 class="card-title">เกมจับคู่ภาพยา เลเวล 4</h3>

                      <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#bar4" data-toggle="tab">Bar</a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stacked4" data-toggle="tab">Stacked</a>
                          </li>
                          <li class="nav-item ">
                            <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#line4" data-toggle="tab">Line</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="card-body">

                      <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane" id="bar4">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 4 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql); 

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart4" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart4').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'bar',
                                labels: [<?php echo $user;  ?>],
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    data: [<?php echo $scorePlus; ?>],
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    data: [<?php echo $scoreSub; ?>],
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    data: [<?php echo $time; ?>],
                                  }],
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

                        <div class="chart tab-pane" id="stacked4">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 4 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart44" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart44').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'bar',
                                labels: [<?php echo $user;  ?>],
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    stack: 'Stack 0',
                                    data: [<?php echo $scorePlus; ?>],
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    stack: 'Stack 0',
                                    data: [<?php echo $scoreSub; ?>],
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    stack: 'Stack 1',
                                    data: [<?php echo $time; ?>],
                                  }],
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
                        <div class="chart tab-pane active" id="line4">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game2_table WHERE level_id = 4 AND (status_game2 = 'Success' || status_game2 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
                            $query = mysqli_query($conn, $sql);

                            $scorePlus = array();
                            $scoreSub = array();
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
                              $scorePlus[] = "\"" . $rs['score_game2_plus'] . "\"";
                              $scoreSub[] = "\"" . $rs['score_game2_sub'] . "\"";
                              $time[] = "\"" . $rs['time_game2'] . "\"";
                              // $user[] = "\"" . $rs['hn_id'] . "\"";
                            }
                            $scorePlus = implode(",", $scorePlus);
                            $scoreSub = implode(",", $scoreSub);
                            $time = implode(",", $time);
                            $user = implode(",", $user);

                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                            <canvas id="myChart444" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart444').getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                  labels: [<?php echo $user;  ?>],
                                  datasets: [{
                                    label: 'คะแนนจับคู่ถูก',
                                    backgroundColor: "#1C3059",
                                    data: [<?php echo $scorePlus; ?>],
                                    borderColor: "#1C3059",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }, {
                                    label: 'คะแนนจับคู่ผิด',
                                    backgroundColor: "#BF213E",
                                    data: [<?php echo $scoreSub; ?>],
                                    borderColor: "#BF213E",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }, {
                                    label: 'เวลาที่ใช้ไป(s)',
                                    backgroundColor: "#EACED2",
                                    data: [<?php echo $time; ?>],
                                    borderColor: "#EACED2",
                                    fill: false,
                                    cubicInterpolationMode: 'monotone',
                                    tension: 0.5
                                  }],
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

                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                </div>
                <!-- /.col (RIGHT) -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- จบการ์ด Chart -->

          <!-- Accordion -->
          <div class="card card-pink">
            <div class="card-header">
              <h3 class="card-title">ตารางข้อมูลเกมจับคู่ภาพยา เลเวล 1-4</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="accordion">
                <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

                <div class="card card-primary">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a class="card-link" data-toggle="collapse" href="#collapse1">
                        ข้อมูลเกมจับคู่ภาพยา เลเวล 1
                    </h4>
                    </a>
                  </div>
                  <div id="collapse1" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                      <!-- table details -->
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>รหัสประจำตัว</th>
                              <th>ชื่อ</th>
                              <th>นามสกุล</th>
                              <th>คะแนนจับคู่ถูก</th>
                              <th>คะแนนจับคู่ผิด</th>
                              <th>เวลาที่ใช้ไป(s)</th>
                              <th>วันที่เล่น</th>
                              <th>สถานะ</th>
                              <th>จัดการ</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = "SELECT * , DATE_FORMAT(create_at, '%d-%m-%Y %H:%i:%s') AS create_at FROM play_game2_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE level_id=1  ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d %H:%i:%s') DESC";
                            // $sql = "SELECT * FROM play_game2_table WHERE hn_id = $id";
                            $result = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                              <tr>
                                <td><?= $data['hn_id']; ?></td>
                                <td><?= $data['first_name']; ?></td>
                                <td><?= $data['last_name']; ?></td>
                                <td><?= $data['score_game2_plus']; ?></td>
                                <td><?= $data['score_game2_sub']; ?></td>
                                <td><?= $data['time_game2']; ?></td>
                                <td><?= $data['create_at']; ?></td>
                                <td><?= $data['status_game2']; ?></td>
                                <td>
                                  <div class='text-center'><a href="ViewGame2?play_id=<?= $data['play_id']; ?>" target="_blank" style="color: black;" title="View Record"><i class='fa fa-eye black'></i></a></div>
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

                <div class="card card-danger">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a class="card-link" data-toggle="collapse" href="#collapse2">
                        ข้อมูลเกมจับคู่ภาพยา เลเวล 2
                    </h4>
                    </a>
                  </div>
                  <div id="collapse2" class="collapse" data-parent="#accordion">
                    <div class="card-body">

                      <!-- table details -->
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>รหัสประจำตัว</th>
                              <th>ชื่อ</th>
                              <th>นามสกุล</th>
                              <th>คะแนนจับคู่ถูก</th>
                              <th>คะแนนจับคู่ผิด</th>
                              <th>เวลาที่ใช้ไป(s)</th>
                              <th>วันที่เล่น</th>
                              <th>สถานะ</th>
                              <th>จัดการ</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = "SELECT * , DATE_FORMAT(create_at, '%d-%m-%Y %H:%i:%s') AS create_at FROM play_game2_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE level_id=2  ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d %H:%i:%s') DESC";
                            // $sql = "SELECT * FROM play_game2_table WHERE hn_id = $id";
                            $result = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                              <tr>
                                <td><?= $data['hn_id']; ?></td>
                                <td><?= $data['first_name']; ?></td>
                                <td><?= $data['last_name']; ?></td>
                                <td><?= $data['score_game2_plus']; ?></td>
                                <td><?= $data['score_game2_sub']; ?></td>
                                <td><?= $data['time_game2']; ?></td>
                                <td><?= $data['create_at']; ?></td>
                                <td><?= $data['status_game2']; ?></td>
                                <td>
                                  <div class='text-center'><a href="ViewGame2?play_id=<?= $data['play_id']; ?>" target="_blank" style="color: black;" title="View Record"><i class='fa fa-eye black'></i></a></div>
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

                <div class="card card-success">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a class="card-link" data-toggle="collapse" href="#collapse3">
                        ข้อมูลเกมจับคู่ภาพยา เลเวล 3
                    </h4>
                    </a>
                  </div>
                  <div id="collapse3" class="collapse" data-parent="#accordion">
                    <div class="card-body">

                      <!-- table details -->
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>รหัสประจำตัว</th>
                              <th>ชื่อ</th>
                              <th>นามสกุล</th>
                              <th>คะแนนจับคู่ถูก</th>
                              <th>คะแนนจับคู่ผิด</th>
                              <th>เวลาที่ใช้ไป(s)</th>
                              <th>วันที่เล่น</th>
                              <th>สถานะ</th>
                              <th>จัดการ</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = "SELECT * , DATE_FORMAT(create_at, '%d-%m-%Y %H:%i:%s') AS create_at FROM play_game2_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE level_id=3  ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d %H:%i:%s') DESC";
                            // $sql = "SELECT * FROM play_game2_table WHERE hn_id = $id";
                            $result = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                              <tr>
                                <td><?= $data['hn_id']; ?></td>
                                <td><?= $data['first_name']; ?></td>
                                <td><?= $data['last_name']; ?></td>
                                <td><?= $data['score_game2_plus']; ?></td>
                                <td><?= $data['score_game2_sub']; ?></td>
                                <td><?= $data['time_game2']; ?></td>
                                <td><?= $data['create_at']; ?></td>
                                <td><?= $data['status_game2']; ?></td>
                                <td>
                                  <div class='text-center'><a href="ViewGame2?play_id=<?= $data['play_id']; ?>" target="_blank" style="color: black;" title="View Record"><i class='fa fa-eye black'></i></a></div>
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

                <div class="card card-warning">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a class="card-link" data-toggle="collapse" href="#collapse4">
                        ข้อมูลเกมจับคู่ภาพยา เลเวล 4
                    </h4>
                    </a>
                  </div>
                  <div id="collapse4" class="collapse" data-parent="#accordion">
                    <div class="card-body">

                      <!-- table details -->
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable4" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>รหัสประจำตัว</th>
                              <th>ชื่อ</th>
                              <th>นามสกุล</th>
                              <th>คะแนนจับคู่ถูก</th>
                              <th>คะแนนจับคู่ผิด</th>
                              <th>เวลาที่ใช้ไป(s)</th>
                              <th>วันที่เล่น</th>
                              <th>สถานะ</th>
                              <th>จัดการ</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = "SELECT * , DATE_FORMAT(create_at, '%d-%m-%Y %H:%i:%s') AS create_at FROM play_game2_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE level_id=4  ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d %H:%i:%s') DESC";
                            // $sql = "SELECT * FROM play_game2_table WHERE hn_id = $id";
                            $result = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                              <tr>
                                <td><?= $data['hn_id']; ?></td>
                                <td><?= $data['first_name']; ?></td>
                                <td><?= $data['last_name']; ?></td>
                                <td><?= $data['score_game2_plus']; ?></td>
                                <td><?= $data['score_game2_sub']; ?></td>
                                <td><?= $data['time_game2']; ?></td>
                                <td><?= $data['create_at']; ?></td>
                                <td><?= $data['status_game2']; ?></td>
                                <td>
                                  <div class='text-center'><a href="ViewGame2?play_id=<?= $data['play_id']; ?>" target="_blank" style="color: black;" title="View Record"><i class='fa fa-eye black'></i></a></div>
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
            </div>
            <!-- /.card-body -->
          </div>
          <!-- จบ Accordion -->



          <!-- การ์ด Chart -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                  <!-- เกมปริศนายา เลเวล 1 -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">เกมปริศนายา เลเวล 1</h3>
                      <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#bar5" data-toggle="tab">Bar</a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stacked5" data-toggle="tab">Stacked</a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#line5" data-toggle="tab">Line</a>
                          </li>
                        </ul>
                      </div>

                    </div>
                    <div class="card-body">

                      <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane" id="bar5">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game3_table WHERE level_id = 1 AND (status_game3 = 'Success' || status_game3 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
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

                            <canvas id="myChart5" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart5').getContext('2d');
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
                        <div class="chart tab-pane" id="stacked5">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game3_table WHERE level_id = 1 AND (status_game3 = 'Success' || status_game3 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
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

                            <canvas id="myChart55" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart55').getContext('2d');
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

                        <div class="chart tab-pane active" id="line5">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game3_table WHERE level_id = 1 AND (status_game3 = 'Success' || status_game3 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
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

                            <canvas id="myChart555" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart555').getContext('2d');
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

                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                  <!-- เกมปริศนายา เลเวล 3 -->
                  <div class="card card-success">
                    <div class="card-header">
                      <h3 class="card-title">เกมปริศนายา เลเวล 3</h3>
                      <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#bar7" data-toggle="tab">Bar</a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stacked7" data-toggle="tab">Stacked</a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#line7" data-toggle="tab">Line</a>
                          </li>
                        </ul>
                      </div>

                    </div>
                    <div class="card-body">

                      <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane" id="bar7">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game3_table WHERE level_id = 3 AND (status_game3 = 'Success' || status_game3 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
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

                            <canvas id="myChart7" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart7').getContext('2d');
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
                        <div class="chart tab-pane" id="stacked7">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game3_table WHERE level_id = 3 AND (status_game3 = 'Success' || status_game3 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
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

                            <canvas id="myChart77" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart77').getContext('2d');
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

                        <div class="chart tab-pane active" id="line7">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game3_table WHERE level_id = 3 AND (status_game3 = 'Success' || status_game3 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
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

                            <canvas id="myChart777" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart777').getContext('2d');
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

                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->


                </div>
                <!-- /.col (LEFT) -->


                <div class="col-md-6">
                  <!-- เกมปริศนายา เลเวล 2 -->
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title">เกมปริศนายา เลเวล 2</h3>
                      <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#bar6" data-toggle="tab">Bar</a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stacked6" data-toggle="tab">Stacked</a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#line6" data-toggle="tab">Line</a>
                          </li>
                        </ul>
                      </div>

                    </div>
                    <div class="card-body">

                      <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane" id="bar6">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game3_table WHERE level_id = 2 AND (status_game3 = 'Success' || status_game3 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
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

                            <canvas id="myChart6" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart6').getContext('2d');
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
                        <div class="chart tab-pane" id="stacked6">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game3_table WHERE level_id = 2 AND (status_game3 = 'Success' || status_game3 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
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

                            <canvas id="myChart66" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart66').getContext('2d');
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

                        <div class="chart tab-pane active" id="line6">
                          <div class="chart">
                            <!-- php chart -->
                            <?php
                            include('../connection.php');
                            $sql = "SELECT * FROM play_game3_table WHERE level_id = 2 AND (status_game3 = 'Success' || status_game3 = 'Stop') ORDER BY create_at DESC LIMIT 0,10";
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

                            <canvas id="myChart666" width="300px" height="200px"></canvas>
                            <script>
                              var ctx = document.getElementById('myChart666').getContext('2d');
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

                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->


                </div>
                <!-- /.col (RIGHT) -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- จบการ์ด Chart -->


          <!-- Accordion -->
          <div class="card card-pink">
            <div class="card-header">
              <h3 class="card-title">ตารางข้อมูลเกมปริศนายา เลเวล 1-3</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="accordion1">
                <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

                <div class="card card-primary">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a class="card-link" data-toggle="collapse" href="#collapse5">
                        ข้อมูลเกมปริศนายา เลเวล 1
                    </h4>
                    </a>
                  </div>
                  <div id="collapse5" class="collapse" data-parent="#accordion1">
                    <div class="card-body">
                      <!-- table details -->
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable5" width="100%" cellspacing="0">
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
                            $sql = "SELECT * , DATE_FORMAT(create_at, '%d-%m-%Y %H:%i:%s') AS create_at FROM play_game3_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE level_id=1  ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d %H:%i:%s') DESC";
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
                                  <div class='text-center'><a href="ViewGame3?play_id=<?= $data['play_id']; ?>" target="_blank" style="color: black;" title="View Record"><i class='fa fa-eye black'></i></a></div>
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

                <div class="card card-danger">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a class="card-link" data-toggle="collapse" href="#collapse6">
                        ข้อมูลเกมปริศนายา เลเวล 2
                    </h4>
                    </a>
                  </div>
                  <div id="collapse6" class="collapse" data-parent="#accordion1">
                    <div class="card-body">
                      <!-- table details -->
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable6" width="100%" cellspacing="0">
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
                            $sql = "SELECT * , DATE_FORMAT(create_at, '%d-%m-%Y %H:%i:%s') AS create_at FROM play_game3_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE level_id=2  ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d %H:%i:%s') DESC";
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
                                  <div class='text-center'><a href="ViewGame3?play_id=<?= $data['play_id']; ?>" target="_blank" style="color: black;" title="View Record"><i class='fa fa-eye black'></i></a></div>
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

                <div class="card card-success">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a class="card-link" data-toggle="collapse" href="#collapse7">
                        ข้อมูลเกมปริศนายา เลเวล 3
                    </h4>
                    </a>
                  </div>
                  <div id="collapse7" class="collapse" data-parent="#accordion1">
                    <div class="card-body">
                      <!-- table details -->
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable7" width="100%" cellspacing="0">
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
                            $sql = "SELECT * , DATE_FORMAT(create_at, '%d-%m-%Y %H:%i:%s') AS create_at FROM play_game3_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE level_id=3  ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d %H:%i:%s') DESC";
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
                                  <div class='text-center'><a href="ViewGame3?play_id=<?= $data['play_id']; ?>" target="_blank" style="color: black;" title="View Record"><i class='fa fa-eye black'></i></a></div>
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
            </div>
            <!-- /.card-body -->
          </div>
          <!-- จบ Accordion -->






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