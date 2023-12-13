

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
//*********************************** */
require_once '../../model/requistOreder.php';
require_once '../../controller/eatController.php';
$eat = new eatController ;
$ord = new orderdetails;
$checkk = false ;
if(isset($_POST['oname'])){
   $ord->orderId = 0;
   $ord->userId = $_SESSION['userId'];
   $ord->name =$_POST['oname'];
   $ord->email= $_POST['oemail'];
   $ord->phone= $_POST['ophone'];
   $ord->address= $_POST['oaddress'];
   $ord->market= $_POST['omarket'];
   $ord->items= $_POST['oitem'];
   $ord->case = 1 ;
   $ord->driverId = 0 ;
   $ord->cash= $_POST['oprice'];
   if($eat->addRequestOrder($ord)){
    $addedFunds = $funds-$_POST['oprice'];
    $cash->addFunds($_SESSION["userId"],$addedFunds );
    $checkk = true ;
   }

   

}
if($checkk){
   header("location: ../../view/user/currentTrip.php");
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

//sllecet eat
require_once '../../controller/eatController.php';
$eat = new eatController ;
/*  ---------- select market Menu ----------  */
$menu ;
$orderPrice = 0;
if($eat->selectMarket()){
    $menu = $eat->selectMarketMenu() ;
}
foreach($menu as $m){
    if($m['item']==$_POST['item']){
        $orderPrice = $m['price'];
    }

}



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Check Out</title>
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
                            } ?>new notifications
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
                  <a href="rent.php">
                      <i class="bi bi-circle"></i><span>Make Rent</span>
                  </a>
              </li>
              <li>
                  <a href="delivery.php">
                      <i class="bi bi-circle"></i><span>delivery</span>
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
          <a class="nav-link collapsed" href="">
              <i class="bi bi-person"></i>
              <span>Profile</span>
          </a>
      </li>
      <!-- End Profile Page Nav -->

      <li class="nav-item">
          <a class="nav-link collapsed" href="">
              <i class="bi bi-question-circle"></i>
              <span>Help</span>
          </a>
      </li>
      


    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Check Out</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Your Oredr Data</h5>
            <?php
                if($_POST['name']){
                    ?>
                        <table class="table table-bordered border-primary">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</Address></th>
                                <th scope="col">Market</th>
                                <th scope="col">Item</th>
                                <th scope="col">countity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row"><?php echo $_POST['name']?></th>
                                <th scope="row"><?php echo $_POST['email']  ?></th>
                                <th scope="row"><?php echo $_POST['phone'] ?></th>
                                <th scope="row"><?php echo $_POST['address']?></th>
                                <th scope="row"><?php echo $_POST['market']?></th>
                                <th scope="row"><?php echo $_POST['item']?></th>
                                <th scope="row"><?php echo $_POST['countity']?></th>
                                <th scope="row"><?php echo $orderPrice ?></th>
                                <th scope="row"><?php echo$_POST['countity']*$orderPrice?></th>
                            
                                
                            </tr>
                            </tbody>
                        </table>
                    <?php
                } 
            ?>




            <?php
                if($funds > ($orderPrice*$_POST['countity']) ){
                    ?>
                        <form action="checkOutTodelivery.php" method="post">
                            <input type="hidden" name="oname" value="<?php echo $_POST['name']?>">
                            <input type="hidden" name="oemail" value="<?php echo $_POST['email'] ?>">
                            <input type="hidden" name="ophone" value="<?php echo $_POST['phone'] ?>">
                            <input type="hidden" name="oaddress" value="<?php echo $_POST['address']?>">
                            <input type="hidden" name="omarket" value="<?php echo $_POST['market']?>">
                            <input type="hidden" name="oitem" value="<?php echo $_POST['item']?>">
                            <input type="hidden" name="oprice" value="<?php echo $_POST['countity']*$orderPrice ?>">

                            <div class="d-grid gap-2 mt-3">
                                <button type="submit" class="btn btn-success rounded-pill">Confirm</button>
                            </div>
                        </form>
                    <?php
                }else{
                    ?>
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-warning rounded-pill">Your Balance Not Enough Click here to Add</button>
                        </div>
                    <?php
                }
            ?>
            <form action="delivery.php" method="post">
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-danger rounded-pill">Cancel</button>
                </div>
            </form>
        </div>
    </div>
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


