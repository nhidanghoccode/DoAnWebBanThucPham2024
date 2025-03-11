<!-- xử lý phần chọn danh mục bất kì thì phần loại danh mục sẽ hiển thị
tương ứng, không bị load lại nguyên trang mà chỉ load cái phần đó thôi -->
<?php
include "./class/login_class.php";
$login = new login_class;
$tinhID=$_GET['tinh'];

$show_product_brand_ajax = $login->hienthiloaiDM_ajax($tinhID);
if ($show_product_brand_ajax) {
    while ($rusult = $show_product_brand_ajax->fetch_assoc()) {
?>
    <option value="<?php echo $rusult['huyenID'] ?>"><?php echo $rusult['TenHuyen'] ?></option>
<?php
    }
}
?>