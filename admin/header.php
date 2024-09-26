<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<meta name="description" content="consulting and trainning">
	<meta name="keyword" content="Joshua Co">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Joshua co</title>
 
    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

      <!-- plugins -->
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/fullcalendar.min.css"/>
	<link href="asset/css/style.css" rel="stylesheet">
	<!-- end: Css -->

	<link rel="shortcut icon" href="asset/img/favicon.png">
 
  </head>

 <body id="mimin" class="dashboard">
  <?php include ('connect.php') ?>
      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="index.html" class="navbar-brand"> 
                 <b>JOSHUA CO</b>
                </a>

            </div>
          </div>
        </nav>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
  
          <!-- start:Left Menu -->
            <div id="left-menu">
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                    <li><div class="left-bg"></div></li>
                    <li class="time">
                      <h1 class="animated fadeInLeft"></h1>
                      <p class="animated fadeInRight"></p>
                    </li>
                    <li class="active ripple">
                      <a href="home.php"  ><span class="fa-home fa"></span> Dashboard 
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                        <li class="ripple"><a href="Subscribers.php"><span class="fa fa-check-square-o"></span> Subcribers  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                      </li>
                    <li class="ripple"><a href="Bookings.php"><span class="fa fa-table"></span> Bookings  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                        </li>
                        <li class="ripple"><a href="logout.php"><span class="fa fa-sign-out"></span> Log out  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                        </li>
                  </ul>
                </div>
            </div>
          <!-- end: Left Menu -->
