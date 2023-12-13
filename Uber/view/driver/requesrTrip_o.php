<?php
session_start();
if(!isset($_SESSION["userRole"])){
  header("location: ../../view/main/login.php");
}else{
  if($_SESSION["userRole"] != "driver" ){
    header("location: ../../view/main/login.php");

  }
}  
//-----------select all notifi ---------------/
$i = 0; 
require_once '../../controller/profileController.php';
$profile = new profileController ;
$res = "" ;
if($profile->selectAllNotifi($_SESSION["userId"])){
    $res = $profile->selectAllNotifi($_SESSION["userId"]) ;
}
//-----------select all requst again ---------------/
require_once '../../controller/eatController.php';
$eat = new eatController ;
$trips = $eat->selectrequestTripForDriver($_SESSION['userId']);
/*  ---------- end Requset Trip ----------  */
// cash 
require_once '../../controller/cashController.php';
$cash = new cashController ;
$driverfunds ;
$onerfunds ;
$userfunds ;
if( $trips ){
    $driverfunds = $cash->selectFunds($_SESSION["userId"]) ;
    $onerfunds = $cash->selectFunds(9) ;
    $userfunds = $cash->selectFunds( $trips[0]['passengerId'] ) ;
}

//-----------select all requst again ---------------/
require_once '../../controller/eatController.php';
$eat = new eatController ;
$trips = $eat->selectrequestTripForDriver($_SESSION['userId']);
// case one
if(isset($_POST['accept'])){
    $eat->changeTripCase1(1 , $trips[0]['requestTrip']) ;
    $trips = $eat->selectrequestTripForDriver($_SESSION['userId']);
}    
// case tow
else if(isset($_POST['reject'])){
    $eat->changeTripCase2($_SESSION['userId'] , $trips[0]['requestTrip']);
    $trips = $eat->selectrequestTripForDriver($_SESSION['userId']);

}
// case there
else if(isset($_POST['start'])){
    $eat->changeTripCase3(3 , $trips[0]['requestTrip']) ;
    $trips = $eat->selectrequestTripForDriver($_SESSION['userId']);
    //$trips = false ; 
}
// case four
else if(isset($_POST['end'])){

    //fair 
    $eat->changeTripCase4(4 , $trips[0]['requestTrip']) ;
    $trips = $eat->selectrequestTripForDriver($_SESSION['userId']);
}
// case five
else if(isset($_POST['newRequst'])){
    //fair
    if($trips[0]['payment'] == 'Wallet'){
        $cash->addFundsToDriverAndOnerFormTrip($_POST['fair'] ,$_POST['user'],$_POST['userCash'],$_POST['driver'],$_POST['driverCash'],$_POST['onerCash']);
    }

    $eat->changeTripCase5( $_SESSION['userId'], $trips[0]['requestTrip']) ;
    header("location: ../../view/driver/home.php");
}





