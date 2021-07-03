<!-- การ์ด Chart -->
<section class="content">
  <!-- Accordion -->
  <div class="card card-pink">
    <div class="card-header">
      <h3 class="card-title">เปรียบเทียบข้อมูลเกมจับคู่ภาพยา เลเวล 1-4 </h3>
    </div>
    <div class="container-fluid">

      <!-- /.card-header -->
      <div class="card-body">
        <div id="accordion">
          <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

          <div class="row">
            <div class="col-md-6">

              <!-- เกมจับคู่ภาพยา เลเวล 1 -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">เกมจับคู่ภาพยา เลเวล 1</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <!-- php chart -->

                    <script>
                      function generateRandomColor() {
                        var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                        return randomColor;
                      }
                      // console.log(typeof(generateRandomColor()));
                    </script>

                    <?php
                    include('../connection.php');
                    if (isset($_POST["submit"])) {
                      $compare = $_POST["cp"];
                      // echo $compare[0];
                      // $compare1 = $_POST["cp"][0];
                      // echo '<br>'.$compare1.'<br>';
                    }
                    ?>
                    <?php


                    $hn_rs = [];
                    $i = 0;
                    foreach ($compare as $s) {

                      $sql = "SELECT * , DATE_FORMAT(create_at, '%d / %m / %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $s  AND level_id = 1 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,31";

                      // $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                      //         , DATE_FORMAT(create_at, '%M %Y') AS create_at
                      //         FROM play_game2_table WHERE hn_id = $s  AND level_id = 1 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,12";

                      // $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                      //         , DATE_FORMAT(create_at, '%Y') AS create_at
                      //         FROM play_game2_table WHERE hn_id = $s  AND level_id = 1 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y%')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y') DESC LIMIT 0,12";

                      $query = mysqli_query($conn, $sql);
                      $queryarr = [];
                      $scorePlus = [];
                      $scoreSub = [];
                      $time = [];
                      $create_at = [];

                      while ($rs = mysqli_fetch_array($query)) {
                        $hn_id = $rs['hn_id'];
                        $sql_user = "SELECT * FROM patient_table WHERE hn_id = $s";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($rs_user = mysqli_fetch_array($query_user)) {
                          $user = $rs_user['first_name'];
                        }
                        $scorePlus[] = $rs['score_game2_plus'];
                        $scoreSub[] = $rs['score_game2_sub'];
                        $time[] = $rs['time_game2'];
                        $create_at[] = $rs['create_at'];
                      }
                      $scorePlus = implode(",", $scorePlus);
                      $scoreSub = implode(",", $scoreSub);
                      $time = implode(",", $time);
                      $create_at = implode(",", $create_at);
                      $queryarr = array($user, $scorePlus, $scoreSub, $time, $create_at);
                      array_push($hn_rs, $queryarr);
                    }
                    $myJSON = json_encode($hn_rs);

                    ?>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                    <canvas id="myChart1" width="300px" height="200px"></canvas>
                    <script>
                      var initData = <?php echo $myJSON; ?>;
                      // console.log(initData)
                      var ctx = document.getElementById('myChart1').getContext('2d');
                      var dataarry = []
                      var aa1 = {
                        datasets: [],
                        datashowpush: [],
                        datashowsub: []
                      };

                      // var datalabel = []
                      // var slipttime = initData[0][3].split(",")
                      // datalabel.forEach(x => {
                      //   datalabel.push(x)
                      // })
                      // var i = 0;
                      initData.forEach(x => {

                        var datapush = []
                        var datasub = []
                        var datatime = []
                        var datalabel = x[4].split(",")
                        var sliptpush = x[1].split(",")
                        var sliptsub = x[2].split(",")
                        var slipttime = x[3].split(",")

                        sliptpush.forEach(x => {
                          var a = parseInt(x);
                          datapush.push(a)
                        })

                        sliptsub.forEach(x => {
                          var a = parseInt(x);
                          datasub.push(a)
                        })

                        slipttime.forEach(x => {
                          var a = parseInt(x);
                          datatime.push(a)
                        })
                        // console.log(initData);
                        // console.log(sliptpush);
                        // console.log(sliptsub);
                        // console.log(slipttime);

                        var inita = {
                          label: datalabel,
                          idUser: x[0],
                          push: datapush,
                          sub: datasub,
                          time: datatime,
                          create: x[4]
                        }

                        // var colorsumpush = generateRandomColor()
                        // var colorsumsub = generateRandomColor()
                        var colorsumtime = generateRandomColor()

                        var sumpush = {
                          label: x[0] + ' รวมคะแนนจับคู่ถูก',
                          // backgroundColor: colorsumpush, 
                          data: inita.push,
                          // borderColor: colorsumpush,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }
                        var sumsub = {
                          label: x[0] + ' รวมคะแนนจับคู่ผิด',
                          // backgroundColor: colorsumsub, 
                          data: inita.sub,
                          // borderColor: colorsumsub,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }
                        var sumtime = {
                          label: x[0],
                          backgroundColor: colorsumtime,
                          data: inita.time,
                          borderColor: colorsumtime,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }

                        var a = {
                          labels: inita.label,
                          datasets: [],
                        };


                        // datasetaisus.push(a.datasets)
                        // aa.datasets.push(sumpush)
                        // aa.datasets.push(sumsub)
                        aa1.datasets.push(sumtime)
                        aa1.datashowpush.push(sumpush);
                        aa1.datashowsub.push(sumsub);
                        dataarry.push(a);
                        // i++
                      })


                      var options = {

                        tooltips: {
                          enabled: true,
                          mode: 'point',
                          callbacks: {
                            label: function(tooltipItems, data) {
                              var countlabel = 0;
                              var multistringText = [];
                              //  var multistringText = [tooltipItems.yLabel];

                              // console.log({
                              //   howver: tooltipItems
                              // })
                              var countitem = 0;
                              multistringText.push(aa1.datasets[tooltipItems.datasetIndex].label + " รวมเวลาที่ใช้ไป(s): " + aa1.datasets[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa1.datashowpush[tooltipItems.datasetIndex].label + ": " + aa1.datashowpush[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa1.datashowsub[tooltipItems.datasetIndex].label + ": " + aa1.datashowsub[tooltipItems.datasetIndex].data[tooltipItems.index])
                              return multistringText;
                            }
                          }
                        },

                        scales: {
                          yAxes: [{
                            ticks: {
                              min: 0
                            }
                          }],
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
                            }
                          }
                        }
                      };

                      var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                          labels: dataarry[0].labels,
                          datasets: aa1.datasets
                        },
                        options: options
                      });
                      // console.log(myChart)
                    </script>
                    <!-- จบ php chart -->
                  </div>
                </div>
              </div>
              <!-- ปิดเกมจับคู่ภาพยา เลเวล 1 -->



              <!-- เกมจับคู่ภาพยา เลเวล 3 -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">เกมจับคู่ภาพยา เลเวล 3</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <!-- php chart -->

                    <script>
                      function generateRandomColor() {
                        var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                        return randomColor;
                      }
                      // console.log(typeof(generateRandomColor()));
                    </script>

                    <?php
                    include('../connection.php');
                    if (isset($_POST["submit"])) {
                      $compare = $_POST["cp"];
                      // echo $compare[0];
                      // $compare1 = $_POST["cp"][0];
                      // echo '<br>'.$compare1.'<br>';
                    }
                    ?>
                    <?php


                    $hn_rs = [];
                    $i = 0;
                    foreach ($compare as $s) {

                      $sql = "SELECT * , DATE_FORMAT(create_at, '%d / %m / %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $s  AND level_id = 3 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,31";

                      // $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                      //         , DATE_FORMAT(create_at, '%M %Y') AS create_at
                      //         FROM play_game2_table WHERE hn_id = $s  AND level_id = 3 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,12";

                      // $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                      //         , DATE_FORMAT(create_at, '%Y') AS create_at
                      //         FROM play_game2_table WHERE hn_id = $s  AND level_id = 3 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y%')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y') DESC LIMIT 0,12";

                      $query = mysqli_query($conn, $sql);
                      $queryarr = [];
                      $scorePlus = [];
                      $scoreSub = [];
                      $time = [];
                      $create_at = [];

                      while ($rs = mysqli_fetch_array($query)) {
                        $hn_id = $rs['hn_id'];
                        $sql_user = "SELECT * FROM patient_table WHERE hn_id = $s";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($rs_user = mysqli_fetch_array($query_user)) {
                          $user = $rs_user['first_name'];
                        }
                        $scorePlus[] = $rs['score_game2_plus'];
                        $scoreSub[] = $rs['score_game2_sub'];
                        $time[] = $rs['time_game2'];
                        $create_at[] = $rs['create_at'];
                      }
                      $scorePlus = implode(",", $scorePlus);
                      $scoreSub = implode(",", $scoreSub);
                      $time = implode(",", $time);
                      $create_at = implode(",", $create_at);
                      $queryarr = array($user, $scorePlus, $scoreSub, $time, $create_at);
                      array_push($hn_rs, $queryarr);
                    }
                    $myJSON = json_encode($hn_rs);

                    ?>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                    <canvas id="myChart3" width="300px" height="200px"></canvas>
                    <script>
                      var initData = <?php echo $myJSON; ?>;
                      // console.log(initData)
                      var ctx = document.getElementById('myChart3').getContext('2d');
                      var dataarry = []
                      var aa2 = {
                        datasets: [],
                        datashowpush: [],
                        datashowsub: []
                      };

                      // var datalabel = []
                      // var slipttime = initData[0][3].split(",")
                      // datalabel.forEach(x => {
                      //   datalabel.push(x)
                      // })
                      // var i = 0;
                      initData.forEach(x => {

                        var datapush = []
                        var datasub = []
                        var datatime = []
                        var datalabel = x[4].split(",")
                        var sliptpush = x[1].split(",")
                        var sliptsub = x[2].split(",")
                        var slipttime = x[3].split(",")

                        sliptpush.forEach(x => {
                          var a = parseInt(x);
                          datapush.push(a)
                        })

                        sliptsub.forEach(x => {
                          var a = parseInt(x);
                          datasub.push(a)
                        })

                        slipttime.forEach(x => {
                          var a = parseInt(x);
                          datatime.push(a)
                        })
                        // console.log(initData);
                        // console.log(sliptpush);
                        // console.log(sliptsub);
                        // console.log(slipttime);

                        var inita = {
                          label: datalabel,
                          idUser: x[0],
                          push: datapush,
                          sub: datasub,
                          time: datatime,
                          create: x[4]
                        }

                        // var colorsumpush = generateRandomColor()
                        // var colorsumsub = generateRandomColor()
                        var colorsumtime = generateRandomColor()

                        var sumpush = {
                          label: x[0] + ' รวมคะแนนจับคู่ถูก',
                          // backgroundColor: colorsumpush, 
                          data: inita.push,
                          // borderColor: colorsumpush,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }
                        var sumsub = {
                          label: x[0] + ' รวมคะแนนจับคู่ผิด',
                          // backgroundColor: colorsumsub, 
                          data: inita.sub,
                          // borderColor: colorsumsub,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }
                        var sumtime = {
                          label: x[0],
                          backgroundColor: colorsumtime,
                          data: inita.time,
                          borderColor: colorsumtime,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }

                        var a = {
                          labels: inita.label,
                          datasets: [],
                        };


                        // datasetaisus.push(a.datasets)
                        // aa.datasets.push(sumpush)
                        // aa.datasets.push(sumsub)
                        aa2.datasets.push(sumtime)
                        aa2.datashowpush.push(sumpush);
                        aa2.datashowsub.push(sumsub);
                        dataarry.push(a);
                        // i++
                      })


                      var options = {

                        tooltips: {
                          enabled: true,
                          mode: 'point',
                          callbacks: {
                            label: function(tooltipItems, data) {
                              var countlabel = 0;
                              var multistringText = [];
                              //  var multistringText = [tooltipItems.yLabel];

                              // console.log({
                              //   howver: tooltipItems
                              // })
                              var countitem = 0;
                              multistringText.push(aa2.datasets[tooltipItems.datasetIndex].label + " รวมเวลาที่ใช้ไป(s): " + aa2.datasets[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa2.datashowpush[tooltipItems.datasetIndex].label + ": " + aa2.datashowpush[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa2.datashowsub[tooltipItems.datasetIndex].label + ": " + aa2.datashowsub[tooltipItems.datasetIndex].data[tooltipItems.index])
                              return multistringText;
                            }
                          }
                        },

                        scales: {
                          yAxes: [{
                            ticks: {
                              min: 0
                            }
                          }],
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
                            }
                          }
                        }
                      };

                      var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                          labels: dataarry[0].labels,
                          datasets: aa2.datasets
                        },
                        options: options
                      });
                      // console.log(myChart)
                    </script>
                    <!-- จบ php chart -->
                  </div>
                </div>
              </div>
              <!-- ปิดเกมจับคู่ภาพยา เลเวล 3 -->

            </div>

            <div class="col-md-6">

              <!-- เกมจับคู่ภาพยา เลเวล 2 -->
              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">เกมจับคู่ภาพยา เลเวล 2</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <!-- php chart -->

                    <script>
                      function generateRandomColor() {
                        var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                        return randomColor;
                      }
                      // console.log(typeof(generateRandomColor()));
                    </script>

                    <?php
                    include('../connection.php');
                    if (isset($_POST["submit"])) {
                      $compare = $_POST["cp"];
                      // echo $compare[0];
                      // $compare1 = $_POST["cp"][0];
                      // echo '<br>'.$compare1.'<br>';
                    }
                    ?>
                    <?php


                    $hn_rs = [];
                    $i = 0;
                    foreach ($compare as $s) {

                      $sql = "SELECT * , DATE_FORMAT(create_at, '%d / %m / %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $s  AND level_id = 2 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,31";

                      // $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                      //         , DATE_FORMAT(create_at, '%M %Y') AS create_at
                      //         FROM play_game2_table WHERE hn_id = $s  AND level_id = 2 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,12";

                      // $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                      //         , DATE_FORMAT(create_at, '%Y') AS create_at
                      //         FROM play_game2_table WHERE hn_id = $s  AND level_id = 2 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y%')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y') DESC LIMIT 0,12";

                      $query = mysqli_query($conn, $sql);
                      $queryarr = [];
                      $scorePlus = [];
                      $scoreSub = [];
                      $time = [];
                      $create_at = [];

                      while ($rs = mysqli_fetch_array($query)) {
                        $hn_id = $rs['hn_id'];
                        $sql_user = "SELECT * FROM patient_table WHERE hn_id = $s";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($rs_user = mysqli_fetch_array($query_user)) {
                          $user = $rs_user['first_name'];
                        }
                        $scorePlus[] = $rs['score_game2_plus'];
                        $scoreSub[] = $rs['score_game2_sub'];
                        $time[] = $rs['time_game2'];
                        $create_at[] = $rs['create_at'];
                      }
                      $scorePlus = implode(",", $scorePlus);
                      $scoreSub = implode(",", $scoreSub);
                      $time = implode(",", $time);
                      $create_at = implode(",", $create_at);
                      $queryarr = array($user, $scorePlus, $scoreSub, $time, $create_at);
                      array_push($hn_rs, $queryarr);
                    }
                    $myJSON = json_encode($hn_rs);

                    ?>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                    <canvas id="myChart2" width="300px" height="200px"></canvas>
                    <script>
                      var initData = <?php echo $myJSON; ?>;
                      // console.log(initData)
                      var ctx = document.getElementById('myChart2').getContext('2d');
                      var dataarry = []
                      var aa3 = {
                        datasets: [],
                        datashowpush: [],
                        datashowsub: []
                      };

                      // var datalabel = []
                      // var slipttime = initData[0][3].split(",")
                      // datalabel.forEach(x => {
                      //   datalabel.push(x)
                      // })
                      // var i = 0;
                      initData.forEach(x => {

                        var datapush = []
                        var datasub = []
                        var datatime = []
                        var datalabel = x[4].split(",")
                        var sliptpush = x[1].split(",")
                        var sliptsub = x[2].split(",")
                        var slipttime = x[3].split(",")

                        sliptpush.forEach(x => {
                          var a = parseInt(x);
                          datapush.push(a)
                        })

                        sliptsub.forEach(x => {
                          var a = parseInt(x);
                          datasub.push(a)
                        })

                        slipttime.forEach(x => {
                          var a = parseInt(x);
                          datatime.push(a)
                        })
                        // console.log(initData);
                        // console.log(sliptpush);
                        // console.log(sliptsub);
                        // console.log(slipttime);

                        var inita = {
                          label: datalabel,
                          idUser: x[0],
                          push: datapush,
                          sub: datasub,
                          time: datatime,
                          create: x[4]
                        }

                        // var colorsumpush = generateRandomColor()
                        // var colorsumsub = generateRandomColor()
                        var colorsumtime = generateRandomColor()

                        var sumpush = {
                          label: x[0] + ' รวมคะแนนจับคู่ถูก',
                          // backgroundColor: colorsumpush, 
                          data: inita.push,
                          // borderColor: colorsumpush,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }
                        var sumsub = {
                          label: x[0] + ' รวมคะแนนจับคู่ผิด',
                          // backgroundColor: colorsumsub, 
                          data: inita.sub,
                          // borderColor: colorsumsub,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }
                        var sumtime = {
                          label: x[0],
                          backgroundColor: colorsumtime,
                          data: inita.time,
                          borderColor: colorsumtime,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }

                        var a = {
                          labels: inita.label,
                          datasets: [],
                        };


                        // datasetaisus.push(a.datasets)
                        // aa.datasets.push(sumpush)
                        // aa.datasets.push(sumsub)
                        aa3.datasets.push(sumtime)
                        aa3.datashowpush.push(sumpush);
                        aa3.datashowsub.push(sumsub);
                        dataarry.push(a);
                        // i++
                      })


                      var options = {

                        tooltips: {
                          enabled: true,
                          mode: 'point',
                          callbacks: {
                            label: function(tooltipItems, data) {
                              var countlabel = 0;
                              var multistringText = [];
                              //  var multistringText = [tooltipItems.yLabel];

                              // console.log({
                              //   howver: tooltipItems
                              // })
                              var countitem = 0;
                              multistringText.push(aa3.datasets[tooltipItems.datasetIndex].label + " รวมเวลาที่ใช้ไป(s): " + aa3.datasets[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa3.datashowpush[tooltipItems.datasetIndex].label + ": " + aa3.datashowpush[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa3.datashowsub[tooltipItems.datasetIndex].label + ": " + aa3.datashowsub[tooltipItems.datasetIndex].data[tooltipItems.index])
                              return multistringText;
                            }
                          }
                        },

                        scales: {
                          yAxes: [{
                            ticks: {
                              min: 0
                            }
                          }],
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
                            }
                          }
                        }
                      };

                      var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                          labels: dataarry[0].labels,
                          datasets: aa3.datasets
                        },
                        options: options
                      });
                      // console.log(myChart)
                    </script>
                    <!-- จบ php chart -->
                  </div>
                </div>
              </div>
              <!-- ปิดเกมจับคู่ภาพยา เลเวล 2 -->



              <!-- เกมจับคู่ภาพยา เลเวล 4 -->
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">เกมจับคู่ภาพยา เลเวล 4</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <!-- php chart -->

                    <script>
                      function generateRandomColor() {
                        var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                        return randomColor;
                      }
                      // console.log(typeof(generateRandomColor()));
                    </script>

                    <?php
                    include('../connection.php');
                    if (isset($_POST["submit"])) {
                      $compare = $_POST["cp"];
                      // echo $compare[0];
                      // $compare1 = $_POST["cp"][0];
                      // echo '<br>'.$compare1.'<br>';
                    }
                    ?>
                    <?php


                    $hn_rs = [];
                    $i = 0;
                    foreach ($compare as $s) {

                      $sql = "SELECT * , DATE_FORMAT(create_at, '%d / %m / %Y') AS create_at
                            FROM play_game2_table WHERE hn_id = $s  AND level_id = 4 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,31";

                      // $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                      //         , DATE_FORMAT(create_at, '%M %Y') AS create_at
                      //         FROM play_game2_table WHERE hn_id = $s  AND level_id = 4 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,12";

                      // $sql = "SELECT * , SUM(score_game2_plus) AS score_game2_plus, SUM(score_game2_sub) AS score_game2_sub , SUM(time_game2) AS time_game2
                      //         , DATE_FORMAT(create_at, '%Y') AS create_at
                      //         FROM play_game2_table WHERE hn_id = $s  AND level_id = 4 AND (status_game2 = 'Success' || status_game2 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y%')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y') DESC LIMIT 0,12";

                      $query = mysqli_query($conn, $sql);
                      $queryarr = [];
                      $scorePlus = [];
                      $scoreSub = [];
                      $time = [];
                      $create_at = [];

                      while ($rs = mysqli_fetch_array($query)) {
                        $hn_id = $rs['hn_id'];
                        $sql_user = "SELECT * FROM patient_table WHERE hn_id = $s";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($rs_user = mysqli_fetch_array($query_user)) {
                          $user = $rs_user['first_name'];
                        }
                        $scorePlus[] = $rs['score_game2_plus'];
                        $scoreSub[] = $rs['score_game2_sub'];
                        $time[] = $rs['time_game2'];
                        $create_at[] = $rs['create_at'];
                      }
                      $scorePlus = implode(",", $scorePlus);
                      $scoreSub = implode(",", $scoreSub);
                      $time = implode(",", $time);
                      $create_at = implode(",", $create_at);
                      $queryarr = array($user, $scorePlus, $scoreSub, $time, $create_at);
                      array_push($hn_rs, $queryarr);
                    }
                    $myJSON = json_encode($hn_rs);

                    ?>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                    <canvas id="myChart4" width="300px" height="200px"></canvas>
                    <script>
                      var initData = <?php echo $myJSON; ?>;
                      // console.log(initData)
                      var ctx = document.getElementById('myChart4').getContext('2d');
                      var dataarry = []
                      var aa4 = {
                        datasets: [],
                        datashowpush: [],
                        datashowsub: []
                      };

                      // var datalabel = []
                      // var slipttime = initData[0][3].split(",")
                      // datalabel.forEach(x => {
                      //   datalabel.push(x)
                      // })
                      // var i = 0;
                      initData.forEach(x => {

                        var datapush = []
                        var datasub = []
                        var datatime = []
                        var datalabel = x[4].split(",")
                        var sliptpush = x[1].split(",")
                        var sliptsub = x[2].split(",")
                        var slipttime = x[3].split(",")

                        sliptpush.forEach(x => {
                          var a = parseInt(x);
                          datapush.push(a)
                        })

                        sliptsub.forEach(x => {
                          var a = parseInt(x);
                          datasub.push(a)
                        })

                        slipttime.forEach(x => {
                          var a = parseInt(x);
                          datatime.push(a)
                        })
                        // console.log(initData);
                        // console.log(sliptpush);
                        // console.log(sliptsub);
                        // console.log(slipttime);

                        var inita = {
                          label: datalabel,
                          idUser: x[0],
                          push: datapush,
                          sub: datasub,
                          time: datatime,
                          create: x[4]
                        }

                        // var colorsumpush = generateRandomColor()
                        // var colorsumsub = generateRandomColor()
                        var colorsumtime = generateRandomColor()

                        var sumpush = {
                          label: x[0] + ' รวมคะแนนจับคู่ถูก',
                          // backgroundColor: colorsumpush, 
                          data: inita.push,
                          // borderColor: colorsumpush,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }
                        var sumsub = {
                          label: x[0] + ' รวมคะแนนจับคู่ผิด',
                          // backgroundColor: colorsumsub, 
                          data: inita.sub,
                          // borderColor: colorsumsub,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }
                        var sumtime = {
                          label: x[0],
                          backgroundColor: colorsumtime,
                          data: inita.time,
                          borderColor: colorsumtime,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }

                        var a = {
                          labels: inita.label,
                          datasets: [],
                        };


                        // datasetaisus.push(a.datasets)
                        // aa.datasets.push(sumpush)
                        // aa.datasets.push(sumsub)
                        aa4.datasets.push(sumtime)
                        aa4.datashowpush.push(sumpush);
                        aa4.datashowsub.push(sumsub);
                        dataarry.push(a);
                        // i++
                      })


                      var options = {

                        tooltips: {
                          enabled: true,
                          mode: 'point',
                          callbacks: {
                            label: function(tooltipItems, data) {
                              var countlabel = 0;
                              var multistringText = [];
                              //  var multistringText = [tooltipItems.yLabel];

                              // console.log({
                              //   howver: tooltipItems
                              // })
                              var countitem = 0;
                              multistringText.push(aa4.datasets[tooltipItems.datasetIndex].label + " รวมเวลาที่ใช้ไป(s): " + aa4.datasets[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa4.datashowpush[tooltipItems.datasetIndex].label + ": " + aa4.datashowpush[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa4.datashowsub[tooltipItems.datasetIndex].label + ": " + aa4.datashowsub[tooltipItems.datasetIndex].data[tooltipItems.index])
                              return multistringText;
                            }
                          }
                        },

                        scales: {
                          yAxes: [{
                            ticks: {
                              min: 0
                            }
                          }],
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
                            }
                          }
                        }
                      };

                      var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                          labels: dataarry[0].labels,
                          datasets: aa4.datasets
                        },
                        options: options
                      });
                      // console.log(myChart)
                    </script>
                    <!-- จบ php chart -->
                  </div>
                </div>
              </div>
              <!-- ปิดเกมจับคู่ภาพยา เลเวล 4 -->


            </div>
          </div>
        </div>
      </div>


    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- จบการ์ด Chart -->







