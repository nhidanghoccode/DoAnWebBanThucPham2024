<?php
include './incc/hearder.php';
include './incc/sileder.php';
// include 'helpers/format.php';
$fm = new Format;
?>
<script src="js/main.js"></script>
<!-- CÁC SẢN PHẨM-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h2>Sản phẩm chất lượng</h2>
                    <h2>Hãy khám phá ngay!</h2>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                    <li class="nav-item">
                            <a class="d-flex m-2 py-1 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                <span class="text-dark" style="width: 600px;">Tất cả</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                <span class="text-dark" style="width: 300px;">Rau xanh</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                <span class="text-dark" style="width: 300px;">trái cây</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                <span class="text-dark" style="width: 300px;">Thịt</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-5">
                                <span class="text-dark" style="width: 300px;">Tươi sống/ Hải sản</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">

                                <?php
                                $thucpham = new thucpham;
                                $hienthitatcaTP = $thucpham->hienthitatcaThucpham();
                                if ($hienthitatcaTP) {
                                    while ($result = $hienthitatcaTP->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item" style="border: 1px sold #333;">
                                                <div class="fruite-img">
                                                    <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class=" w-100 rounded-top" alt="<?php echo $result['ChiTietName'] ?>" style="height:200px;">
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4 style="height: 70px;"><?php echo $result['ChiTietName'] ?></h4>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $result['ChiTietGia'] ?><?php if ($result['donvitinh'] == 1) {
                                                                                                                                        echo '/bó';
                                                                                                                                    } else if ($result['donvitinh'] == 2) {
                                                                                                                                        echo '/kí';
                                                                                                                                    } else {
                                                                                                                                        echo '';
                                                                                                                                    } ?><sup>đ</sup></p>
                                                        <a href="shop-detail.php?chitietid=<?php echo $result['ChiTietID'] ?>" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i> Xem chi tiết
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
                <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                $thucpham = new thucpham;
$hienthitatcaTP = $thucpham->hienthiDMrau();
                                if ($hienthitatcaTP) {
                                    while ($result = $hienthitatcaTP->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class="img-fluid w-100 rounded-top" alt="" style="height:200px;">
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4 style="height:70px"><?php echo $result['ChiTietName'] ?></h4>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $result['ChiTietGia'] ?><?php if ($result['donvitinh'] == 1) {
                                                                                                                                        echo '/bó';
                                                                                                                                    } else if ($result['donvitinh'] == 2) {
                                                                                                                                        echo '/kí';
                                                                                                                                    } else {
                                                                                                                                        echo '';
                                                                                                                                    } ?><sup>đ</sup></p>
                                                        <a href="shop-detail.php?chitietid=<?php echo $result['ChiTietID'] ?>" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i> Xem chi tiết
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
<div id="tab-3" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                $thucpham = new thucpham;
                                $hienthitatcaTP = $thucpham->hienthiDMtraicay();
                                if ($hienthitatcaTP) {
                                    while ($result = $hienthitatcaTP->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class=" w-100 rounded-top" alt="<?php echo $result['ChiTietName'] ?>" style="height: 200px;">
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4 style="height: 70px;"><?php echo $result['ChiTietName'] ?></h4>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $result['ChiTietGia'] ?><?php if ($result['donvitinh'] == 1) {
                                                                                                                                        echo '/bó';
                                                                                                                                    } else if ($result['donvitinh'] == 2) {
                                                                                                                                        echo '/kí';
                                                                                                                                    } else {
                                                                                                                                        echo '';
                                                                                                                                    } ?><sup>đ</sup></p>
                                                        <a href="shop-detail.php?chitietid=<?php echo $result['ChiTietID'] ?>" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i> Xem chi tiết
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
                <div id="tab-4" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                $thucpham = new thucpham;
                                $hienthitatcaTP = $thucpham->hienthiDMthit();
                                if ($hienthitatcaTP) {
                                    while ($result = $hienthitatcaTP->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class="img-fluid w-100 rounded-top" alt="<?php echo $result['ChiTietName'] ?>" style="height:200px;">
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4 style="height: 70px;"><?php echo $result['ChiTietName'] ?></h4>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $result['ChiTietGia'] ?><?php if ($result['donvitinh'] == 1) {
                                                                                                                                        echo '/bó';
                                                                                                                                    } else if ($result['donvitinh'] == 2) {
                                                                                                                                        echo '/kí';
                                                                                                                                    } else {
                                                                                                                                        echo '';
                                                                                                                                    } ?><sup>đ</sup></p>
<a href="shop-detail.php?chitietid=<?php echo $result['ChiTietID'] ?>" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i> Xem chi tiết
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
                <div id="tab-5" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                $thucpham = new thucpham;
                                $hienthitatcaTP = $thucpham->hienthiDMca();
                                if ($hienthitatcaTP) {
                                    while ($result = $hienthitatcaTP->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class="img-fluid w-100 rounded-top" alt="<?php echo $result['ChiTietName'] ?>" style="height:200px;">
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4 style="height: 70px;"><?php echo $result['ChiTietName'] ?></h4>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $result['ChiTietGia'] ?><?php if ($result['donvitinh'] == 1) {
                                                                                                                                        echo '/bó';
                                                                                                                                    } else if ($result['donvitinh'] == 2) {
                                                                                                                                        echo '/kí';
                                                                                                                                    } else {
echo '';
                                                                                                                                    } ?><sup>đ</sup></p>
                                                        <a href="shop-detail.php?chitietid=<?php echo $result['ChiTietID'] ?>" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i> Xem chi tiết
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
                <!-- <div id="tab-5" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="img/fruite-item-3.jpg" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>Banana</h4>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                <a href="#" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i> Thêm vào giỏ
                                                    hàng
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="img/fruite-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
<h4>Raspberries</h4>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                <a href="" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i> Thêm vào giỏ
                                                    hàng
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="img/fruite-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>Oranges</h4>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                <a href="#" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i> Thêm vào giỏ
                                                    hàng
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- KẾT THÚC CÁC SẢN PHẨM-->


<!-- Featurs Start -->
<!-- <div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <a href="#">
                    <div class="service-item bg-secondary rounded border border-secondary">
                        <img src="img/featur-1.jpg" class="img-fluid rounded-top w-100" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-primary text-center p-4 rounded">
                                <h5 class="text-white">Táo tươi</h5>
                                <h3 class="mb-0">Giảm 20% </h3>
                            </div>
                        </div>
</div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="#">
                    <div class="service-item bg-dark rounded border border-dark">
                        <img src="img/featur-2.jpg" class="img-fluid rounded-top w-100" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-light text-center p-4 rounded">
                                <h5 class="text-primary">
                                    trái cây </h5>
                                <h3 class="mb-0">Giao hàng miễn phí</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="#">
                    <div class="service-item bg-primary rounded border border-primary">
                        <img src="img/featur-3.jpg" class="img-fluid rounded-top w-100" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-secondary text-center p-4 rounded">
                                <h5 class="text-white">Rau xanh</h5>
                                <h3 class="mb-0">Giảm 5.000 <sup></sup></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div> -->
<!-- Featurs End -->


<!-- Vesitable Shop Start-->
<!-- <div class="container-fluid vesitable py-5">
    <div class="container py-5">
        <h1 class="mb-0">Rau hữu cơ </h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">
            <?php
            $htrauhcc = $thucpham->htTprauhuuco();
            if ($htrauhcc) {
                while ($result = $htrauhcc->fetch_assoc()) {
            ?>
                    <div class="border border-primary rounded position-relative vesitable-item ">
                        <div class="vesitable-img max-vh-100">
                            <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 rounded-bottom">
                            <h4><?php echo $result['ChiTietName'] ?></h4>
                            <p><?php
                                echo $fm->textShorten($result['mota'], 100) ?></p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0"><?php echo $result['ChiTietGia'] . ' ' . 'đ' ?></p>
                                <a href="shop-detail.php?chitietid=<?php echo $result['ChiTietID'] ?>" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i>Xem chi tiết
</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div> -->
<!-- Vesitable Shop End -->

<!-- Sản phẩm bán chạy nhất -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h1 class="display-4">Sản phẩm mới nhất</h1>
            <p>Đây là các sản phẩm mới được nhập hàng về của chúng tôi</p>
        </div>
        <div class="row g-4">
            <?php
            $thucpham = new thucpham;
            $hienthibanchay = $thucpham->httpmoinhat();
            if ($hienthibanchay) {
                while ($result = $hienthibanchay->fetch_assoc()) {
            ?>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-6">
                                    <a href="#" class="h5"><?php echo $result['ChiTietName'] ?></a>

                                    <h4 class="mb-3"><?php echo $result['ChiTietGia'] . ' ' . 'đ' ?><?php if ($result['donvitinh'] == 1) {
                                                                                                                                        echo '/bó';
                                                                                                                                    } else if ($result['donvitinh'] == 2) {
                                                                                                                                        echo '/kí';
                                                                                                                                    } else {
                                                                                                                                        echo '';
                                                                                                                                    } ?></h4>
                                    <a href="shop-detail.php?chitietid=<?php echo $result['ChiTietID'] ?>" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i>Xem chi tiết
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
<div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h1 class="display-4">Sản phẩm nổi bậc</h1>
            <p>Đây là các sản phẩm nổi bậc của chúng tôi</p>
        </div>
        <div class="row g-4">
            <?php
$thucpham = new thucpham;
            $hienthimoinhat = $thucpham->httpbanchay();
            if ($hienthimoinhat) {
                while ($result = $hienthimoinhat->fetch_assoc()) {
            ?>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="text-center">
                            <img src="admin/upload/<?php echo $result['ChiTietImg'] ?>" class="img-fluid rounded" alt="" style="height:200px" >
                            <div class="py-4">
                                <a href="#" class="h5"><?php echo $result['ChiTietName'] ?></a>

                                <h4 class="mb-3"><?php echo $result['ChiTietGia'] . ' ' . 'đ' ?><?php if ($result['donvitinh'] == 1) {
                                                                                                                                        echo '/bó';
                                                                                                                                    } else if ($result['donvitinh'] == 2) {
                                                                                                                                        echo '/kí';
                                                                                                                                    } else {
                                                                                                                                        echo '';
                                                                                                                                    } ?></h4>
                                <a href="shop-detail.php?chitietid=<?php echo $result['ChiTietID'] ?>" class="btn border border-white rounded-pill px-3 text-white bg-primary w-100 "><i class="fa fa-shopping-bag me-2 text-white"></i>Xem chi tiết
                                </a>
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
<!--Sản phẩm bán chạy nhất -->
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