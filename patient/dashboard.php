<?php
session_start(); 
include_once('controller/dbconn.php'); 
include_once('includes/header.php'); 
include_once('includes/sidebar.php'); 
include_once("includes/footer.php");
// $number=20;
$username=ucfirst($_SESSION["pat"]["name"]);
$efficient_data=$_SESSION["pat"]["efficient_data"];
$timeOfDay = date('a');
$pat_id=$_SESSION["pat"]["pat_id"];
if($timeOfDay == 'am'){
    $greeting='Good morning';
}else{
    $greeting='Good evening';
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<title>Dashboard | <?php echo $username;?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <ol class="breadcrumb mb-0">
                            <!-- <li class="breadcrumb-item active">Welcome to Foox Gro Dashboard</li> -->
                        </ol>
                    </div>
                    <!-- <div id="reportrange"
                        style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div> -->
                </div>
            </div>
            <div class="row" style="margin-top:10px;">
                <div class="col" style="text-align:center;">
                <?php if($efficient_data==0){ ?>
                    <div class="alert alert-danger" role="alert">
                        Details Not Updated. Please visit <a href="./account.php">My account</a> to update your details
                    </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $greeting; ?> <span style="font-weight:bold;">
                                    <?php echo $username; ?> </span></h5>
                            <?php
                                $sel_query="SELECT COUNT(*) AS count FROM `appointment` WHERE pat_id='".$pat_id."' AND appointment.book_time>NOW() AND appointment.status=1 ORDER BY appointment.book_time ASC";
                                $result = return_single($sel_query);
                            ?>
                            <p class="card-text">You have <?php echo $b=$result["count"]>0?$result["count"]:'0'; ?> appointments today.</p>
                            <a href="schedule.php" class="btn btn-primary">View Schedule</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><span class="font-weight-bold">Upcoming patients</span></h4>
                            <div class="table-responsive">
                                <div class="live-order-list">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end sample -->
        </div>
        <!-- end row -->
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function() {
    var id = "<?php echo $_SESSION["pat"]["pat_id"];?>";
    show_current_list();
    setInterval(function() {
        show_current_list();
    }, 4500);
    function show_current_list() {
        $.ajax({
            type: "POST",
            url: "controller/common_controller.php",
            data: {
                id: id,
                Type: "show_patient_list"
            },
            success: function(result) {
                $(".live-order-list").html(result);
            }
        });
    }
});
</script>