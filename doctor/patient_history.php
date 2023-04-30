<?php
include_once('includes/header.php'); 
include_once('includes/sidebar.php'); 
include_once("includes/footer.php"); 
?>
<title>History | Doctor</title>
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
<div id="uploadModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span id="change_title">Upload File</span></h4>
            </div>
            <div class="modal-body">
                <form class="form" id="uploadForm">
                    <input type="file" name="inpFile" id="inpFile"><br>
                    <input class="button btn btn-primary" type="submit" value="Upload">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var pat_id=0;
$(document).ready(function() {
    show_patient_history();

    function show_patient_history() {
        $.ajax({
            type: "POST",
            url: "controller/common_controller.php",
            data: {
                Type: "show_patient_history"
            },
            success: function(result) {
                $(".live-order-list").html(result);
            }
        });
    }

    $(document).on('click','.upload',function(){
        pat_id=$(this).data("id");
        $('#uploadModal').modal('show');
    });
});

const uploadForm=document.getElementById('uploadForm');
const inpFile=document.getElementById('inpFile');
uploadForm.addEventListener("submit",uploadFile);
function uploadFile(e){
    e.preventDefault();
    if(pat_id>0){
        const xhr=new XMLHttpRequest();
        xhr.open("POST","controller/upload.php");
        var data = new FormData(uploadForm);
        data.append("id", pat_id);
        xhr.send(data);
    }
}
</script>