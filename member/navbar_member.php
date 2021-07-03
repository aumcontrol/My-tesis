        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <link href="../css/navbar.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
        <style>
            #layoutSidenav {
                font-family: 'Kanit', sans-serif;
            }
        </style>



        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand">Member</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form> -->
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="EditProfile">แก้ไขข้อมูลส่วนตัว</a>
                        <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                    </div>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading" style="color:#A9A9A9">Account</div>
                        <a class="nav-link disabled">
                            <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                            <?php
                            // echo $_SESSION['user']; 
                            $userid = $_SESSION['userid'];
                            $sql = "SELECT * FROM user_table WHERE id = $userid";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo $row['firstname'];
                                echo " ";
                                echo $row['lastname'];
                            }

                            ?>
                        </a>
                        <div class="sb-sidenav-menu-heading" style="color:#A9A9A9">Home</div>
                        <a class="nav-link" href="OverviewMember">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            ภาพรวม
                        </a>
                        <div class="sb-sidenav-menu-heading" style="color:#A9A9A9">Tool</div>
                        <a class="nav-link" href="find_patient">
                            <div class="sb-nav-link-icon"><i class="fas fa-search"></i></div>
                            ค้นหาผู้ป่วย
                        </a>

                        <div class="sb-sidenav-menu-heading" style="color:#A9A9A9">Other</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            รายละเอียดอื่น ๆ
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                                <a class="nav-link" href="DetailsDisease">แนะนำโรคพาร์กินสัน</a>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapse" aria-expanded="false" aria-controls="pagesCollapseError">
                                    กฏกติกาเกม
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapse" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="DetailsGame2">เกมจับคู่ภาพยา</a>
                                        <a class="nav-link" href="DetailsGame3">เกมปริศนายา</a>
                                    </nav>
                                </div>

                                <a class="nav-link" href="InstallGame">วิธีติดตั้งเกมและดาวน์โหลดเกม</a>

                            </nav>
                        </div>


                        <!-- <div class="sb-sidenav-menu-heading">Tool</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-search"></i></div>
                            ค้นหาผู้ป่วย
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="#">รหัสประจำตัวผู้ป่วย</a>
                                <a class="nav-link" href="#">ชื่อ-นามสกุล</a>
                            </nav>
                        </div> -->
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Parkinson Patient’s Development Analysis Game</div>
                </div>
            </nav>
        </div>