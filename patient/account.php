<?php
session_start(); 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once('controller/dbconn.php'); 
include_once('includes/header.php'); 
include_once('includes/sidebar.php'); 
include_once("includes/footer.php");
$username=ucfirst($_SESSION["pat"]["name"]);
$id=$_SESSION["pat"]["Id"];
$email=$_SESSION["pat"]["email"];
?>
<title>Account | <?php echo $username;?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>Profile</title>
<div id="layout-wrapper">
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h3 class="font-size-28">Profile</h3>
                            <ol class="breadcrumb mb-0">
                                <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">View Profile</a></li> -->
                            </ol>
                        </div>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div>
                            <a href="#" class="btn add-btn btn-primary edit_customer" data-toggle="modal"
                                data-target="#edit_customers"><i class="fa fa-pen"></i> Edit Profile</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="view_profile" class="table mb-0 table-bordered dt-responsive nowrap">
                                    <tbody>
                                        <?php
                                            $sel_query="SELECT * FROM `patient_det` WHERE id = '".$id."'";
                                            $result = return_array($sel_query);
                                            foreach($result as $row) { 
                                            ?>
                                        <tr>
                                            <td><b>NAME</b></td>
                                            <td><?php echo $username; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>EMAIL</b></td>
                                            <td><?php echo $row["email"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>AGE</b></td>
                                            <td><?php if($row["age"]=='0'){print("-");}else{
                                              echo $row["age"];
                                            } ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>GENDER</b></td>
                                            <td><?php if($row["gender"]=='0'){print("-");}else{
                                                echo $b = $row["gender"]=='1' ? 'Male' : 'Female';
                                            }?></td>
                                        </tr>
                                        <tr>
                                            <td><b>PHONE NUMBER</b></td>
                                            <td><?php if($row["ph_number"]=='0'){print("-");}else{
                                              ?>+91 <?php 
                                              echo $row["ph_number"];
                                            } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>HEIGHT</b></td>
                                            <td><?php if($row["height"]=='0'){print("-");}else{
                                              echo $row["height"];
                                              ?> feet<?php
                                            } ?> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>WEIGHT</b></td>
                                            <td><?php if($row["weight"]=='0'){print("-");}else{
                                              echo $row["weight"];
                                              ?> Kg<?php
                                            } ?> 
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div id="edit_customers" class="modal  custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <!-- modal================== -->
                                <div class="modal-body">
                                    <form id="customer_form" style="align:center;" class="customer_form"
                                        name="customer_form">


                                        <div class="row">
                                            <div class="col-lg-6">

                                                <div>
                                                    <div class="form-group mb-4">
                                                        <label for="venture_name">Name</label>
                                                        <input type="text" class="form-control" name="venture_name"
                                                            value="<?php echo $get_role["venture_name"];?>"
                                                            id="venture_name" placeholder="<?php echo $username; ?>"
                                                            autocomplete="off" disabled>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label for="age">Age</label>
                                                        <input type="number" class="form-control" name="age"
                                                            id="age" placeholder="Enter Age" min="1" max="130" autocomplete="off">
                                                    </div>
                                                    <input type="hidden" name="hidid" id="hidid" class="hidid" />
                                                    <div class="form-group mb-4">
                                                        <label for="zone">Gender</label>
                                                        <select id="gender" class="form-control">
                                                            <option value="0">Select</option>
                                                            <option value="1">Male</option>
                                                            <option value="2">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label for="ph_number">Phone Number</label>
                                                    <input type="text" class="form-control" name="ph_number"
                                                        id="ph_number" placeholder="Enter phone number"
                                                        autocomplete="off">
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="height">Height</label>
                                                    <input type="number" class="form-control" name="height" id="height"
                                                        placeholder="Enter height(feet)" autocomplete="off">
                                                </div>
                                                <div class=" password form-group mb-4">
                                                    <label for="weight">Weight</label>
                                                    <input type="number" class="form-control" name="weight" id="weight"
                                                        placeholder="Enter weight(Kg s)" autocomplete="off">
                                                </div>
                                                <!-- <span id="phone-availability-status"></span></label>
                                                <span id="phone_validate" class="r"></span></label> -->
                                            </div>
                                            <div class="form-group mb-4">
                                                <button class="btn btn-primary w-md waves-effect waves-light"
                                                    id="edit_btn">Edit
                                                </button>
                                            </div>
                                        </div>
                                </div>
                                <!-- <div id="hide-div" class="form-group row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary w-md waves-effect waves-light" id="edit">Edit
                                        </button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $(".edit_customer").click(function() {
        var userid = "<?php echo $id; ?>";
        call_edit_page(userid);
    });
    function call_edit_page(user_id) {
        $.ajax({
            type: "POST",
            url: "controller/common_controller.php",
            data: {
                user_id: user_id,
                Type: "fetch_customer_details"
            },
            success: function(result) {
                var res1 = JSON.parse(result);
                $("#age").val(res1.age);
                $("#gender").val(res1.gender);
                $("#ph_number").val(res1.ph_number);
                $("#height").val(res1.height);
                $("#weight").val(res1.weight);
            }
        });
    }
    $("#edit_btn").click(function(e) {
        e.preventDefault();
        var id=<?php echo $id; ?>;
        var age = $("#age").val();
        var gender=0;
        var gender = $("#gender").val();
        var ph_number = $("#ph_number").val();
        var height = $("#height").val();
        var weight = $("#weight").val();
        register(id,age,gender,ph_number,height,weight);
    });

    function register(id,age,gender,ph_number,height,weight) {
        $.ajax({
            type: "POST",
            url: "controller/common_controller.php",
            data: {
                id: id,
                age:age.trim(),
                gender:gender,
                ph_number:ph_number.trim(),
                height:height.trim(),
                weight:weight.trim(),
                Type: "edit_profile"
            },
            success: function(result) {
                window.location.reload();
            }
        });
    }
});
</script>