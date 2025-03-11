<?php
include '../class/thucpham.php';
    $thucpham = new thucpham();
    $delectID=$_GET['delid'];
    $XOATH = $thucpham ->xoaSP($delectID);
?>