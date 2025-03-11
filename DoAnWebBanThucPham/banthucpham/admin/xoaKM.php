<?php
include "../class/khuyenmai.php";
$KM = new khuyenmai();
$id=$_GET['id'];
$xoakm = $KM ->xoaKM($id);
?>