<?php
include "../class/danhmuccha.php";
$danhmuccha = new danhmuccha;
$delectID=$_GET['delid'];
$XOADM = $danhmuccha ->xoaDMcha($delectID);
?>