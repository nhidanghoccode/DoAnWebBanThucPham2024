<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../class/danhmuccon.php'; ?>
<?php
$danhmuccon = new danhmuccon;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IDDM = $_POST['car-id'];
    $brandName = $_POST['brandName'];

    $themDMcon = $danhmuccon->themDMcon($IDDM, $brandName);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm loại thực phẩm</h2>
        <?php
        if (isset($themDMcon)) {
            echo $themDMcon;
        }
        ?>
        <div class="block copyblock">
            <form action="brandadd.php" method="post">
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
                                        <option value="<?php echo $rusult['PhanLoaiTPID'] ?>"><?php echo $rusult['PhanLoaiTPName'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="brandName" placeholder="Thêm loại thực phẩm.." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>