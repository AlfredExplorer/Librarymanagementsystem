<?php
session_start();
include "connection.php";
global $link;
$res=mysqli_query($link,"select * from messages where dusername='$_SESSION[student]' && seen='n'");
$total=mysqli_num_rows($res);
$_SESSION['total']=$total;
?>
<!DOCTYPE html >
<html lang = "en" >
<head >
    <meta http - equiv = "Content-Type" content = "text/html; charset=UTF-8" >
    <!--Meta, title, CSS, favicons, etc . -->
    <meta charset = "utf-8" >
    <meta http - equiv = "X-UA-Compatible" content = "IE=edge" >
    <meta name = "viewport" content = "width=device-width, initial-scale=1" >

    <title > Plain Page | LMS </title >


    <link href = "css/bootstrap.min.css" rel = "stylesheet" >
    <link href = "css/font-awesome.min.css" rel = "stylesheet" >
    <link href = "css/nprogress.css" rel = "stylesheet" >
    <link href = "css/custom.min.css" rel = "stylesheet" >
</head >

<body class="nav-md" >
<div class="container body" >
    <div class="main_container" >
        <div class="col-md-3 left_col" >
            <div class="left_col scroll-view" >
                <div class="navbar nav_title" style = "border: 0;" >
                    <a href = "#" class="site_title" ><i class="fa fa-book" ></i > <span > LMS</span ></a >
                </div >

                <div class="clearfix" ></div >

               <!-- menu profile quick info-->
                <div class="profile clearfix" >
                    <div class="profile_pic" >
                        <img src = "images/user.png" alt = "..." class="img-circle profile_img" >
                    </div >
                    <div class="profile_info" >
                        <span > Welcome,</span >

                        <h2 > John Doe </h2 >
                    </div >
                    <div class="clearfix" ></div >
                </div >
                <!-- menu profile quick info-->

                <br />

                <!-- sidebar menu-->
                <div id = "sidebar-menu" class="main_menu_side hidden-print main_menu" >
                    <div class="menu_section" >
                        <h3 > General</h3 >
                        <ul class="nav side-menu" >
                            <li ><a ><i class="fa fa-home" ></i > Home <span class="fa fa-chevron-down" ></span></a >

                            </li >
                            <li ><a ><i class="fa fa-edit" ></i > Forms <span class="fa fa-chevron-down" ></span></a >

                            </li >
                            <li ><a ><i class="fa fa-desktop" ></i > UI Elements <span class="fa fa-chevron-down" ></span></a >

                            </li >
                            <li ><a ><i class="fa fa-table" ></i > Tables <span class="fa fa-chevron-down" ></span></a >

                            </li >
                            <li ><a ><i class="fa fa-bar-chart-o" ></i > Data Presentation <span class="fa fa-chevron-down" ></span></a >

                            </li >

                        </ul >
                    </div >


                </div >

            </div >
        </div >

        <!-- top navigation-->
        <div class="top_nav" >
            <div class="nav_menu" >
                <nav >
                    <div class="nav toggle" >
                        <a id = "menu_toggle" ><i class="fa fa-bars" ></i ></a >
                    </div >

                    <ul class="nav navbar-nav navbar-right" >
                        <li class="" >
                            <a href = "javascript;" class="user-profile dropdown-toggle" data - toggle = "dropdown"
                               aria - expanded = "false" >
                                <img src = "images/user.png" alt = "" > John Doe <span class=" fa fa-angle-down"></span>
                            </a >
                            <ul class="dropdown-menu dropdown-usermenu pull-right" >
                                <li ><a href = "login.html" ><i class="fa fa-sign-out pull-right" ></i > Log Out </a ></li >
                            </ul >
                        </li >

                        <li role = "presentation" class="dropdown" >
                            <a href = "message_from_librarian.php" class="dropdown-toggle info-number" data - toggle = "dropdown"
                               aria - expanded = "false" >
                                <i class="fa fa-envelope-o" ></i >
                                <span class="badge bg-green" > <?php echo $total;?></span>
                            </a >

                        </li >
                    </ul >
                </nav >
            </div >
        </div >
        <!-- top navigation-->