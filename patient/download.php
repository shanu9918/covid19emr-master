<?php
include_once('controller/dbconn.php');
if(isset($_REQUEST["pat_id"])){
    $id=$_REQUEST["pat_id"];
    $sql=return_single("SELECT * FROM appointment where id='".$id."'");
    $filepath='../doctor/controller/'.$sql["folder_name"].'/'.$sql["file_name"];
    // if(file_exists($filepath)){
    //     header('Content-Type: application/octet-stream');
    //     header('Content-Description:File Transfer');
    //     header('Content-Disposition:attachment;filename='.basename($filepath));
    //     header('Expires:0');
    //     header('Cache-Control:must-revalidate');
    //     header('Pragma:public');
    //     header('Content-Length'.filesize($filepath));
    //     readfile($filepath);
    //     exit;
    // }
    if(file_exists($filepath)){
                header("Cache-Control: public");
                header("Content-Description: FIle Transfer");
                header("Content-Disposition: attachment; filename=".basename($filepath));
                header("Content-Type: application/octet-stream");
                header("Content-Transfer-Emcoding: binary");
        
                readfile($filepath);
                exit;
        
            }
            else{
                echo "This File Does not exist.";
            }
}
?>