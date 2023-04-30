<?php
session_start();
if(empty($_SESSION["doc"]['logged_in'])) {
    header('Location:index.php');
    die();
}
$username=ucfirst($_SESSION["doc"]["name"]);
?>
<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css">

    <!-- Responsive datatable examples -->
    <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css">

    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">
    <!-- Charts CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css"
        integrity="sha512-SUJFImtiT87gVCOXl3aGC00zfDl6ggYAw5+oheJvRJ8KBXZrr/TMISSdVJ5bBarbQDRC2pR5Kto3xTR0kpZInA=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
        integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <link rel="stylesheet" href="../assets/css/choices.css">
    <link rel="stylesheet" href="../assets/css/choices.min.css">
    <!-- Jquery Toast CSS -->
    <link rel="stylesheet" href="../assets/libs/jquery-toast/jquery.toast.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../assets/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- date range picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- custom css -->
    <link href="../assets/css/customcss.css" id="app-style" rel="stylesheet" type="text/css">
    <link href="../assets/libs/jquery-pin/jquery.pinlogin.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body data-sidebar="">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="../assets/images/Logo-foox-svg.svg" alt height="20">
                            </span>
                            <span class="logo-lg">
                                <img src="../assets/images/Logo-foox.png" alt height="30">
                            </span>
                        </a>

                        <a href class="logo logo-light">
                            <span class="logo-sm">
                                <img src="../assets/images/Logo-foox.png" alt height="20">
                            </span>
                            <span class="logo-lg">
                                <img src="../assets/images/Logo-foox.png" alt height="17">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>


                </div>

                <div class="d-flex">

                    <!-- <div class="dropdown d-inline-block d-lg-none ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->


                    <div class="dropdown d-inline-block">
                        <button type="button" id="profile_ button"
                            class="btn header-item noti-icon right-bar-toggle waves-effect "
                            data-toggle="dropdown"><?php echo   $username;?> <i
                                class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">

                            <!-- <a class="dropdown-item" href="profile.php">

                                <h5>Profile</h5>
                            </a>

                            <a class="dropdown-item" href="password.php">

                                <h5>Change Password</h5>
                            </a>


                            <a class="dropdown-item" href="pin.php">

                                <h5>Change pin</h5>
                            </a> -->
                            <a class="dropdown-item" href="logout.php">

                                <h5>Logout</h5>
                            </a>




                            <!-- <a class="dropdown-item" href="./customer_end/logout.php" data-toggle=""
                                data-target="./customer_end/logout.php">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a> -->
                        </div>

                    </div>





                    <!-- <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="mdi mdi-settings-outline"></i>
                            </button>
                        </div>-->

                </div>
            </div>
        </header>