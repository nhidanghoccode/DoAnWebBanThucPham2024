<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../class/danhmuccon.php'; ?>
<?php
$danhmuccon = new danhmuccon();
$brandID = $_GET['brandd_id'];
$GET_brand = $danhmuccon->hienthiDMchatheocon($brandID);
if ($GET_brand) {
    $HTDMchaTHEOcon = $GET_brand->fetch_assoc();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IDDMcha = $_POST['car-id'];
    $brandName = $_POST['brandName'];
    $suaDMcon = $danhmuccon->suaDMcon($IDDMcha,$brandName, $brandID);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa loại thực phẩm</h2>
        <div class="block copyblock">
            <?php
                    if (isset( $suaDMcon)) {
                        echo   $suaDMcon;
                    }
                    ?>
            <?php
            $get_brandName = $danhmuccon->LayDMcon($brandID);
            if ($get_brandName) {
                while ($result = $get_brandName->fetch_assoc()) {
            ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <select name="car-id" id="" style=" height: 30px;width: 200px; ">
                                        <option value="#">--chọn tên phân loại</option>
                                        <?php
                                        $show_carterory = $danhmuccon->hienthiDMcha();
                                        if ($show_carterory) {
                                            while ($rusult = $show_carterory->fetch_assoc()) {
                                        ?>
                                                <option <?php if ($HTDMchaTHEOcon['PhanLoaiTPID'] == $rusult['PhanLoaiTPID']) {
                                                            echo "SELECTED";
                                                        } ?> value="<?php echo $rusult['PhanLoaiTPID'] ?>"><?php echo $rusult['PhanLoaiTPName'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['DMName'] ?> " name="brandName" placeholder="Sửa thương hiệu sản phẩm" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Sửa" />
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
<?php include 'inc/footer.php'; ?>