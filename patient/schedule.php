<?php
session_start(); 
include_once('controller/dbconn.php'); 
include_once('includes/header.php'); 
include_once('includes/sidebar.php'); 
include_once("includes/footer.php");
$username=ucfirst($_SESSION["pat"]["name"]);
?>
<title>Schedule | <?php echo $username;?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <ol class="breadcrumb mb-0">
                            <!-- <li class="breadcrumb-item active">Welcome to Foox Gro Dashboard</li> -->
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:10px;">
                <div class="col" style="text-align:center;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><span style="font-weight:bold;">
                                    Book Appointment</span></h5>
                            <p class="card-text"> <input class="form-control" type="datetime-local" id="book_date"
                                    name="book_date">
                            </p>
                            <button class="btn btn-primary" id="req">Send Request</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><span class="font-weight-bold">Appointments</span></h4>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function() {
    var id = "<?php echo $_SESSION["pat"]["pat_id"];?>";
    show_current_list();
    setInterval(function() {
        show_current_list();
    }, 4500);
    var todaysDate = new Date();
    var year = todaysDate.getFullYear();
    var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);
    var day = ("0" + todaysDate.getDate()).slice(-2);
    var minDate = (year + "-" + month + "-" + day + "T08:30");
    $("#book_date").attr('min', minDate);

    $(document).on("click", "#req", function() {
        var book_date = $("#book_date").val();
        if (book_date) {
            $.ajax({
                type: "POST",
                url: "controller/common_controller.php",
                data: {
                    book_date: book_date,
                    id: id,
                    Type: "patient_req_entry"
                },
                success: function(result) {
                    show_current_list();
                    Toastify({
                        text: "Appointment Booked",
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        className: "info",
                    }).showToast();
                    $("#book_date").val("");
                    // setTimeout(function() {
                    //     location.reload(true);
                    // }, 1500);
                }
            });
        }
    });

    function show_current_list() {
        $.ajax({
            type: "POST",
            url: "controller/common_controller.php",
            data: {
                id: id,
                Type: "show_patient_appoint_list"
            },
            success: function(result) {
                $(".live-order-list").html(result);
            }
        });
    }
});
</script>