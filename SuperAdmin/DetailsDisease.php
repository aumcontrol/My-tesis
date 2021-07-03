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
                <h1>โรคพาร์กินสัน (Parkinson’s Disease, PD) </h1>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">แนะนำโรคพาร์กินสัน (Parkinson’s Disease, PD) </h3>
                </div> <!-- /.card-body -->
                <div class="card-body">
                  <!-- <strong>โรคพาร์กินสัน (Parkinson’s Disease, PD) </strong> -->


                  <div class="callout callout-danger">
                    <h5>โรคพาร์กินสัน (Parkinson’s Disease, PD) </h5>
                    <p>เป็นโรคความเสื่อมของระบบประสาท(Neurodegenerative Disorders) ซึ่งจะส่งผลให้สารโดปามีน (Dopamine) ในสมองลดลง ซึ่งสารนี้มีความสำคัญในการควบคุมการเคลื่อนไหวของกล้ามเนื้อ ส่งผลให้เกิดการเคลื่อนไหวที่ผิดปกติ</p>
                  </div>

                  <div class="callout callout-info">
                    <h5>ลักษณะที่สำคัญของผู้ป่วยพาร์กินสัน</h5>
                    <p>
                    <ul>
                      <li>อาการสั่น (Tremor) </li>
                      <li>อาการแข็งเกร็ง (Rigidity)</li>
                      <li>อาการเคลื่อนไหวช้า (Bradykinesia) </li>
                      <li>มีการทรงตัวที่ผิดปกติ (Postural instability) </li>
                    </ul>
                    </p>
                  </div>

                  <div class="callout callout-warning">
                    <h5>การรักษาโรคพาร์กินสัน</h5>
                    <p>การรักษาโรคพาร์กินสันในระยะแรกแพทย์จะแนะนำให้ผู้ป่วยรับประทานยาเป็นหลัก เนื่องจากผู้ป่วย ส่วนใหญ่จะมีการตอบสนองต่อยาดีมาก และ อาการต่าง ๆ สามารถควบคุมได้ด้วยยา โดยยาที่ใช้รักษาโรคพาร์กินสันจะเป็นยากลุ่มเสริมการทำงานของสารสื่อประสาทโดปามีน (dopaminergic medications) เป็นหลักโดยพบว่ายาแต่ละกลุ่มจะมีกลไกในการออกฤทธิ์ของยาแตกต่างกัน </p>
                  </div>

                  <div class="callout callout-success">
                    <h5>ตารางแสดงกลุ่มยารักษาโรคพาร์กินสันและกลไกของการออกฤทธิ์ของยา</h5>

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>กลุ่มยารักษาโรคพาร์กินสัน </th>
                          <th>กลไกของการออกฤทธิ์ของยา</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1. ยาเลโวโดปา </td>
                          <td>การเปลี่ยนเป็นสารสื่อประสาทโดปามีน</td>
                        </tr>
                        <tr>
                          <td>2. ยากลุ่มเสริมตัวรับโดปามีน </td>
                          <td>การกระตุ้นตัวรับสารสื่อประสาทโดปามีน</td>
                        </tr>
                        <tr>
                          <td>3. ยากลุ่มยับยั้งเอนไซม์ MAO-B</td>
                          <td>การยับยั้งเอนไซม์ MAO-B</td>
                        </tr>
                        <tr>
                          <td>4. ยากลุ่มยับยั้งเอนไซม์ COMT</td>
                          <td>การยับยั้งเอนไซม์ COMT</td>
                        </tr>
                        <tr>
                          <td>5. ยากลุ่มต้านโคลิเนอร์จิก</td>
                          <td>การยับยั้งการทำงานของสารสื่อประสาท acetylcholine</td>
                        </tr>
                        <tr>
                          <td colspan="2">COMT: Catechol-O-methyl transferase; MAO-B: Monoamine oxidase type B, NMDA: N-methyl-D-aspartate</td>
                        </tr>
                      </tbody>
                    </table>


                  </div>

                  <!-- Accordion -->
                  <div class="card card-pink">
                    <div class="card-header">
                      <h3 class="card-title">กลุ่มยารักษาโรคพาร์กินสัน</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <div id="accordion">
                        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

                        <div class="card card-primary">
                          <div class="card-header">
                            <h4 class="card-title">
                              <a class="card-link" data-toggle="collapse" href="#collapse1">
                                1. ยาเลโวโดปา
                            </h4>
                            </a>
                          </div>
                          <div id="collapse1" class="collapse show" data-parent="#accordion">
                            <div class="card-body">

                              <strong>ผลข้างเคียงของยา</strong>
                              <p>
                              <ul>
                                <li>อาการคลื่นใส้อาเจียน</li>
                                <li>อาการเวียนศีรษะ</li>
                                <li>อาการความดันโลหิตต่ำ</li>
                                <li>อาการเห็นภาพหลอน</li>
                              </ul>
                              </p>

                              <h5 style="margin-top:30px">benserazide immediate release 200 mg / 50 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/1/immediate_release_f.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/1/immediate_release_b.png" style="width: 40%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>

                              <h5 style="margin-top:50px">benserazide dispersible tablet 100 mg / 25 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/1/dispersible_tablet_f.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/1/dispersible_tablet_b.png" style="width: 40%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>

                              <h5 style="margin-top:50px">razide controlled release 100 mg / 25 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/1/controlled_release_f.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/1/controlled_release_b.png" style="width: 40%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>


                            </div>
                          </div>
                        </div>

                        <div class="card card-danger">
                          <div class="card-header">
                            <h4 class="card-title">
                              <a class="card-link" data-toggle="collapse" href="#collapse2">
                                2. ยากลุ่มเสริมตัวรับโดปามีน
                            </h4>
                            </a>
                          </div>
                          <div id="collapse2" class="collapse" data-parent="#accordion">
                            <div class="card-body">

                              <strong>ผลข้างเคียงของยา</strong>
                              <p>
                              <ul>
                                <li>อาการเห็นภาพหลอน</li>
                                <li>อาการง่วงซึม</li>
                                <li>ภาวะยับยั้งชั่งใจไม่อยู่</li>
                              </ul>
                              </p>

                              <h5 style="margin-top:30px">Pramipexole 0.25 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/2/pramipexole_f.png" style="width: 10%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/2/pramipexole_b.png" style="width: 30%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>

                              <h5 style="margin-top:50px">Ropinirole 2 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/2/ropinirole_f.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/2/ropinirole_b.png" style="width: 40%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>

                              <h5 style="margin-top:50px">Piribedil 50 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/2/piribedil.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                              </div>

                              <h5 style="margin-top:50px">Bromocriptine 2.5 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/2/bromocriptine_f.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/2/bromocriptine_b.png" style="width: 40%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>

                              <h5 style="margin-top:50px">Rotigotine Patch 2 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/2/rotigotine_f.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/2/rotigotine_b.png" style="width: 40%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>


                            </div>
                          </div>
                        </div>


                        <div class="card card-success">
                          <div class="card-header">
                            <h4 class="card-title">
                              <a class="card-link" data-toggle="collapse" href="#collapse3">
                                3. ยากลุ่มยับยั้งเอนไซม์ MAO-B
                            </h4>
                            </a>
                          </div>
                          <div id="collapse3" class="collapse" data-parent="#accordion">
                            <div class="card-body">

                              <strong>ผลข้างเคียงของยา</strong>
                              <p>
                              <ul>
                                <li>อาการเวียนศีรษะ</li>
                                <li>อาการเบื่ออาหาร</li>
                                <li>อาการปากแห้ง</li>
                                <li>อาการนอนไม่หลับ</li>
                              </ul>
                              </p>

                              <h5 style="margin-top:30px">Rasagiline 1 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/3/rasagiline_f.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/3/rasagiline_b.png" style="width: 40%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>

                              <h5 style="margin-top:50px">Selegiline 5 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/3/selegiline_f.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/3/selegiline_b.png" style="width: 40%;  display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>

                            </div>
                          </div>
                        </div>


                        <div class="card card-warning">
                          <div class="card-header">
                            <h4 class="card-title">
                              <a class="card-link" data-toggle="collapse" href="#collapse4">
                                4. ยากลุ่มยับยั้งเอนไซม์ COMT
                            </h4>
                            </a>
                          </div>
                          <div id="collapse4" class="collapse" data-parent="#accordion">
                            <div class="card-body">

                              <strong>ผลข้างเคียงของยา</strong>
                              <p>
                              <ul>
                                <li>อาการคลื่นใส้อาเจียน </li>
                                <li>อาการปวดท้อง</li>
                                <li>อาการท้องผูก</li>
                                <li>การมีปัสสาวะสีเข้ม</li>
                              </ul>
                              </p>

                              <h5 style="margin-top:30px">Entacapone 200 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/4/entacapone_f.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/4/entacapone_b.png" style="width: 40%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>

                            </div>
                          </div>
                        </div>


                        <div class="card card-maroon">
                          <div class="card-header">
                            <h4 class="card-title">
                              <a class="card-link" data-toggle="collapse" href="#collapse5">
                                5. ยากลุ่มต้านโคลิเนอร์จิก
                            </h4>
                            </a>
                          </div>
                          <div id="collapse5" class="collapse" data-parent="#accordion">
                            <div class="card-body">

                              <strong>ผลข้างเคียงของยา</strong>
                              <p>
                              <ul>
                                <li>อาการเวียนศีรษะ</li>
                                <li>อาการท้องผูก</li>
                                <li>อาการปากแห้ง</li>
                                <li>อาการสับสน</li>
                                <li>การกระตุ้นอาการต้อหิน</li>
                              </ul>
                              </p>

                              <h5 style="margin-top:30px">Trihexyphenidyl 2 mg</h5>
                              <div class="row">
                                <div class="col-sm-12">
                                  <img src="../img/medicine/5/trihexyphenidyl_f.png" style="width: 20%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div>
                                <!-- <div class="col-sm-6">
                                  <img src="../img/medicine/5/trihexyphenidyl_b.png" style="width: 40%; display: block; margin-left: auto; margin-right: auto; margin-top:20px" />
                                </div> -->
                              </div>

                            </div>
                          </div>
                        </div>




                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- จบ Accordion -->

                  <!-- <div class="callout callout-danger">
                    <h5>กลุ่มยารักษาโรคพาร์กินสัน</h5>

                    <div class="callout callout-danger">
                      <h5>1. ยาเลโวโดปา</h5>
                      <strong>ผลข้างเคียงของยา</strong>
                      <p>
                      <ul>
                        <li>อาการคลื่นใส้อาเจียน</li>
                        <li>อาการเวียนศีรษะ</li>
                        <li>อาการความดันโลหิตต่ำ</li>
                        <li>อาการเห็นภาพหลอน</li>
                      </ul>
                      </p>
                        <div class="row">
                        <div class="col-sm-12">
                          <img src="../img/medicine/1/immediate_release_f.png" class="float-left" style="width: 150px;" />
                        </div>
                        </div>
                    </div>



                  </div> -->


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