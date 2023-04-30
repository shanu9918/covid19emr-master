<?php
include_once('dbconn.php');
$type = $_REQUEST['Type'];
session_start();

if($type == 'register'){
    $password=md5($_REQUEST["password"]);
        $add_category = gosql("INSERT INTO patient_det (pat_id,name,password,email) VALUES ('".$_REQUEST["pat_id"]."','".$_REQUEST["name"]."','".$password."','".$_REQUEST["email"]."')");
}
else if($type=="total_sales"){
    $start_date=$_REQUEST["starting_date"];
    $end_date=$_REQUEST["ending_date"];
    $sel_query=return_single("SELECT sum(price) as price,sum(gst_value) as gst,sum(total_price) as total FROM `orders` WHERE date(createdon) BETWEEN '$start_date' AND '$end_date';");
    if($sel_query["total"]!=0){
    echo($sel_query["total"]);
  }else{
    echo 0;
  }
}
else if($type == 'edit_profile'){
    $update_item = gosql("UPDATE patient_det SET age='".$_REQUEST["age"]."',gender='".$_REQUEST["gender"]."',ph_number='".$_REQUEST["ph_number"]."',height='".$_REQUEST["height"]."',weight='".$_REQUEST["weight"]."' WHERE id='".$_REQUEST["id"]."';");
}
else if($type =='fetch_customer_details')
{
$id = $_REQUEST["user_id"];
$fetch_customer = return_single("SELECT * from `patient_det` where id = '".$id."'");
echo json_encode($fetch_customer);
}
else if($type=='show_patient_list'){
    $pat_id=$_REQUEST["id"];
    ?>
    <table id="datatable" class="table table-bordered dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th align="center">Patient ID</th>
            <th align="center">Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
                $count=1;
                $sel_query="SELECT pat_id,book_time FROM `appointment` WHERE pat_id='".$pat_id."' AND appointment.book_time>NOW() AND appointment.status=1 ORDER BY appointment.book_time ASC";
                $result = return_array($sel_query);
                foreach($result as $row) {  
                    ?>
        <tr class="count_row">
            <td align="center"><?php echo $row["pat_id"]; ?></td>
            <td align="center"><?php $del_date=date_create($row["book_time"]); echo(date_format($del_date,"d/m/Y :: h:m:s")); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<script src="../assets/js/pages/datatables.init.js"></script>
<?php
}
else if($type=='show_patient_history'){
    $pat_id=$_REQUEST["pat_id"];?>
    <table id="datatable" class="table table-bordered dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>Patient ID</th>
            <th>Patient Name</th>
            <th>Time</th>
            <th>Prescription</th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sel_query="SELECT appointment.id,appointment.folder_name,appointment.file_name,appointment.upload_status,patient_det.pat_id,patient_det.name AS name,appointment.book_time AS date_time FROM `appointment`,`patient_det` WHERE patient_det.pat_id=appointment.pat_id AND book_time < NOw() AND appointment.pat_id='".$pat_id."' ORDER BY appointment.book_time DESC";
                $result = return_array($sel_query);
                foreach($result as $row) {?>
        <tr class="count_row">
            <td align="center"><?php echo $row["pat_id"]; ?></td>
            <td align="center"><?php echo ucfirst($row["name"]); ?></td>
            <td align="center"><?php
                $del_date=date_create($row["date_time"]);
                echo(date_format($del_date,"d/m/Y :: h:m:s")); ?>
            </td>
            <?php $filepath='../doctor/controller/'.$row["folder_name"].'/'.$row["file_name"];
            if($row["upload_status"]=="1"){
            ?>
            <td><a href=<?php echo $filepath?> class="btn btn-primary" target="_blank">View</a></td>
            <?php }else{ ?>
            <td><button class="btn btn-primary" style="cursor: context-menu;" disabled>View</button></td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>
<script src="../assets/js/pages/datatables.init.js"></script>
<?php
}
else if($type=='patient_req_entry'){
    $pat_id=$_REQUEST["id"];
    $insert_entry = gosql("INSERT INTO appointment (pat_id,book_time) VALUES ('".$pat_id."','".$_REQUEST["book_date"]."')");
    echo $pat_id;
}
else if($type=='show_patient_appoint_list'){
    $pat_id=$_REQUEST["id"];
    $status_common = array("0"=>"Pending","1"=>"Accepted","2"=>"Rejected");
    ?>
    <table id="datatable" class="table table-bordered dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>Patient ID</th>
            <th>Time</th>
            <th>Appointment Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
                $count=1;
                $sel_query="SELECT * FROM `appointment` WHERE pat_id='".$pat_id."' ORDER BY appointment.book_time DESC";
                $result = return_array($sel_query);
                foreach($result as $row) {  
                    if($row['status']==0){
                        $status_color='#ffc107';
                    }else if($row['status']==1){
                        $status_color='#0EB03E';
                  }else if($row['status']==2){
                        $status_color='#F7344C';
                  }
                    ?>
        <tr class="count_row">
            <td align="center"><?php echo $row["pat_id"]; ?></td>
            <td align="center"><?php $del_date=date_create($row["book_time"]); echo(date_format($del_date,"d/m/Y :: h:m:s")); ?></td>
            <td align="center"><a style="background:<?php echo $status_color;?>;" class="success btn text-white change_status"><?php echo $status_common[$row["status"]];?></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<script src="../assets/js/pages/datatables.init.js"></script>
<?php
}
else if($type == 'login'){
    $username = $_REQUEST['email'];
    $password = md5($_REQUEST['password']);
    $check_cnt = return_single("SELECT COUNT(1) as cid FROM patient_det WHERE email = '".$username."'");
    if($check_cnt['cid'] > 0){
        $sfqry = "SELECT * FROM patient_det WHERE email='".$username."' and password='".$password."'";
        $row1 = return_single($sfqry);
        if($row1)
        {
            $_SESSION["pat"]["Id"] = $row1["id"];
            $_SESSION["pat"]["pat_id"] = $row1["pat_id"];
            $_SESSION["pat"]["name"] = $row1["name"];
            $_SESSION["pat"]["email"] = $row1["email"];
            $_SESSION["pat"]["logged_in"] = true;
            $_SESSION["pat"]["efficient_data"]=0;
            if($row1["age"]!='0' && $row1["gender"]!='0' && $row1["ph_number"]!='0' && $row1["height"]!='0' && $row1["weight"]!='0'){
                $_SESSION["pat"]["efficient_data"]=1;
            }
            echo 1;
        }
        else
        {
            $message = "Invalid Username or Password!";
            echo ($message);
        }
    }
    
    else{
        echo 404;
    }
}
else{
echo 0;
}

?>