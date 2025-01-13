<?php 
    include 'includes/connection.php';
    session_start();
    if(empty($_SESSION)){
        echo "<script>alert('You are currently not logged in.'); window.location = 'index.php';</script>";
    }
    $userid=$_SESSION['userid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TimeKeeping</title>
        <link type="text/css" href="bootstrap/css/jquery.dataTables.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/design.css">
    </head>
    <style type="text/css">
        ::-webkit-scrollbar {
            width: 7px;
        }
        ::-moz-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #fff; 
        }
        ::-moz-scrollbar-track {
            background: #fff; 
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background:  #007496;
            border-radius: 50px; 
        
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #00adff;
        }
        .dropzone{
            min-height: 330px;
            border:1px solid #e5e5e5;
            width: 100%!important;
        }
        .btn-w{
            width:100%;
        }
        #loader {
          display: block;
          width: 150px;
          height: 150px;
          position: fixed;
          top: 50%;
          left: 45%;
          margin-top: -75px;
          margin-left: -75px;
          text-align: center;
          color: white;
          font: 24px/150px Tahoma;
          text-shadow: 0px 1px 2px rgba(0,0,0,0.5);
          -webkit-transform-style: preserve-3d;
          transform-style: preserve-3d;
        }

        #loader figure {
            display: block;
            position: absolute;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .one {
            z-index: 3;
            background-image: linear-gradient(to top right, #25858a 0% ,#9bd9f7 100%);
            background-size: 100% 100%;
            -webkit-animation: move-one 2s infinite ease;
            animation: move-one 2s infinite ease;
            border-radius: 50%;
            box-shadow: 0px 0px 10px 1px #999;
        }

        .two {
            z-index: 1;
            border-radius: 10px;
            background-image:  linear-gradient(to top right, #25858a 0% ,#9bd9f7 100%);
            -webkit-transform: rotateX(180deg);
            transform: rotateX(180deg);
            -webkit-animation: move-two 2s infinite ease;
            animation: move-two 2s infinite ease;
            border-radius: 50%;
        }


        @keyframes move-one {
          0%   { transform: rotateX(0deg); }
          25%  { transform: rotateX(180deg); }
          50%  { transform: rotateX(180deg); }
          75%  { transform: rotateX(360deg); }
          100% { transform: rotateX(360deg); }
        }

        @keyframes move-two {
          0%   { transform: rotateX(180deg); }
          25%  { transform: rotateX(0deg); }
          50%  { transform: rotateX(0deg); }
          75%  { transform: rotateX(-180deg); }
          100% { transform: rotateX(-180deg); }
        }
         
         @-webkit-keyframes move-one {
          0%   { -webkit-transform: rotateX(0deg); }
          25%  { -webkit-transform: rotateX(180deg); }
          50%  { -webkit-transform: rotateX(180deg); }
          75%  { -webkit-transform: rotateX(360deg); }
          100% { -webkit-transform: rotateX(360deg); }
         }

        @-webkit-keyframes move-two {
          0%   { -webkit-transform: rotateX(180deg); }
          25%  { -webkit-transform: rotateX(0deg); }
          50%  { -webkit-transform: rotateX(0deg); }
          75%  { -webkit-transform: rotateX(-180deg); }
          100% { -webkit-transform: rotateX(-180deg); }
        }

       /* #contents{
            display: none;
        }*/
    /*i.icon-chevron-left,i.icon-chevron-right{display: none;}*/
 /*   #myTable_previous{background: #81c0cf;}
    #myTable_previous:hover{background: #276473;}
    .previous::after{content: "hello";}
    #myTable_next {background: #cf8181;}
    #myTable_next:hover{background:#732727 ;}
    #myTable_previous,#myTable_next{border: 1px solid #bdbdbd;}
    #myTable_next{ border-left:none;}
    #myTable_previous.disabled,#myTable_next.disabled{background: #ced9dc;}*/
    
    </style>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html">CENTRAL NEGROS POWER RELIABILITY INC. </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">                        
                        <ul class="nav pull-right">
                            <li><a href="home.php">DASHBOARD </a></li>        
                            <?php if($_SESSION['usertype']=='admin') { ?>                    
                            <!-- <li><a href="uploadfile.php">UPLOAD FILE</a></li> -->
                            <?php } ?>
                            <!-- <li><a href="qr_code_reader.php">QR SCANNER</a></li> -->
                            <!-- <li><a href="report.php">REPORT OLD</a></li> -->
                            <li><a href="report_qr.php">REPORT</a></li>
                            <li><a href="incomplete_logs.php">INCOMPLETE LOGS</a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $_SESSION['fullname'];?>
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>