<!-- การ์ด Chart -->
<section class="content">
  <!-- Accordion -->
  <div class="card card-pink">
    <div class="card-header">
      <h3 class="card-title">เปรียบเทียบข้อมูลเกมปริศนายา เลเวล 1-3 </h3>
    </div>
    <div class="container-fluid">

      <!-- /.card-header -->
      <div class="card-body">
        <div id="accordion">
          <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

          <div class="row">
            <div class="col-md-6">

              <!-- เกมปริศนายา เลเวล 1 -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">เกมปริศนายา เลเวล 1</h3>
                </div>
                <div class="card-body">


                  <div class="chart">
                    <!-- php chart -->

                    <script>
                      function generateRandomColor() {
                        var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                        return randomColor;
                      }
                      // console.log(typeof(generateRandomColor()));
                    </script>

                    <?php
                    include('../connection.php');
                    if (isset($_POST["submit"])) {
                      $compare = $_POST["cp"];
                      // echo $compare[0];
                      // $compare1 = $_POST["cp"][0];
                      // echo '<br>'.$compare1.'<br>';
                    }
                    ?>
                    <?php


                    $hn_rs = [];
                    $i = 0;
                    foreach ($compare as $s) {

                      $sql = "SELECT * , DATE_FORMAT(create_at, '%d / %m / %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $s  AND level_id = 1 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,31";

                      // $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                      //         , DATE_FORMAT(create_at, '%M %Y') AS create_at
                      //         FROM play_game3_table WHERE hn_id = $s  AND level_id = 1 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,12";

                      // $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                      //         , DATE_FORMAT(create_at, '%Y') AS create_at
                      //         FROM play_game3_table WHERE hn_id = $s  AND level_id = 1 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y%')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y') DESC LIMIT 0,12";


                      $query = mysqli_query($conn, $sql);
                      $queryarr = [];
                      $score = [];
                      $time = [];
                      $create_at = [];

                      while ($rs = mysqli_fetch_array($query)) {
                        $hn_id = $rs['hn_id'];
                        $sql_user = "SELECT * FROM patient_table WHERE hn_id = $s";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($rs_user = mysqli_fetch_array($query_user)) {
                          $user = $rs_user['first_name'];
                        }
                        $score[] = $rs['score_game3'];
                        $time[] = $rs['time_game3'];
                        $create_at[] = $rs['create_at'];
                      }
                      $score = implode(",", $score);
                      $time = implode(",", $time);
                      $create_at = implode(",", $create_at);
                      $queryarr = array($user, $score, $time, $create_at);
                      array_push($hn_rs, $queryarr);
                    }
                    $myJSON = json_encode($hn_rs);

                    ?>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                    <canvas id="myChart11" width="300px" height="200px"></canvas>
                    <script>
                      var initData = <?php echo $myJSON; ?>;
                      // console.log(initData)
                      var ctx = document.getElementById('myChart11').getContext('2d');
                      var dataarry = []
                      var aa11 = {
                        datasets: [],
                        datashowpush: [],
                        datashowsub: []
                      };

                      // var datalabel = []
                      // var slipttime = initData[0][3].split(",")
                      // datalabel.forEach(x => {
                      //   datalabel.push(x)
                      // })

                      initData.forEach(x => {

                        var datapush = []
                        var datatime = []
                        var datalabel = x[3].split(",")
                        var sliptpush = x[1].split(",")
                        var slipttime = x[2].split(",")

                        sliptpush.forEach(x => {
                          var a = parseInt(x);
                          datapush.push(a)
                        })


                        slipttime.forEach(x => {
                          var a = parseInt(x);
                          datatime.push(a)
                        })
                        // console.log(initData);
                        // console.log(sliptpush);
                        // console.log(sliptsub);
                        console.log(datalabel);

                        var inita = {
                          label: datalabel,
                          idUser: x[0],
                          push: datapush,
                          time: datatime,
                          create: x[4]
                        }

                        // var colorsumpush = generateRandomColor()
                        // var colorsumsub = generateRandomColor()
                        var colorsumtime = generateRandomColor()

                        var sumpush = {
                          label: x[0] + ' รวมคะแนนทั้งหมด',
                          // backgroundColor: colorsumpush, 
                          data: inita.push,
                          // borderColor: colorsumpush,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }

                        var sumtime = {
                          label: x[0],
                          backgroundColor: colorsumtime,
                          data: inita.time,
                          borderColor: colorsumtime,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }

                        var a = {
                          labels: inita.label,
                          datasets: [],
                        };

                        aa11.datasets.push(sumtime)
                        aa11.datashowpush.push(sumpush);
                        dataarry.push(a);
                      })


                      var options = {

                        tooltips: {
                          enabled: true,
                          mode: 'point',
                          callbacks: {
                            label: function(tooltipItems, data) {
                              var countlabel = 0;
                              var multistringText = [];
                              //  var multistringText = [tooltipItems.yLabel];

                              // console.log({
                              //   howver: tooltipItems
                              // })
                              var countitem = 0;
                              multistringText.push(aa11.datasets[tooltipItems.datasetIndex].label + " รวมเวลาที่ใช้ไป(s): " + aa11.datasets[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa11.datashowpush[tooltipItems.datasetIndex].label + ": " + aa11.datashowpush[tooltipItems.datasetIndex].data[tooltipItems.index])
                              return multistringText;
                            }
                          }
                        },

                        scales: {
                          yAxes: [{
                            ticks: {
                              min: 0
                            }
                          }],
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
                            }
                          }
                        }
                      };

                      var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                          labels: dataarry[0].labels,
                          datasets: aa11.datasets
                        },
                        options: options
                      });
                      // console.log(myChart)
                    </script>
                    <!-- จบ php chart -->
                  </div>

                </div>
              </div>
              <!-- ปิดเกมปริศนายา เลเวล 1 -->



              <!-- เกมปริศนายา เลเวล 3 -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">เกมปริศนายา เลเวล 3</h3>
                </div>
                <div class="card-body">


                  <div class="chart">
                    <!-- php chart -->

                    <script>
                      function generateRandomColor() {
                        var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                        return randomColor;
                      }
                      // console.log(typeof(generateRandomColor()));
                    </script>

                    <?php
                    include('../connection.php');
                    if (isset($_POST["submit"])) {
                      $compare = $_POST["cp"];
                      // echo $compare[0];
                      // $compare1 = $_POST["cp"][0];
                      // echo '<br>'.$compare1.'<br>';
                    }
                    ?>
                    <?php


                    $hn_rs = [];
                    $i = 0;
                    foreach ($compare as $s) {

                      $sql = "SELECT * , DATE_FORMAT(create_at, '%d / %m / %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $s  AND level_id = 3 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,31";

                      // $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                      //         , DATE_FORMAT(create_at, '%M %Y') AS create_at
                      //         FROM play_game3_table WHERE hn_id = $s  AND level_id = 3 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,12";

                      // $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                      //         , DATE_FORMAT(create_at, '%Y') AS create_at
                      //         FROM play_game3_table WHERE hn_id = $s  AND level_id = 3 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y%')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y') DESC LIMIT 0,12";


                      $query = mysqli_query($conn, $sql);
                      $queryarr = [];
                      $score = [];
                      $time = [];
                      $create_at = [];

                      while ($rs = mysqli_fetch_array($query)) {
                        $hn_id = $rs['hn_id'];
                        $sql_user = "SELECT * FROM patient_table WHERE hn_id = $s";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($rs_user = mysqli_fetch_array($query_user)) {
                          $user = $rs_user['first_name'];
                        }
                        $score[] = $rs['score_game3'];
                        $time[] = $rs['time_game3'];
                        $create_at[] = $rs['create_at'];
                      }
                      $score = implode(",", $score);
                      $time = implode(",", $time);
                      $create_at = implode(",", $create_at);
                      $queryarr = array($user, $score, $time, $create_at);
                      array_push($hn_rs, $queryarr);
                    }
                    $myJSON = json_encode($hn_rs);

                    ?>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                    <canvas id="myChart33" width="300px" height="200px"></canvas>
                    <script>
                      var initData = <?php echo $myJSON; ?>;
                      // console.log(initData)
                      var ctx = document.getElementById('myChart33').getContext('2d');
                      var dataarry = []
                      var aa22 = {
                        datasets: [],
                        datashowpush: [],
                        datashowsub: []
                      };

                      // var datalabel = []
                      // var slipttime = initData[0][3].split(",")
                      // datalabel.forEach(x => {
                      //   datalabel.push(x)
                      // })

                      initData.forEach(x => {

                        var datapush = []
                        var datatime = []
                        var datalabel = x[3].split(",")
                        var sliptpush = x[1].split(",")
                        var slipttime = x[2].split(",")

                        sliptpush.forEach(x => {
                          var a = parseInt(x);
                          datapush.push(a)
                        })


                        slipttime.forEach(x => {
                          var a = parseInt(x);
                          datatime.push(a)
                        })
                        // console.log(initData);
                        // console.log(sliptpush);
                        // console.log(sliptsub);
                        console.log(datalabel);

                        var inita = {
                          label: datalabel,
                          idUser: x[0],
                          push: datapush,
                          time: datatime,
                          create: x[4]
                        }

                        // var colorsumpush = generateRandomColor()
                        // var colorsumsub = generateRandomColor()
                        var colorsumtime = generateRandomColor()

                        var sumpush = {
                          label: x[0] + ' รวมคะแนนทั้งหมด',
                          // backgroundColor: colorsumpush, 
                          data: inita.push,
                          // borderColor: colorsumpush,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }

                        var sumtime = {
                          label: x[0],
                          backgroundColor: colorsumtime,
                          data: inita.time,
                          borderColor: colorsumtime,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }

                        var a = {
                          labels: inita.label,
                          datasets: [],
                        };

                        aa22.datasets.push(sumtime)
                        aa22.datashowpush.push(sumpush);
                        dataarry.push(a);
                      })


                      var options = {

                        tooltips: {
                          enabled: true,
                          mode: 'point',
                          callbacks: {
                            label: function(tooltipItems, data) {
                              var countlabel = 0;
                              var multistringText = [];
                              //  var multistringText = [tooltipItems.yLabel];

                              // console.log({
                              //   howver: tooltipItems
                              // })
                              var countitem = 0;
                              multistringText.push(aa22.datasets[tooltipItems.datasetIndex].label + " รวมเวลาที่ใช้ไป(s): " + aa22.datasets[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa22.datashowpush[tooltipItems.datasetIndex].label + ": " + aa22.datashowpush[tooltipItems.datasetIndex].data[tooltipItems.index])
                              return multistringText;
                            }
                          }
                        },

                        scales: {
                          yAxes: [{
                            ticks: {
                              min: 0
                            }
                          }],
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
                            }
                          }
                        }
                      };

                      var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                          labels: dataarry[0].labels,
                          datasets: aa22.datasets
                        },
                        options: options
                      });
                      // console.log(myChart)
                    </script>
                    <!-- จบ php chart -->
                  </div>

                </div>
              </div>
              <!-- ปิดเกมปริศนายา เลเวล 3 -->



            </div>

            <div class="col-md-6">

            <!-- เกมปริศนายา เลเวล 2 -->
            <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">เกมปริศนายา เลเวล 2</h3>
                </div>
                <div class="card-body">


                  <div class="chart">
                    <!-- php chart -->

                    <script>
                      function generateRandomColor() {
                        var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                        return randomColor;
                      }
                      // console.log(typeof(generateRandomColor()));
                    </script>

                    <?php
                    include('../connection.php');
                    if (isset($_POST["submit"])) {
                      $compare = $_POST["cp"];
                      // echo $compare[0];
                      // $compare1 = $_POST["cp"][0];
                      // echo '<br>'.$compare1.'<br>';
                    }
                    ?>
                    <?php


                    $hn_rs = [];
                    $i = 0;
                    foreach ($compare as $s) {

                      $sql = "SELECT * , DATE_FORMAT(create_at, '%d / %m / %Y') AS create_at
                            FROM play_game3_table WHERE hn_id = $s  AND level_id = 2 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                            GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                            ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,31";

                      // $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                      //         , DATE_FORMAT(create_at, '%M %Y') AS create_at
                      //         FROM play_game3_table WHERE hn_id = $s  AND level_id = 2 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC LIMIT 0,12";

                      // $sql = "SELECT * , SUM(score_game3) AS score_game3 , SUM(time_game3) AS time_game3
                      //         , DATE_FORMAT(create_at, '%Y') AS create_at
                      //         FROM play_game3_table WHERE hn_id = $s  AND level_id = 2 AND (status_game3 = 'Success' || status_game3 = 'Stop')
                      //         GROUP BY DATE_FORMAT(create_at, '%Y%')
                      //         ORDER BY DATE_FORMAT(create_at, '%Y') DESC LIMIT 0,12";


                      $query = mysqli_query($conn, $sql);
                      $queryarr = [];
                      $score = [];
                      $time = [];
                      $create_at = [];

                      while ($rs = mysqli_fetch_array($query)) {
                        $hn_id = $rs['hn_id'];
                        $sql_user = "SELECT * FROM patient_table WHERE hn_id = $s";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($rs_user = mysqli_fetch_array($query_user)) {
                          $user = $rs_user['first_name'];
                        }
                        $score[] = $rs['score_game3'];
                        $time[] = $rs['time_game3'];
                        $create_at[] = $rs['create_at'];
                      }
                      $score = implode(",", $score);
                      $time = implode(",", $time);
                      $create_at = implode(",", $create_at);
                      $queryarr = array($user, $score, $time, $create_at);
                      array_push($hn_rs, $queryarr);
                    }
                    $myJSON = json_encode($hn_rs);

                    ?>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

                    <canvas id="myChart22" width="300px" height="200px"></canvas>
                    <script>
                      var initData = <?php echo $myJSON; ?>;
                      // console.log(initData)
                      var ctx = document.getElementById('myChart22').getContext('2d');
                      var dataarry = []
                      var aa33 = {
                        datasets: [],
                        datashowpush: [],
                        datashowsub: []
                      };

                      // var datalabel = []
                      // var slipttime = initData[0][3].split(",")
                      // datalabel.forEach(x => {
                      //   datalabel.push(x)
                      // })

                      initData.forEach(x => {

                        var datapush = []
                        var datatime = []
                        var datalabel = x[3].split(",")
                        var sliptpush = x[1].split(",")
                        var slipttime = x[2].split(",")

                        sliptpush.forEach(x => {
                          var a = parseInt(x);
                          datapush.push(a)
                        })


                        slipttime.forEach(x => {
                          var a = parseInt(x);
                          datatime.push(a)
                        })
                        // console.log(initData);
                        // console.log(sliptpush);
                        // console.log(sliptsub);
                        console.log(datalabel);

                        var inita = {
                          label: datalabel,
                          idUser: x[0],
                          push: datapush,
                          time: datatime,
                          create: x[4]
                        }

                        // var colorsumpush = generateRandomColor()
                        // var colorsumsub = generateRandomColor()
                        var colorsumtime = generateRandomColor()

                        var sumpush = {
                          label: x[0] + ' รวมคะแนนทั้งหมด',
                          // backgroundColor: colorsumpush, 
                          data: inita.push,
                          // borderColor: colorsumpush,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }

                        var sumtime = {
                          label: x[0],
                          backgroundColor: colorsumtime,
                          data: inita.time,
                          borderColor: colorsumtime,
                          fill: false,
                          cubicInterpolationMode: 'monotone',
                          tension: 0.5
                        }

                        var a = {
                          labels: inita.label,
                          datasets: [],
                        };

                        aa33.datasets.push(sumtime)
                        aa33.datashowpush.push(sumpush);
                        dataarry.push(a);
                      })


                      var options = {

                        tooltips: {
                          enabled: true,
                          mode: 'point',
                          callbacks: {
                            label: function(tooltipItems, data) {
                              var countlabel = 0;
                              var multistringText = [];
                              //  var multistringText = [tooltipItems.yLabel];

                              // console.log({
                              //   howver: tooltipItems
                              // })
                              var countitem = 0;
                              multistringText.push(aa33.datasets[tooltipItems.datasetIndex].label + " รวมเวลาที่ใช้ไป(s): " + aa33.datasets[tooltipItems.datasetIndex].data[tooltipItems.index])
                              multistringText.push(aa33.datashowpush[tooltipItems.datasetIndex].label + ": " + aa33.datashowpush[tooltipItems.datasetIndex].data[tooltipItems.index])
                              return multistringText;
                            }
                          }
                        },

                        scales: {
                          yAxes: [{
                            ticks: {
                              min: 0
                            }
                          }],
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
                            }
                          }
                        }
                      };

                      var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                          labels: dataarry[0].labels,
                          datasets: aa33.datasets
                        },
                        options: options
                      });
                      // console.log(myChart)
                    </script>
                    <!-- จบ php chart -->
                  </div>

                </div>
              </div>
              <!-- ปิดเกมปริศนายา เลเวล 2 -->

            </div>

          </div>
        </div>
      </div>


    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- จบการ์ด Chart -->