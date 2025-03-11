<!-- xử lý phần chọn danh mục bất kì thì phần loại danh mục sẽ hiển thị
tương ứng, không bị load lại nguyên trang mà chỉ load cái phần đó thôi -->
<?php
include '../class/thucpham.php';

$thucpham = new thucpham;
$cargoryID = $_GET['danhmuccha'];

$show_product_brand_ajax = $thucpham->hienthiloaiDMcha_ajax($cargoryID);
if ($show_product_brand_ajax) {
    while ($rusult = $show_product_brand_ajax->fetch_assoc()) {
?>
        <option <?php
                ?> value="<?php echo $rusult['DMID'] ?>"><?php echo $rusult['DMName'] ?></option>
<?php
    }
}
?>