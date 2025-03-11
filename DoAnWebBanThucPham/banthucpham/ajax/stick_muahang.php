<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php 
    $db= new Database();
    $ghID=$_POST['ghID'];
    $TrangThai =$_POST['TrangThai'];
    $query =" UPDATE da_giohang SET TrangThai='$TrangThai' WHERE ghID='$ghID'";
    $result =$db->update($query);
    if($result){
        echo 'Cập nhật thành công';
       
    }else{
        echo 'đã sảy ra lỗi cập nhật không thành công';

    }
    
?>