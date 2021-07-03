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
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#barM" data-toggle="tab">Bar</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stackedM" data-toggle="tab">Stacked</a>
                </li>
                <li class="nav-item ">
                  <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#lineM" data-toggle="tab">Line</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">

            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane" id="barM">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 1 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM1" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM1').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at; ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          data: [<?php echo $scorePlus; ?>],
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          data: [<?php echo $scoreSub; ?>],
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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

              <div class="chart tab-pane" id="stackedM">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 1 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM11" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM11').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          stack: 'Stack 0',
                          data: [<?php echo $scorePlus; ?>],
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          stack: 'Stack 0',
                          data: [<?php echo $scoreSub; ?>],
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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
              <div class="chart tab-pane active" id="lineM">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 1 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM111" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM111').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          data: [<?php echo $scorePlus; ?>],
                          borderColor: "#1C3059",
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          data: [<?php echo $scoreSub; ?>],
                          borderColor: "#BF213E",
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#barM3" data-toggle="tab">Bar</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stackedM3" data-toggle="tab">Stacked</a>
                </li>
                <li class="nav-item ">
                  <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#lineM3" data-toggle="tab">Line</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">

            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane" id="barM3">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 3 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM3" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM3').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at; ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          data: [<?php echo $scorePlus; ?>],
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          data: [<?php echo $scoreSub; ?>],
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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

              <div class="chart tab-pane" id="stackedM3">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 3 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM33" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM33').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          stack: 'Stack 0',
                          data: [<?php echo $scorePlus; ?>],
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          stack: 'Stack 0',
                          data: [<?php echo $scoreSub; ?>],
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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
              <div class="chart tab-pane active" id="lineM3">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 3 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM333" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM333').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          data: [<?php echo $scorePlus; ?>],
                          borderColor: "#1C3059",
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          data: [<?php echo $scoreSub; ?>],
                          borderColor: "#BF213E",
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#barM2" data-toggle="tab">Bar</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stackedM2" data-toggle="tab">Stacked</a>
                </li>
                <li class="nav-item ">
                  <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#lineM2" data-toggle="tab">Line</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">

            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane" id="barM2">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 2 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM2" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM2').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at; ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          data: [<?php echo $scorePlus; ?>],
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          data: [<?php echo $scoreSub; ?>],
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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

              <div class="chart tab-pane" id="stackedM2">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 2 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM22" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM22').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          stack: 'Stack 0',
                          data: [<?php echo $scorePlus; ?>],
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          stack: 'Stack 0',
                          data: [<?php echo $scoreSub; ?>],
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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

              <div class="chart tab-pane active" id="lineM2">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 2 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM222" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM222').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          data: [<?php echo $scorePlus; ?>],
                          borderColor: "#1C3059",
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          data: [<?php echo $scoreSub; ?>],
                          borderColor: "#BF213E",
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#barM4" data-toggle="tab">Bar</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stackedM4" data-toggle="tab">Stacked</a>
                </li>
                <li class="nav-item ">
                  <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#lineM4" data-toggle="tab">Line</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">

            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane" id="barM4">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 4 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM4" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM4').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at; ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          data: [<?php echo $scorePlus; ?>],
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          data: [<?php echo $scoreSub; ?>],
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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

              <div class="chart tab-pane" id="stackedM4">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 4 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM44" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM44').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          stack: 'Stack 0',
                          data: [<?php echo $scorePlus; ?>],
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          stack: 'Stack 0',
                          data: [<?php echo $scoreSub; ?>],
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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
              <div class="chart tab-pane active" id="lineM4">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $id  AND level_id = 4 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scorePlus = array();
                  $scoreSub = array();
                  $time = array();
                  $user = array();
                  $create_at = array();
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
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scorePlus = implode(",", $scorePlus);
                  $scoreSub = implode(",", $scoreSub);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM444" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM444').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                          label: 'รวมคะแนนจับคู่ถูก',
                          backgroundColor: "#1C3059",
                          data: [<?php echo $scorePlus; ?>],
                          borderColor: "#1C3059",
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }, {
                          label: 'รวมคะแนนจับคู่ผิด',
                          backgroundColor: "#BF213E",
                          data: [<?php echo $scoreSub; ?>],
                          borderColor: "#BF213E",
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }, {
                          label: 'รวมเวลาที่ใช้ไป(s)',
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
    <div id="accordionM">
      <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

      <div class="card card-primary">
        <div class="card-header">
          <h4 class="card-title">
            <a class="card-link" data-toggle="collapse" href="#collapseM1">
              ข้อมูลเกมจับคู่ภาพยา เลเวล 1
          </h4>
          </a>
        </div>
        <div id="collapseM1" class="collapse" data-parent="#accordionM">
          <div class="card-body">
            <!-- table details -->
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable8" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>รวมคะแนนจับคู่ถูก</th>
                    <th>รวมคะแนนจับคู่ผิด</th>
                    <th>รวมเวลาที่ใช้ไป(s)</th>
                    <th>เดือน/ปีที่เล่น</th>
                    <th>เล่นทั้งหมดกี่ครั้ง</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * ,COUNT(play_id), SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE g.hn_id = $id  AND level_id=1
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC";
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
                      <td><?= $data['COUNT(play_id)']; ?></td>
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
            <a class="card-link" data-toggle="collapse" href="#collapseM2">
              ข้อมูลเกมจับคู่ภาพยา เลเวล 2
          </h4>
          </a>
        </div>
        <div id="collapseM2" class="collapse" data-parent="#accordionM">
          <div class="card-body">

            <!-- table details -->
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable9" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>รวมคะแนนจับคู่ถูก</th>
                    <th>รวมคะแนนจับคู่ผิด</th>
                    <th>รวมเวลาที่ใช้ไป(s)</th>
                    <th>เดือน/ปีที่เล่น</th>
                    <th>เล่นทั้งหมดกี่ครั้ง</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * ,COUNT(play_id), SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE g.hn_id = $id  AND level_id=2
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC";
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
                      <td><?= $data['COUNT(play_id)']; ?></td>
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
            <a class="card-link" data-toggle="collapse" href="#collapseM3">
              ข้อมูลเกมจับคู่ภาพยา เลเวล 3
          </h4>
          </a>
        </div>
        <div id="collapseM3" class="collapse" data-parent="#accordionM">
          <div class="card-body">

            <!-- table details -->
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable10" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>รวมคะแนนจับคู่ถูก</th>
                    <th>รวมคะแนนจับคู่ผิด</th>
                    <th>รวมเวลาที่ใช้ไป(s)</th>
                    <th>เดือน/ปีที่เล่น</th>
                    <th>เล่นทั้งหมดกี่ครั้ง</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * ,COUNT(play_id), SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE g.hn_id = $id  AND level_id=3
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC";
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
                      <td><?= $data['COUNT(play_id)']; ?></td>
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
            <a class="card-link" data-toggle="collapse" href="#collapseM4">
              ข้อมูลเกมจับคู่ภาพยา เลเวล 4
          </h4>
          </a>
        </div>
        <div id="collapseM4" class="collapse" data-parent="#accordionM">
          <div class="card-body">

            <!-- table details -->
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable11" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>รวมคะแนนจับคู่ถูก</th>
                    <th>รวมคะแนนจับคู่ผิด</th>
                    <th>รวมเวลาที่ใช้ไป(s)</th>
                    <th>เดือน/ปีที่เล่น</th>
                    <th>เล่นทั้งหมดกี่ครั้ง</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * ,COUNT(play_id), SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game2_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE g.hn_id = $id  AND level_id=4
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC";
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
                      <td><?= $data['COUNT(play_id)']; ?></td>
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
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#barM5" data-toggle="tab">Bar</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stackedM5" data-toggle="tab">Stacked</a>
                </li>
                <li class="nav-item ">
                  <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#lineM5" data-toggle="tab">Line</a>
                </li>
              </ul>
            </div>

          </div>
          <div class="card-body">

            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane" id="barM5">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  // $sql = "SELECT * FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 ORDER BY create_at DESC LIMIT 0,10";
                  $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scoreGame3 = array();
                  $time = array();
                  $user = array();
                  $create_at = array();

                  while ($rs = mysqli_fetch_array($query)) {

                    $hn_id = $rs['hn_id'];
                    $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                    $query_user = mysqli_query($conn, $sql_user);
                    while ($rs_user = mysqli_fetch_array($query_user)) {
                      $user[] = "\"" . $rs_user['first_name'] . "\"";
                    }
                    $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                    $time[] = "\"" . $rs['time_game3'] . "\"";
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scoreGame3 = implode(",", $scoreGame3);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM5" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM5').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                            label: 'รวมคะแนนทั้งหมด',
                            backgroundColor: "#1C3059",
                            data: [<?php echo $scoreGame3 ?>],
                          },
                          {
                            label: 'รวมเวลาที่ใช้ไป(s)',
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
              <div class="chart tab-pane" id="stackedM5">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  // $sql = "SELECT * FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 ORDER BY create_at DESC LIMIT 0,10";
                  $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scoreGame3 = array();
                  $time = array();
                  $user = array();
                  $create_at = array();

                  while ($rs = mysqli_fetch_array($query)) {

                    $hn_id = $rs['hn_id'];
                    $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                    $query_user = mysqli_query($conn, $sql_user);
                    while ($rs_user = mysqli_fetch_array($query_user)) {
                      $user[] = "\"" . $rs_user['first_name'] . "\"";
                    }
                    $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                    $time[] = "\"" . $rs['time_game3'] . "\"";
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scoreGame3 = implode(",", $scoreGame3);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM55" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM55').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                            label: 'รวมคะแนนทั้งหมด',
                            backgroundColor: "#1C3059",
                            data: [<?php echo $scoreGame3 ?>],
                          },
                          {
                            label: 'รวมเวลาที่ใช้ไป(s)',
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

              <div class="chart tab-pane active" id="lineM5">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  // $sql = "SELECT * FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 ORDER BY create_at DESC LIMIT 0,10";
                  $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scoreGame3 = array();
                  $time = array();
                  $user = array();
                  $create_at = array();

                  while ($rs = mysqli_fetch_array($query)) {

                    $hn_id = $rs['hn_id'];
                    $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                    $query_user = mysqli_query($conn, $sql_user);
                    while ($rs_user = mysqli_fetch_array($query_user)) {
                      $user[] = "\"" . $rs_user['first_name'] . "\"";
                    }
                    $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                    $time[] = "\"" . $rs['time_game3'] . "\"";
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scoreGame3 = implode(",", $scoreGame3);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM555" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM555').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                            label: 'รวมคะแนนทั้งหมด',
                            backgroundColor: "#1C3059",
                            data: [<?php echo $scoreGame3 ?>],
                            borderColor: "#1C3059",
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.5
                          },
                          {
                            label: 'รวมเวลาที่ใช้ไป(s)',
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
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#barM7" data-toggle="tab">Bar</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stackedM7" data-toggle="tab">Stacked</a>
                </li>
                <li class="nav-item ">
                  <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#lineM7" data-toggle="tab">Line</a>
                </li>
              </ul>
            </div>

          </div>
          <div class="card-body">

            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane" id="barM7">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  // $sql = "SELECT * FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 ORDER BY create_at DESC LIMIT 0,10";
                  $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $id  AND level_id = 3 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scoreGame3 = array();
                  $time = array();
                  $user = array();
                  $create_at = array();

                  while ($rs = mysqli_fetch_array($query)) {

                    $hn_id = $rs['hn_id'];
                    $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                    $query_user = mysqli_query($conn, $sql_user);
                    while ($rs_user = mysqli_fetch_array($query_user)) {
                      $user[] = "\"" . $rs_user['first_name'] . "\"";
                    }
                    $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                    $time[] = "\"" . $rs['time_game3'] . "\"";
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scoreGame3 = implode(",", $scoreGame3);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM7" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM7').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                            label: 'รวมคะแนนทั้งหมด',
                            backgroundColor: "#1C3059",
                            data: [<?php echo $scoreGame3 ?>],
                          },
                          {
                            label: 'รวมเวลาที่ใช้ไป(s)',
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
              <div class="chart tab-pane" id="stackedM7">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  // $sql = "SELECT * FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 ORDER BY create_at DESC LIMIT 0,10";
                  $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $id  AND level_id = 3 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scoreGame3 = array();
                  $time = array();
                  $user = array();
                  $create_at = array();

                  while ($rs = mysqli_fetch_array($query)) {

                    $hn_id = $rs['hn_id'];
                    $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                    $query_user = mysqli_query($conn, $sql_user);
                    while ($rs_user = mysqli_fetch_array($query_user)) {
                      $user[] = "\"" . $rs_user['first_name'] . "\"";
                    }
                    $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                    $time[] = "\"" . $rs['time_game3'] . "\"";
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scoreGame3 = implode(",", $scoreGame3);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM77" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM77').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                            label: 'รวมคะแนนทั้งหมด',
                            backgroundColor: "#1C3059",
                            data: [<?php echo $scoreGame3 ?>],
                          },
                          {
                            label: 'รวมเวลาที่ใช้ไป(s)',
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

              <div class="chart tab-pane active" id="lineM7">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  // $sql = "SELECT * FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 ORDER BY create_at DESC LIMIT 0,10";
                  $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $id  AND level_id = 3 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scoreGame3 = array();
                  $time = array();
                  $user = array();
                  $create_at = array();

                  while ($rs = mysqli_fetch_array($query)) {

                    $hn_id = $rs['hn_id'];
                    $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                    $query_user = mysqli_query($conn, $sql_user);
                    while ($rs_user = mysqli_fetch_array($query_user)) {
                      $user[] = "\"" . $rs_user['first_name'] . "\"";
                    }
                    $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                    $time[] = "\"" . $rs['time_game3'] . "\"";
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scoreGame3 = implode(",", $scoreGame3);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM777" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM777').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                            label: 'รวมคะแนนทั้งหมด',
                            backgroundColor: "#1C3059",
                            data: [<?php echo $scoreGame3 ?>],
                            borderColor: "#1C3059",
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.5
                          },
                          {
                            label: 'รวมเวลาที่ใช้ไป(s)',
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
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#barM6" data-toggle="tab">Bar</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-light" style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#stackedM6" data-toggle="tab">Stacked</a>
                </li>
                <li class="nav-item ">
                  <a class="btn btn-light " style="width: 80px; height:40px; margin-right:5px; color:black; font-size:15px;" href="#lineM6" data-toggle="tab">Line</a>
                </li>
              </ul>
            </div>

          </div>
          <div class="card-body">

            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane" id="barM6">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  // $sql = "SELECT * FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 ORDER BY create_at DESC LIMIT 0,10";
                  $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $id  AND level_id = 2 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scoreGame3 = array();
                  $time = array();
                  $user = array();
                  $create_at = array();

                  while ($rs = mysqli_fetch_array($query)) {

                    $hn_id = $rs['hn_id'];
                    $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                    $query_user = mysqli_query($conn, $sql_user);
                    while ($rs_user = mysqli_fetch_array($query_user)) {
                      $user[] = "\"" . $rs_user['first_name'] . "\"";
                    }
                    $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                    $time[] = "\"" . $rs['time_game3'] . "\"";
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scoreGame3 = implode(",", $scoreGame3);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM6" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM6').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                            label: 'รวมคะแนนทั้งหมด',
                            backgroundColor: "#1C3059",
                            data: [<?php echo $scoreGame3 ?>],
                          },
                          {
                            label: 'รวมเวลาที่ใช้ไป(s)',
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
              <div class="chart tab-pane" id="stackedM6">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  // $sql = "SELECT * FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 ORDER BY create_at DESC LIMIT 0,10";
                  $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $id  AND level_id = 2 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scoreGame3 = array();
                  $time = array();
                  $user = array();
                  $create_at = array();

                  while ($rs = mysqli_fetch_array($query)) {

                    $hn_id = $rs['hn_id'];
                    $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                    $query_user = mysqli_query($conn, $sql_user);
                    while ($rs_user = mysqli_fetch_array($query_user)) {
                      $user[] = "\"" . $rs_user['first_name'] . "\"";
                    }
                    $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                    $time[] = "\"" . $rs['time_game3'] . "\"";
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scoreGame3 = implode(",", $scoreGame3);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM66" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM66').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                            label: 'รวมคะแนนทั้งหมด',
                            backgroundColor: "#1C3059",
                            data: [<?php echo $scoreGame3 ?>],
                          },
                          {
                            label: 'รวมเวลาที่ใช้ไป(s)',
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

              <div class="chart tab-pane active" id="lineM6">
                <div class="chart">
                  <!-- php chart -->
                  <?php
                  include('../connection.php');
                  // $sql = "SELECT * FROM play_game3_table WHERE hn_id = $id  AND level_id = 1 ORDER BY create_at DESC LIMIT 0,10";
                  $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $id  AND level_id = 2 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC LIMIT 0,12";
                  $query = mysqli_query($conn, $sql);

                  $scoreGame3 = array();
                  $time = array();
                  $user = array();
                  $create_at = array();

                  while ($rs = mysqli_fetch_array($query)) {

                    $hn_id = $rs['hn_id'];
                    $sql_user = "SELECT * FROM patient_table WHERE hn_id = $hn_id";
                    $query_user = mysqli_query($conn, $sql_user);
                    while ($rs_user = mysqli_fetch_array($query_user)) {
                      $user[] = "\"" . $rs_user['first_name'] . "\"";
                    }
                    $scoreGame3[] = "\"" . $rs['score_game3'] . "\"";
                    $time[] = "\"" . $rs['time_game3'] . "\"";
                    $create_at[] = "\"" . $rs['create_at'] . "\"";
                    // $user[] = "\"" . $rs['hn_id'] . "\"";
                  }
                  $scoreGame3 = implode(",", $scoreGame3);
                  $time = implode(",", $time);
                  $user = implode(",", $user);
                  $create_at = implode(",", $create_at);

                  ?>

                  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                  <canvas id="myChartM666" width="300px" height="200px"></canvas>
                  <script>
                    var ctx = document.getElementById('myChartM666').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: [<?php echo $create_at;  ?>],
                        datasets: [{
                            label: 'รวมคะแนนทั้งหมด',
                            backgroundColor: "#1C3059",
                            data: [<?php echo $scoreGame3 ?>],
                            borderColor: "#1C3059",
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.5
                          },
                          {
                            label: 'รวมเวลาที่ใช้ไป(s)',
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
    <div id="accordionM1">
      <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

      <div class="card card-primary">
        <div class="card-header">
          <h4 class="card-title">
            <a class="card-link" data-toggle="collapse" href="#collapseM5">
              ข้อมูลเกมปริศนายา เลเวล 1
          </h4>
          </a>
        </div>
        <div id="collapseM5" class="collapse" data-parent="#accordionM1">
          <div class="card-body">
            <!-- table details -->
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable12" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>รวมคะแนนทั้งหมด</th>
                    <th>รวมเวลาที่ใช้ไป(s)</th>
                    <th>เดือน/ปีที่เล่น</th>
                    <th>เล่นทั้งหมดกี่ครั้ง</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT *,COUNT(play_id) , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE g.hn_id = $id  AND level_id=1  
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC";

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
                      <td><?= $data['COUNT(play_id)']; ?></td>

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
            <a class="card-link" data-toggle="collapse" href="#collapseM6">
              ข้อมูลเกมปริศนายา เลเวล 2
          </h4>
          </a>
        </div>
        <div id="collapseM6" class="collapse" data-parent="#accordionM1">
          <div class="card-body">
            <!-- table details -->
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable13" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>รวมคะแนนทั้งหมด</th>
                    <th>รวมเวลาที่ใช้ไป(s)</th>
                    <th>เดือน/ปีที่เล่น</th>
                    <th>เล่นทั้งหมดกี่ครั้ง</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT *,COUNT(play_id) , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE g.hn_id = $id  AND level_id=2  
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC";

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
                      <td><?= $data['COUNT(play_id)']; ?></td>

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
            <a class="card-link" data-toggle="collapse" href="#collapseM7">
              ข้อมูลเกมปริศนายา เลเวล 3
          </h4>
          </a>
        </div>
        <div id="collapseM7" class="collapse" data-parent="#accordionM1">
          <div class="card-body">
            <!-- table details -->
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable14" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>รวมคะแนนทั้งหมด</th>
                    <th>รวมเวลาที่ใช้ไป(s)</th>
                    <th>เดือน/ปีที่เล่น</th>
                    <th>เล่นทั้งหมดกี่ครั้ง</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT *,COUNT(play_id) , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                            , DATE_FORMAT(create_at, '%M %Y') AS create_at
                            FROM play_game3_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE g.hn_id = $id  AND level_id=3
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m') DESC";

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
                      <td><?= $data['COUNT(play_id)']; ?></td>

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