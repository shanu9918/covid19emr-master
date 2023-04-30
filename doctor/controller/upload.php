<?php
include_once('dbconn.php');
$n=10;
function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}
$rand=getName($n);
mkdir("$rand"); 
$targetPath="$rand/".basename($_FILES["inpFile"]["name"]);
move_uploaded_file($_FILES["inpFile"]["tmp_name"],$targetPath);
$id=$_REQUEST["id"];
$folder_name=$rand;
$file_name=$_FILES["inpFile"]["name"];
$add_category = gosql("UPDATE appointment SET upload_status=1,folder_name='".$folder_name."',file_name='".$file_name."' WHERE id='".$id."';");
exit;
?>