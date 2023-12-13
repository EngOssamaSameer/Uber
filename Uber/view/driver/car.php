<?php
session_start();
if(!isset($_SESSION["userRole"])){
  header("location: ../../view/main/login.php");
}else{
  if($_SESSION["userRole"] != "driver" ){
    header("location: ../../view/main/login.php");

  }
}
//-----------Uplaod Profile photo ---------------/
require_once '../../controller/profileController.php';
$profile = new profileController ;
$loc ;
if(isset($_FILES['CarImage']) ){
    if(!empty($_FILES['CarImage'])){
        $loc = "../images/" . date('h-i-s') . $_FILES['CarImage']['name'] ;
        if(move_uploaded_file($_FILES['CarImage']['tmp_name'],$loc)){
            $profile->updateCarPhoto($_SESSION["userId"],$loc);    
        }
    }
}
//-----------Uplaod Profile information ---------------/

require_once '../../controller/profileController.php';
$profile = new profileController ;
if(isset($_POST['carModel']) && isset($_POST['carNumber']) && isset($_POST['carKind'])){
    if(!empty($_POST['carModel']) && !empty($_POST['carNumber']) && !empty($_POST['carKind']) && !empty($_POST['fair']) ){

        $profile->updateCarInfo($_SESSION["userId"],$_POST['carModel'],$_POST['carNumber'],$_POST['carKind'],$_POST['fair']);//
        
    }
}
//-----------car SELECT CAR INFO ---------------/
require_once '../../model/car.php';
require_once '../../controller/profileController.php';
$profile = new profileController ;
$car = new Car ;
$res3 = "" ;
if($profile->selecCar($_SESSION["userId"])){
    $res3 = $profile->selecCar($_SESSION["userId"]) ;
}
if($res3){
    $car->model=$res3[0]['model'];
    $car->number=$res3[0]['caeNumber'];
    $car->kind=$res3[0]['CaeKind'];
    $car->fair=$res3[0]['fair'];
    $car->photo=$res3[0]['carImage'];

}else{
    $car->model="Car";
    $car->number="123 | AB";
    $car->kind="Car";
    $car->photo="../images/defaultCar.png";
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

    <title>Profile</title>
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
                    <i class="bi bi-bookmarks-fill"></i><span>Request</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="requesrTrip.php">
                            <i class="bi bi-circle"></i><span>Request(Trip)</span>
                        </a>
                    </li>
                    <li>
                    <a href="requestOrder.php">
                            <i class="bi bi-circle"></i><span>Request(Order)</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Components Nav -->


            <!-- End Forms Nav -->


            <li class="nav-heading">Pages</li>
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
            <!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="help.php">
                    <i class="bi bi-question-circle"></i>
                    <span>Help</span>
                </a>
            </li>

        </ul>

    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Car info</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item">Driver</li>
                    <li class="breadcrumb-item active">Car info</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="<?php echo "$car->photo" ?>" alt="Profile" class="rounded-circle">
                            <h2><?php echo "$car->model"?></h2>
                            <h3><?php echo "$car->number"?></h3>
                            

                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Cae Info</button>
                                </li>



                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                  <h6 class="card-title">Car Info</h6>


                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Model</div>
                                        <div class="col-lg-9 col-md-8"><?php echo "$car->model"?></div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Car Number </div>
                                        <div class="col-lg-9 col-md-8"><?php echo "$car->number"?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Kind</div>
                                        <div class="col-lg-9 col-md-8"><?php echo "$car->kind"?></div>
                                    </div>
                                    

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Fair/Hour</div>
                                        <div class="col-lg-9 col-md-8"><?php echo "$car->fair"?></div>
                                    </div>

                                

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                        <!-- change photo -->
                            <div class="row mb-3">
                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                <div class="col-md-8 col-lg-9">
                                    <img src="<?php echo "$car->photo"?>" alt="Profile">
                                    <div class="pt-2">
                                        <form action="car.php" method="post" enctype="multipart/form-data">
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i></button>
                                            <input type="file" name="CarImage" >
                                        </form>
                                    </div>
                                </div>

                            </div>
                                <!-- change photo -->

                                    <form action="car.php" method="post">

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Car Model</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="carModel" type="text" class="form-control" id="fullName" placeholder="Enter Car Model">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Care Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="carNumber" type="text" class="form-control" id="Phone" placeholder="as 123 | ABC ">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Kind Of Car</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="carKind" type="text" class="form-control"  placeholder="as Car or Moto or Truck ...">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Fair/Hour</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fair" type="number" class="form-control"  placeholder="Enter fair per hour">
                                            </div>
                                        </div>



                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                    <!-- End Profile Edit Form -->

                                </div>
                            

                            </div>
                            <!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>



    </main>
    <!-- End #main -->

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
    <!-- End Footer -->












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











