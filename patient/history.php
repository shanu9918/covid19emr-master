<?php
session_start(); 
include_once('controller/dbconn.php'); 
include_once('includes/header.php'); 
include_once('includes/sidebar.php'); 
include_once("includes/footer.php");
$username=ucfirst($_SESSION["pat"]["name"]);
?>
<title>History | <?php echo $username;?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div id="layout-wrapper">
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                        <input type="hidden" name="hidid" id="hidid" class="hidid" value="<?php echo $_SESSION["pat"]["pat_id"];?>">
                        </div>
                    </div>
                    <div class="col-auto float-right ml-auto">
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Patient History</h4>
                                <div class="table-responsive">
                                    <div class="live-order-list">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var pat_id=$("#hidid").val();
    show_patient_history();
    // setInterval(function(){ show_patient_history(); }, 3000);
    function show_patient_history() {
        $.ajax({
            type: "POST",
            url: "controller/common_controller.php",
            data: {
                pat_id:pat_id,
                Type: "show_patient_history"
            },
            success: function(result) {
                $(".live-order-list").html(result);
            }
        });
    }
    $(document).on('click','.upload',function(){
        pat_id=$(this).data("id");
        $.ajax({
            type: "POST",
            url: "download.php",
            data: {
                "pat_id": pat_id
            },
            success: function(result) {
                console.log(result);
            }
        });
    });
});
</script>