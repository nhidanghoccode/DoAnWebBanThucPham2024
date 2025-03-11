<?php
include "../class/danhmuccon.php";
$danhmuccon = new danhmuccon();
$brandID=$_GET['brandd_id'];
$XOA_brand = $danhmuccon ->XOA_DMcon( $brandID);
?>