<?php
include './incc/hearder.php';
include './class/thucpham.php';
?>
<?php
// if (!isset($_GET['chitietid']) || $_GET['chitietid'] == NULL) {
// 	echo "<script>window.location = '404.php'</script>";
// } else {
$id = $_GET['chitietid'];
// }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $sl = $_POST['quantity_sl'];
    $quantity_stock = $_POST['quantity_stock'];
    $themgiohang = $gh->themgiohang($sl, $quantity_stock, $id);
}
?>
<script src="js/main.js"></script>
<!-- Single Product Start -->
<div class="container-fluid py-5" style="margin-top: 100px;">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
            <?php
    $thucpham = new thucpham;
    $get_productdetails = $thucpham->chitiet1thucpham($id);
    if ($get_productdetails) {
        while ($result = $get_productdetails->fetch_assoc()) {
?>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="border rounded">
                        <a href="s">
                            <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class="img-fluid rounded" alt="Image">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 class="fw-bold mb-3">
                        <?php echo $result['ChiTietName'] ?></h4>
                    <p class="mb-3">
                        Danh mục: <?php echo $result['PhanLoaiTPName'] ?></p>
                    <h5 class="fw-bold mb-3"><?php echo number_format($result['ChiTietGia'], 0, ',', '.') . ' đ' ?>
                        <?php if ($result['donvitinh'] == 1) {
                            echo '/bó';
                        } else if ($result['donvitinh'] == 2) {
                            echo '/kí';
                        } ?>
                    </h5>
                    
                    <?php if (!empty($result['gia_tri_khuyenmai'])) { ?>
                        <p class="text-danger">Khuyến mãi: Giảm <?php echo $result['gia_tri_khuyenmai']; ?>%</p>
                        <p class="text-success">Giá sau khuyến mãi: 
                            <?php 
                            $giaSauKhuyenMai = $result['ChiTietGia'] * (1 - $result['gia_tri_khuyenmai'] / 100);
                            echo number_format($giaSauKhuyenMai, 0, ',', '.') . ' đ';
                            ?>
                        </p>
                    <?php } ?>
                    
                    <p class="mb-4"><?php echo $result['mota'] ?></p>
                    <p class="mb-4">Tồn kho: <?php echo $result['productSL'] ?> <?php if ($result['donvitinh'] == 1) {
                                                                                        echo '/bó';
                                                                                    } else if ($result['donvitinh'] == 2) {
                                                                                        echo '/kí';
                                                                                    } else {
                                                                                        echo '';
                                                                                    } ?></p>
                    <form action="" method="post">
                        <input type="hidden" class="buyfield" name="quantity_stock" value="<?php echo $result['productSL'] ?>" />
                        Số lượng: <input type="text" class="text-center" name="quantity_sl" pattern="[0-9]+(\.[0-9]+)?" title="Vui lòng nhập số thực, ví dụ: 1.2" /><br>
                        <?php
                        if ($result['productSL'] > 0) {
                        ?>
                            <input type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 mt-3 text-white bg-primary" name="submit" value="Thêm giỏ hàng" />
                        <?php
                        }
                        ?>
                    </form>

                    <?php
                    if (isset($themgiohang)) {
                        echo $themgiohang;
                    }
                    ?>
                </div>
                
                <div class="col-lg-12">
                    <nav>
                        <div class="nav nav-tabs mb-3">
                            <button class="nav-link active border-white border-bottom-0" type="button" role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about" aria-selected="true">Miêu tả</button>
                        </div>
                    </nav>
                    <div class="tab-content mb-5">
                        <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                            <p><?php echo $result['mota'] ?></p>
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                        <div class="col-6">
                                            <p class="mb-0">
                                                Loại thực phẩm</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0"><?php echo $result['PhanLoaiTPName'] ?></p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($id) {
                    $thongTinDanhGia = $thucpham->layThongTinDanhGia($id);
                    if ($thongTinDanhGia) {
                        $tongDanhGia = $thongTinDanhGia['tongDanhGia'];
                        $diemTrungBinh = round($thongTinDanhGia['diemTrungBinh'], 1);
                        echo "<h5>Tổng số đánh giá: $tongDanhGia</h5>";
                        echo "<h5>Điểm trung bình: $diemTrungBinh / 5</h5>";
                    } else {
                        echo "<h5>Chưa có đánh giá nào</h5>";
                    }
                } else {
                    echo "<h5>Sản phẩm không xác định</h5>";
                }
                
                ?>

                <div class="mt-5">
                    <h4 class="fw-bold">Đánh giá từ khách hàng</h4>
                    <?php
                    $get_reviews = $thucpham->layDanhGia($id); // Lấy danh sách đánh giá từ cơ sở dữ liệu
                    if ($get_reviews) {
                        while ($review = $get_reviews->fetch_assoc()) {
                    ?>
                            <div class="border rounded p-3 mb-3">
                                <p><strong>Người dùng:</strong> <?php echo $review['cusName']; ?></p>
                                <p><strong>Đánh giá:</strong> <?php echo str_repeat('⭐', $review['rating']); ?> (<?php echo $review['rating']; ?>/5)</p>
                                <p><strong>Nhận xét:</strong> <?php echo $review['review']; ?></p>
                                <p><small><em>Ngày đánh giá: <?php echo $review['ngaydanhgia']; ?></em></small></p>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="text-muted">Chưa có đánh giá nào cho sản phẩm này.</p>';
                    }
                    ?>
                </div>
            </div>
<?php
        }
    }
