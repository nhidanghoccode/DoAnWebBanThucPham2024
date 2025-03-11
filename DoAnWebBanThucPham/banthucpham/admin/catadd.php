<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../class/danhmuccha.php';?>
<?php
$danhmuccha = new danhmuccha;
	if($_SERVER['REQUEST_METHOD'] =='POST'){
		$DMName =$_POST['DMchaName'];
		$themDMcha = $danhmuccha ->themDMcha($DMName);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm phân loại thực phẩm</h2>
                <?php
                    if(isset($themDMcha)){
                        echo $themDMcha;
                    }
                ?>
               <div class="block copyblock"> 
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="DMchaName" placeholder="Thêm phân loại thực phẩm" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Lưu" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>