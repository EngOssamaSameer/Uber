<?php

session_start();
if(!isset($_SESSION["userRole"])){
  header("location: ../../view/main/login.php");
}else{
  if($_SESSION["userRole"] != "user" ){
    header("location: ../../view/main/login.php");

  }
} 
//-----------wallet---------------/
require_once '../../controller/cashController.php';
$cash = new cashController ;
$funds = '';
if($cash->selectFunds($_SESSION["userId"])){
    $fun = $cash->selectFunds($_SESSION["userId"]) ;
    $funds = $fun[0]['funds'];
}
// all rent 
require_once '../../controller/serviceController.php';

$serv = new serviceController;
$allService = false;
if($serv->selectAll()){
    $allService = $serv->selectAll() ;
}

//GEET Rent POST method S****************************** */
require_once '../../model/rent.php';
$rent = new Rent;
if(isset($_POST['ger_rentsId'])){
    $rent->rentId = $_POST['ger_rentsId'];
    $rent->rentPrice="";
    $rent->rentKind="";
    $rent->rentCase="";
    $rent->rentUserName=$_SESSION["userName"];
    $rent->rentUserEmail=$_SESSION["userEmail"];
    $rent->userId=$_SESSION["userId"];
    if($serv->gerRent($rent)){
        $serv->gerRent($rent);
        $addedFunds = $funds - $_POST['ger_rentsPrice'];
        $cash->addFundsToOther($_SESSION["userId"],$addedFunds,$_POST['ger_rentsPrice']);
    }
    //echo $_POST['ger_rentsId']-$funds  ger_rentsPrice;
}
//*********************************** */
// all funds
require_once '../../controller/serviceController.php';
$serv = new serviceController;
$allService = false;
if($serv->selectAll()){
    $allService = $serv->selectAll() ;
}
//Search Rent****************************** */
$search = '';
if(isset($_POST['search'])){
    if(!empty($_POST['search'])){
    $search = $serv->searchSelectRent();
    }
}

