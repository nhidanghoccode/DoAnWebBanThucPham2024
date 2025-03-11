<?php
include 'inc/header.php';
include 'inc/sidebar.php';
// include '../class/brand.php';
include '../class/danhmuccha.php';
include '../class/danhmuccon.php';
include '../class/thucpham.php';
?>
<?php
$thucpham = new thucpham;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $themSP = $thucpham->themthucpham($_POST, $_FILES);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <?php
        if (isset($themSP)) {
            echo $themSP;
        }
        ?>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Tên Thực phẩm</label>
                        </td>
                        <td>
                            <input type="text" name="ChiTietName" placeholder="Nhập tên thực phẩm..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Số lượng:</label>
                        </td>
                        <td>
                            <input type="text" name="productSL" placeholder="Nhập sl thực phẩm..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Phân loại</label>
                        </td>
                        <td>
                            <select id="danhmuccha" name="danhmuccha">
                                <option value="#">--Chọn phân loại</option>
                                <?php
                                $show_product_cargory = $thucpham->hienthiDMcha();
                                if ($show_product_cargory) {
                                    while ($rusult = $show_product_cargory->fetch_assoc()) {
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
                            <label>Loại thực phẩm</label>
                        </td>
                        <td>
                            <select id="danhmuccon" name="danhmuccon">
                                <option value="#">--chọn loại thực phẩm</option>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Mô tả</label>
                        </td>
                        <td>
                            <textarea name="mota" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Giá thực phẩm</label>
                        </td>
                        <td>
                            <input name="ChiTietGia" type="text" placeholder="Nhập giá..." class="medium" />
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label>Đơn vị tính</label>
                        </td>
                        <td>
                            <select id="donvitinh" name="donvitinh">
                                <option value="1">Bó</option>
                                <option value="2">kg</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Ảnh thực phẩm</label>
                        </td>
                        <td>
                            <input name="ChiTietImg" type="file" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Loại thực phẩm</label>
                        </td>
                        <td>
                            <select name="type" id="select">
                                <option>Lựa chọn đối tượng</option>
                                <option value="1">nổi bậc</option>
                                <option value="2">Không nổi bật</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<script>
    $(document).ready(function() {
        $('#danhmuccha').change(function() {
            //sự kiện change để lấy ra giá trj bên tron của select mỗi lần người dùng thay đổi
            // alert($(this).val());
            var x = $(this).val();
            $.get("./productadd_Ajax.php", {
                danhmuccha: x
            }, function(data) {
                $("#danhmuccon").html(data);
            })
            // $.get("../product_ajax/productAdd_Ajax.php",{danhmuccha:x},function(data){
            //     $("#product_brand_id").html(data);
            // }) lấy kết quả bên ../product_ajax/productAdd_Ajax.php về và gán nó vô cái select id="product_brand_id">
        })
    })
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>