?>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <h4 class="mb-4">
                            Sản phẩm nổi bật</h4>

                        <?php
                        $thucpham = new thucpham;
                        $noibac = $thucpham->ctspnoibat();
                        if ($noibac) {
                            while ($result = $noibac->fetch_assoc()) {

                        ?>
                                <a href="shop-detail.php?chitietid=<?php echo $result['ChiTietID'] ?>">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded" style="width: 100px; height: 100px;">
                                            <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class="img-fluid rounded" alt="Image">
                                        </div>
                                        <div>
                                            <h6 class="mb-2"><?php echo $result['ChiTietName'] ?></h6>

                                            <div class="d-flex mb-2">
                                                <h5 class="fw-bold me-2"><?php echo $result['ChiTietGia'] . ' ' . 'đ' ?><?php if ($result['donvitinh'] == 1) {
                                                                                                                            echo '/bó';
                                                                                                                        } else if ($result['donvitinh'] == 2) {
                                                                                                                            echo '/kí';
                                                                                                                        } else {
                                                                                                                            echo '';
                                                                                                                        } ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        <?php
                            }
                        }
                        ?>

                        <div class="d-flex justify-content-center my-4">
                            <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Xem Thêm</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="position-relative">
                            <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <h1 class="fw-bold mb-0">Những sảm phẩm tương tự</h1>
        <div class="vesitable">
            <div class="owl-carousel vegetable-carousel justify-content-center">

                <?php
                $thucpham = new thucpham;
                $fm = new Format;
                $get_sptuongtu = $thucpham->ctsptuongtu($id);
                if ($get_sptuongtu) {
                    while ($result = $get_sptuongtu->fetch_assoc()) {
                ?>
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4><?php echo $result['ChiTietName'] ?></h4>
                                <p><?php echo $fm->textShorten($result['mota'], 80) ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold"><?php echo $result['ChiTietGia'] . ' ' . 'đ' ?><?php if ($result['donvitinh'] == 1) {
                                                                                                                            echo '/bó';
                                                                                                                        } else if ($result['donvitinh'] == 2) {
                                                                                                                            echo '/kí';
                                                                                                                        } else {
                                                                                                                            echo '';
                                                                                                                        } ?></p>
                                    <a href="shop-detail.php?chitietid=<?php echo $result['ChiTietID'] ?>" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div> -->
    </div>
</div>
</div>
<!-- Single Product End -->
<script>
    // Băng chuyền của Rau
    $(".vegetable-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });
</script>
<?php
include('./incc/chantrang.php');
?>