//******************* */
$i=0;
//-----------select all notifi ---------------/
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

  <title>Rent</title>
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
            <form class="search-form d-flex align-items-center" method="POST" action="rent.php">
                <input type="text" name="search" placeholder="Search" title="Enter search keyword">
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
                            <a class="dropdown-item d-flex align-items-center" href="help.php">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
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
                  <a href="ride.php">
                      <i class="bi bi-circle"></i><span>Get Trip</span>
                  </a>
              </li>
              <li>
                  <a href="delivery.php">
                      <i class="bi bi-circle"></i><span>Delivery</span>
                  </a>
              </li>
              <li>
                  <a href="currentTrip.php">
                      <i class="bi bi-circle"></i><span>Current Trip</span>
                  </a>
              </li>

          </ul>
      </li>
      <!-- End Components Nav -->

      <!-- End Forms Nav -->


      <li class="nav-heading">Pages</li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="home.php">
          <i class="bi bi-house-door-fill"></i>
              <span>Home</span>
          </a>
      </li>
      
      <li class="nav-item">
          <a class="nav-link collapsed" href="profilr.php">
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
      <!-- End Profile Page Nav -->

      <li class="nav-item">
          <a class="nav-link collapsed" href="help.php">
              <i class="bi bi-question-circle"></i>
              <span>Help</span>
          </a>
      </li>
      


    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div >
        <?php 
            /*
            echo "<pre>";
                print_r($search);
            echo "</pre>";
            */
            $i;$d;$s;$word="";
            if($search){
                $i=0 ;
                $d= 0;
                foreach($search as $ser){
                    $s= 0;
                    foreach($ser as $se){

                            if($_POST['search'] == "car" || $_POST['search'] == "Car"){
                                $word = 1 ;
                            }else if($_POST['search'] == "Moto" || $_POST['search'] == "moto" || $_POST['search'] == "scooter" || $_POST['search'] == "Scooter"){
                                $word = 2 ;
                            }else if($_POST['search'] == "Bike" || $_POST['search'] == "bike"){
                                $word = 3 ;
                            }else{
                                $word = $_POST['search'];
                            }
                            if($word == $se){
                                $s=1;
                                $d = $i;
                            }

                    }
                    $i++;
                    if($s != 0){
                        if($_POST['search'] == "Car" || $_POST['search'] == "car"  ){
                            if($search[$d]['rentKind'] != 1){
                                continue ;
                            }
                        }else if($_POST['search'] == "Moto" || $_POST['search'] == "moto" || $_POST['search'] == "scooter" || $_POST['search'] == "Scooter"){
                            if($search[$d]['rentKind'] != 2){
                                continue ;
                            }
                        }
                        //check unavalaible 
                        if($search[$d]['rentCase'] == 2){
                            continue ;
                        }
                        ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Kind</th>
                                    <th scope="col">Case</th>
                                    <th scope="col">Get</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <!-- Dispaly resualt -->
                                    <th scope="row"><?php echo $search[$d]['rentId'] ?></th>
                                    <td><?php echo $search[$d]['rentPrice'] ?></td>
                                    <td><?php
                                        if($search[$d]['rentKind'] == 1  ){
                                            echo "Car";
                                        }else if($search[$d]['rentKind'] == 2  ){
                                            echo "Moto";
                                        }else{
                                            echo "Bike";
                                        }
                                    ?></td>
                                    <td><?php
                                        if($search[$d]['rentCase'] == 1){
                                            echo "Available";
                                        }else{
                                            echo "Uavailable";
                                        }
                                    ?></td>
                                    <td>
                                    <form  action="rent.php" method="post">
                                        <input type="hidden" name="ger_rentsId" value="<?php echo $search[$d]['rentId'] ?>">
                                        <button type="submit" class="btn btn-success">get</button>
                                    </form>
                                    </td>
                                </tr>
                
                                </tbody>
                            </table>
                        <?php
                    
                    }
                    

                }


            }
        ?>
    </div>
    <div class="pagetitle">
      <h1>User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Rent</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
        <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Price</th>
                    <th scope="col">ID</th>
                    <th scope="col">Kind</th>
                    <th scope="col">Case</th>
                    <th scope="col">Get</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        if($allService){
                            foreach($allService as $serv){
                                if($serv['rentCase'] == 2 ){
                                    continue;
                                }
                                ?>
                                    <tr class="<?php 
                                    if($serv['rentCase']== 1){
                                        echo 'table-success';
                                    }else{
                                        echo 'table-danger';
                                    }
                                    ?>">
                                        <th scope="row"><?php  echo $serv['rentPrice']."EGP";  ?></th>
                                        <td><?php  echo $serv['rentId']  ?></td>
                                        <td><?php  
                                        if($serv['rentKind'] == 1 ){
                                            echo "bike";
                                        }else if($serv['rentKind'] == 2){
                                            echo "scooter";
                                        }else{
                                            echo "care";
                                        }
                                        ?></td>
                                        <td><?php
                                        if((($funds) +- $serv['rentPrice']) >0 ){
                                            echo "Available";
                                        }else{
                                            echo "Not Enough";
                                        }
                                        ?></td>
                                        
                                           
                                        <?php
                                        if((($funds) +- $serv['rentPrice']) >0){
                                            //
                                            ?>
                                                <td>
                                                <form  novalidate action="rent.php" method="POST">
                                                    <input type="hidden" class="form-control" name="ger_rentsId" value="<?php echo $serv['rentId'] ?>">
                                                    <input type="hidden" class="form-control" name="ger_rentsPrice" value="<?php echo $serv['rentPrice'] ?>">
                                                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                                                </form> 
                                                </td>
                                            <?php
                                        }else{
                                            ?>
                                                <td>
                                                    <button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
                                                </td>
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
  <script src="assets/js/main.js"></script>
  <!-- Template Main JS File -->

</body>

</html>











<?php
//test 

?>
