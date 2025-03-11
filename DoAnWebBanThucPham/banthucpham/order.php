
<?php
include("./incc/hearder.php");
?>
<?php
	$login_check = Session::get('curtomer_login');
	if($login_check==false){
		header('Location:login.php');
	}
?>
    <h2 style="margin-top: 100px;">Đăng nhập thành công</h2>
    <?php
include('./incc/chantrang.php');
?>