?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <title>Request Trip </title>
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
                        <a href="requesrOrder.php">
                            <i class="bi bi-circle"></i><span>Request(Order)</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Components Nav -->


            <!-- End Forms Nav -->


            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="home.php">
                    <i class="bi bi-person"></i>
                    <span>Home</span>
                </a>
            </li>
            <!-- End Profile Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="car.php">
                    <i class="bi bi-person"></i>
                    <span>Car Info</span>
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
            <!-- End F.A.Q Page Nav -->


        </ul>

    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Request Trip</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item">Driver</li>
                    <li class="breadcrumb-item active">Request Trip</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        <?php
        if($trips)
            ?>
                <section class="section profile">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Request Trip</h5>

                        <!-- Table with stripped rows -->
                        <?php
                            if($trips[0]['cas'] == 0){
                                ?>
                                    <table class="table table-bordered border-primary ">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Drop</th>
                                            <th scope="col">Pickup</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Accept</th>
                                            <th scope="col">Reject</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $trips[0]['name']?></th>
                                                <th scope="row"><?php echo $trips[0]['phone']?></th>
                                                <th scope="row"><?php echo $trips[0]['drop']?></th>
                                                <th scope="row"><?php echo $trips[0]['pickup']?></th>
                                                <th scope="row"><?php echo $trips[0]['payment']?></th>
                                                <th scope="row"> 
                                                    <form action="requesrTrip.php" method="post">
                                                        <input type="hidden" name="accept" value="1">
                                                        <button type="submit" class="btn btn-outline-success">Accept</button>
                                                    </form>
                                                </th>  
                                                <th scope="row"> 
                                                    <form action="requesrTrip.php" method="post">
                                                        <input type="hidden" name="reject" value="0">
                                                        <button type="submit" class="btn btn-outline-danger">Reject</button>
                                                    </form>
                                                </th>    
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php
                            }else if($trips[0]['cas'] == 1){
                                ?>
                                    
                                    <table class="table table-bordered border-primary ">
                                        <thead>
                                        <tr>                                    
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Drop</th>
                                            <th scope="col">Pickup</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Start Trip</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $trips[0]['name']?></th>
                                                <th scope="row"><?php echo $trips[0]['phone']?></th>
                                                <th scope="row"><?php echo $trips[0]['drop']?></th>
                                                <th scope="row"><?php echo $trips[0]['pickup']?></th>
                                                <th scope="row"><?php echo $trips[0]['payment']?></th>
                                                <th scope="row"> 
                                                    <form action="requesrTrip.php" method="post">
                                                        <input type="hidden" name="start" value="1">
                                                        <button type="submit" class="btn btn-outline-info">Start Trip</button>
                                                    </form>
                                                </th>    
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php
                            }else if($trips[0]['cas'] == 3){
                                ?>
                                    
                                    <table class="table table-bordered border-primary ">
                                        <thead>
                                        <tr>                                    
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Drop</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">End Trip</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $trips[0]['name']?></th>
                                                <th scope="row"><?php echo $trips[0]['phone']?></th>
                                                <th scope="row"><?php echo $trips[0]['pickup']?></th>
                                                <th scope="row"><?php echo $trips[0]['payment']?></th>
                                                <th scope="row"> 
                                                    <form action="requesrTrip.php" method="post">
                                                        <input type="hidden" name="end" value="1">
                                                    
                                                        <button type="submit" class="btn btn-outline-dark">End Trip</button>
                                                    </form>
                                                </th>    
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                <?php
                                require_once 'maps.php';
                            }else if($trips[0]['cas'] == 4){
                                ?>
                                    
                                    <table class="table table-bordered border-primary ">
                                        <thead>
                                        <tr>                                    
                                            <th scope="col">Start Time</th>
                                            <th scope="col">End Time</th>
                                            <th scope="col">total Time</th>
                                            <th scope="col">total Fair</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Rate</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $trips[0]['sDate']?></th>
                                                <th scope="row"><?php echo $trips[0]['eDate']?></th>
                                                <th scope="row"><?php 
                                                    $start_date = new DateTime($trips[0]['sDate']); 
                                                    $since_start = $start_date->diff(new DateTime($trips[0]['eDate']));
                                                    echo ($since_start->h) + (($since_start->i)/60)
                                                ?></th>
                                                <th scope="row"><?php echo (($since_start->h) + (($since_start->i)/60))*($trips[0]['cash'])?></th>
                                                <th scope="row"><?php echo $trips[0]['payment']?></th>
                                                <th scope="row"> 
                                                    <form action="requesrTrip.php" method="post">
                                                        <input type="hidden" name="newRequst" value="1">
                                                        <!-- Fair -->
                                                        <input type="hidden" name="fair" value="<?php echo (($since_start->h) + (($since_start->i)/60))*($trips[0]['cash']) ?>">
                                                        <input type="hidden" name="user" value="<?php echo $trips[0]['passengerId'] ?>">
                                                        <input type="hidden" name="driver" value="<?php echo $_SESSION["userId"] ?>">
                                                        <input type="hidden" name="userCash" value="<?php echo $userfunds[0]['funds']?>">
                                                        <input type="hidden" name="driverCash" value="<?php echo $driverfunds[0]['funds'] ?>">
                                                        <input type="hidden" name="onerCash" value="<?php echo $onerfunds[0]['funds'] ?>"> 
                                                        <button type="submit" class="btn btn-outline-warning">New Request</button>
                                                    </form>
                                                </th>    
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <!-- Rate User -->
                                    
    <div class="container">
    	
    	<div class="card">
    		<div class="card-header">RATEING</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-4 mb-4">
    						<b><span id="average_rating">0.0</span> / 5</b>
    					</h1>
    					<div class="mb-3">
    						<i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
	    				</div>
    					<h3><span id="total_review">0</span> Review</h3>
    				</div>
    				<div class="col-sm-4">
    					<p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
    				</div>
    				<div class="col-sm-4 text-center">
    					<h3 class="mt-4 mb-3">ENTER RATEING HERE</h3>
    					<button type="button" name="add_review" id="add_review" class="btn btn-primary">Rateing</button>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="mt-5" id="review_content"></div>
    </div>


<div id="review_modal" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Submit Rate</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	      		<h4 class="text-center mt-2 mb-4">
	        		<i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
	        	</h4>
	        	<div class="form-group">
	        		<input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
	        	</div>
	        	
	        	<div class="form-group text-center mt-4">
	        		<button type="button" class="btn btn-primary" id="save_review">Submit</button>
	        	</div>
	      	</div>
    	</div>
  	</div>
</div>

<style>
.progress-label-left
{
    float: left;
    margin-right: 0.5em;
    line-height: 1em;
}
.progress-label-right
{
    float: right;
    margin-left: 0.3em;
    line-height: 1em;
}
.star-light
{
	color:#e9ecef;
}
</style>

<script>

$(document).ready(function(){

	var rating_data = 0;

    $('#add_review').click(function(){

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function(){

        var user_name = $('#user_name').val();

        var user_review = $('#user_review').val();

        if(user_name == '' || user_review == '')
        {
            alert("Please Fill Both Field");
            return false;
        }
        else
        {
            $.ajax({
                url:"submit_rating.php",
                method:"POST",
                data:{rating_data:rating_data, user_name:user_name, user_review:user_review},
                success:function(data)
                {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    alert(data);
                }
            })
        }

    });

    load_rating_data();

    function load_rating_data()
    {
        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{action:'load_data'},
            dataType:"JSON",
            success:function(data)
            {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                if(data.review_data.length > 0)
                {
                    var html = '';


                        for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';

                            if(data.review_data[count].rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'star-light';
                            }

                            html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                        }

                        html += '<br />';

                        html += data.review_data[count].user_review;

                        html += '</div>';

                        html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    

                    $('#review_content').html(html);
                }
            }
        })
    }

});

</script>
            
                           

                        <!-- End Table with stripped rows -->

                        </div>
                </section>
            <?php
        }/*else{
            ?>
                <section class="section profile">
                    <h3>You not a Requset Trip </h3>
                </section>    
            <?php
        }*/
        ?>

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






<?php
echo "<pre>";
print_r($trips) ;
echo "</pre>";


?>