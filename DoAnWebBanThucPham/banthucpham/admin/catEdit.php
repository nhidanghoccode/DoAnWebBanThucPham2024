<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../class/danhmuccha.php';?>
<?php
$danhmuccha = new danhmuccha;

$DMID=$_GET['phanloaitpid'];
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $DMName =$_POST['phanloaitpname'];
            // $catID=$_GET['catid'];
            $suaDM = $danhmuccha ->suaDMcha($DMName,$DMID) ;
        }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa phân loại thực phẩm</h2>
               <div class="block copyblock"> 
               <?php
                    if(isset($suaDM)){
                        echo $suaDM;
                    }
                ?>
                <?php
                    $get_catName=$danhmuccha->LayDMcha($DMID);
                    if($get_catName){
                        while($result=$get_catName->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['PhanLoaiTPName']?> "name="phanloaitpname" placeholder="Sửa danh mục sản phẩm" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Cập nhật" />
                            </td>
                        </tr>
                    </table>
                    </form> 
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>