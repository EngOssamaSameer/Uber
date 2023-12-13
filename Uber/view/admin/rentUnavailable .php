

<?php

session_start();
if(!isset($_SESSION["userRole"])){
  header("location: ../../view/main/login.php");
}else{
  if($_SESSION["userRole"] != "admin" ){
    header("location: ../../view/main/login.php");

  }
}
require_once '../../controller/serviceController.php';
// all rents
$serv = new serviceController;
$allService = false;
if($serv->selectAll()){
    $allService = $serv->selectAll() ;
}

//END Rent****************************** */

if(isset($_POST['end_rentsId'])){
    $serv->endRent($_POST['end_rentsId']);
}


//DELETE Rent****************************** */
if(isset($_POST['delete_rentsId'])){
    $serv->deleteRent($_POST['delete_rentsId']);
}

// all rents
$serv = new serviceController;
$allService = false;
if($serv->selectAll()){
    $allService = $serv->selectAll() ;
}

//END Rent****************************** */

if(isset($_POST['end_rentsId'])){
    $serv->endRent($_POST['end_rentsId']);
}
//-----------select all notifi ---------------/
$i = 0; 
require_once '../../controller/profileController.php';
$profile = new profileController ;
$res = "" ;
if($profile->selectAllNotifi($_SESSION["userId"])){
    $res = $profile->selectAllNotifi($_SESSION["userId"]) ;
}

?>







<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rents</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Uber</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <!-- End Search Icon-->


                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number"><?php if($res){
                            echo count($res);
                            } ?></span>
                    </a>
                    <!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have <?php if($res){
                            echo count($res);
                            }else{
                                echo "no";
                            } ?> new notifications
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php
                            if(!empty($res)){
                                $i;
                                if((count($res)-5)>0){
                                  $i = (count($res)-5);
                                }
                                foreach($res as $r){
                                    if($i>0){
                                      $i--;
                                      continue;
                                    }
                                    ?>
                                        <li class="notification-item">
                                            <i class="bi bi-check-circle text-success"></i>
                                            <div>
                                                <p><?php echo $r['description'] ?></p>
                                                <p><?php echo $r['date'] ?></p>
                                            </div>
                                        </li>
                                    <?php
                                    $i--;
                                }
                            }
                        ?>


                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="notifi.php">Show all notifications</a>
                        </li>

                    </ul>
                    <!-- End Notification Dropdown Items -->

                </li>
                <!-- End Notification Nav -->


                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?php echo $_SESSION["userPhoto"] ?>" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION["userName"] ?></span>
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $_SESSION["userEmail"] ?></h6>
                            <span><?php echo $_SESSION["userRole"] ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="../main/login.php?logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->

            </ul>
        </nav>
        <!-- End Icons Navigation -->

    </header>
    <!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-bookmarks-fill"></i><span>Services</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="rents.php">
                            <i class="bi bi-circle"></i><span>Rents</span>
                        </a>
                    </li>
                    <li>
                        <a href="manageUser.php">
                            <i class="bi bi-circle"></i><span>Manage USers</span>
                        </a>
                    </li>
                    <li>
                        <a href="markets.php">
                            <i class="bi bi-circle"></i><span>Markets</span>
                        </a>
                    </li>

          </ul>
      </li>
      <!-- End Components Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="home.php">
          <i class="bi bi-house-door-fill"></i>
              <span>Home</span>
          </a>
      </li>
      
      <li class="nav-item">
          <a class="nav-link collapsed" href="profile.php">
              <i class="bi bi-person"></i>
              <span>Profile</span>
          </a>
      </li>
      <li class="nav-item">
                <a class="nav-link collapsed" href="wallet.php">
                    <i class="bi bi-cash-coin"></i>
                    <span>Wallet</span>
                </a>
        </li>
        
    <li class="nav-item">
        <a class="nav-link collapsed" href="reports.php">
            <i class="bi bi-file-earmark-pdf-fill"></i>
            <span>Reports</span>
        </a>
    </li>
      <!-- End Profile Page Nav -->

      


    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Rent Unavailable</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
        <table class="table">
                <thead>
                  <tr>
                    
                    <th scope="col">Rent ID</th>
                    <th scope="col">Rent Kind</th>
                    <th scope="col">User Email</th>
                    <th scope="col">User Name</th>
                    <th scope="col">End/delete</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        if($allService){
                            /*
                            echo "<pre>";
                            print_r($allService) ;
                            echo "</pre>";*/
                            foreach($allService as $serv){
                                ?>
                                    <tr class="
                                    <?php 
                                    if($serv['rentCase']== 1){
                                        echo 'table-success';
                                    }else{
                                        echo 'table-danger';
                                    }
                                    ?>
                                    ">
                                        <th scope="row"><?php echo $serv['rentId']    ?></th>
                                        <td><?php echo $serv['rentKind']    ?></td>
                                        <td><?php echo $serv['rentUserEmail']    ?></td>
                                        <td><?php echo $serv['rentUserName']    ?></td>
                                        <td>
                                        <td><?php
                                            if($serv['rentCase'] == 1 ){
                                                ?>
                                                    <form novalidate action="rentUnavailable .php" method="post">
                                                        <input type="hidden" name="delete_rentsId" value="<?php echo $serv['rentId'] ?>">
                                                        <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-6-line"></i></button>
                                                    </form>
                                                <?php
                                            }else{
                                                ?>
                                                    <form novalidate action="rentUnavailable .php" method="post">
                                                        <input type="hidden" name="end_rentsId" value="<?php echo $serv['rentId'] ?>">
                                                        <button type="submit" class="btn btn-warning"><i class="bi bi-file-x-fill"></i></button>
                                                    </form>
                                                <?php
                                            }
                                        ?>
                                    </tr>
                                <?php
                            }
                        }
                    ?>


                </tbody>
        </table>
    </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Uber</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href=" ">FCHI-HU Students</a>
        </div>
    </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
































