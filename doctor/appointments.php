<?php
include_once('includes/header.php'); 
include_once('includes/sidebar.php'); 
include_once("includes/footer.php"); 
?>
<title>Schedule | Doctor</title>
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
                        </div>
                    </div>
                    <div class="  col-auto float-right ml-auto">
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Patient Requests</h4>
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
    show_current_list();
    setInterval(function() {
        show_current_list();
    }, 4500);

    function show_current_list() {
        $.ajax({
            type: "POST",
            url: "controller/common_controller.php",
            data: {
                Type: "show_current_list"
            },
            success: function(result) {
                $(".live-order-list").html(result);
            }
        });
    }

    $(document).on("click", ".accept_btn", function() {
        var status = 1;
        var appointment_id = $(this).attr("id");
        change_status(appointment_id, status);
    });

    $(document).on("click", ".reject_btn", function() {
        var status = 2;
        var appointment_id = $(this).attr("id");
        change_status(appointment_id, status);
    });

    function change_status(appointment_id, status) {
        $.ajax({
            type: "POST",
            url: "controller/common_controller.php",
            data: {
                status: status,
                appointment_id: appointment_id,
                Type: "change_appointment"
            },
            success: function(result) {
                show_current_list();
            }
        });
    }
});
</script>