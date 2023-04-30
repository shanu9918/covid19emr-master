<?php
session_start(); 
include_once('controller/dbconn.php'); 
include_once('includes/header.php'); 
include_once('includes/sidebar.php'); 
include_once("includes/footer.php");
$username=ucfirst($_SESSION["pat"]["name"]);
?>
<title>Prediction | <?php echo $username;?></title>
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
                        </ol>
                    </div>
                </div>
            </div>
            <!-- <div id="heart_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Items</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                        <iframe src="http://127.0.0.1:7132/" width="600" style="border:none;" height="400">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div> -->
            <div id="covid_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">COVID-19 Prediction with Lungs Images</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                        <iframe src="https://xraydetectioncovid19.herokuapp.com/" width="600" style="border:none;" height="400">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div id="diabetes_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Items</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                        <iframe src="http://127.0.0.1:8132/" width="600" style="border:none;" height="400">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pneumonia_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Items</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                        <iframe src="http://127.0.0.1:9176/" width="600" style="border:none;" height="400">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="row">
                <div class="col-lg-6"> -->
                <div class="text-center">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="card-title">COVID-19 Prediction</h4>
                            <p class="card-title-desc"><code class="highlighter-rouge">Algorithm Used :</code> CNN<br>
                            <code class="highlighter-rouge">Accuracy :</code> 91%
                            </p>
                                <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#covid_modal"> Predict</button>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <!-- <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="card-title">Diabetes Prediction</h4>
                            <p class="card-title-desc"><code class="highlighter-rouge">Algorithm Used :</code> Random Forest<br>
                            <code class="highlighter-rouge">Accuracy :</code> 81%
                            </p>
                                <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#diabetes_modal"> Predict</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="card-title">Heart Disease Prediction</h4>
                            <p class="card-title-desc">
                            <code class="highlighter-rouge">Algorithm Used :</code> Random Forest<br>
                            <code class="highlighter-rouge">Accuracy :</code> 81%
                            </p>
                                <button class="btn btn-md btn-primary" id="heart" data-toggle="modal" data-target="#heart_modal"> Predict</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="card-title">Pneumonia Predection</h4>
                            <p class="card-title-desc">
                            <code class="highlighter-rouge">Algorithm Used :</code> CNN<br>
                            <code class="highlighter-rouge">Accuracy :</code> 86%
                            </p>
                                <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#pneumonia_modal"> Predict</button>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>