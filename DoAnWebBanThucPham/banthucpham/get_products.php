<?php
include './class/thucpham.php';
$thucpham = new thucpham;$fm= new Format;
    $selectedValue =$_POST['selectedValue'];

    $hiethi = $thucpham->Ajax_PLTP($selectedValue);
    // Kiểm tra và hiển thị danh sách sản phẩm
    if($hiethi){
        while ($row = $hiethi->fetch_assoc()){
?>
            <div class="col-md-6 col-lg-6 col-xl-4 item">
                <div class="rounded position-relative fruite-item">
                    <div class="fruite-img">
                        <img src="admin/upload/<?php echo $row['ChiTietImg']?>" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                        <h4><?php echo $row['ChiTietName']?></h4>
                        <p><?php echo $fm->textShorten($row['mota'], 50) ?></p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $row['ChiTietGia'] . ' ' . 'đ' ?><?php if ($row['donvitinh'] == 1) {
                                                                                                                                            echo '/bó';
                                                                                                                                        } else if ($row['donvitinh'] == 2) {
                                                                                                                                            echo '/kí';
                                                                                                                                        } else {
                                                                                                                                            echo '';
                                                                                                                                        } ?></p>
                                                    <a href="shop-detail.php?chitietid=<?php echo $row['ChiTietID'] ?>" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
?>