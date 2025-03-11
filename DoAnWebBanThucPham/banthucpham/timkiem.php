<?php
include './incc/hearder.php';
include './class/thucpham.php';
?>

<!-- Single Product Start -->

<?php
$thucpham = new thucpham;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_product'])) {
    $tukhoa = $_POST['tukhoa'];
    $searche_product = $thucpham->search($tukhoa);
}
?>
<div class="container-fluid py-5" style="margin-top: 123px;">
    <h2>Từ khóa tìm kiếm:</h2>
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="row g-4">
                <?php
                if ($searche_product) {
                    while ($resul = $searche_product->fetch_assoc()) {
                ?>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item" style="border: 1px sold #333;">
                                <div class="fruite-img">
                                    <img src="admin/upload/<?php echo $resul['ChiTietImg'] ?>" class="img-fluid w-100 rounded-top" alt="" style="max-height:250px;">
                                </div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4><?php echo $resul['ChiTietName'] ?></h4>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $resul['ChiTietGia'] ?><?php if ($resul['donvitinh'] == 1) {                                                                          } ?><sup>đ</sup></p>
                                        <a href="shop-detail.php?chitietid=<?php echo $resul['ChiTietID'] ?>" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i> Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php

                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php
include('./incc/chantrang.php');
?>