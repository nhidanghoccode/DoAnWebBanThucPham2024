<?php
include './incc/hearder.php';
include './incc/sileder.php';
include './class/thucpham.php';
?>
<?php

?>
<!-- Single Page Header End -->
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Cửa hàng thực phẩm</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>
                                        Thêm vào</h4>
                                    <?php
                                    $danhmuccha = new danhmuccha;
                                    $htdmc = $danhmuccha->hienthiDMcha();
                                    if ($htdmc) {
                                        while ($result = $htdmc->fetch_assoc()) {
                                    ?>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2" id="Categories-<?php echo $result['PhanLoaiTPID'] ?>" name="categories" value="<?php echo $result['PhanLoaiTPID'] ?> " checked>
                                                <label for="Categories-<?php echo $result['PhanLoaiTPID'] ?>"><?php echo $result['PhanLoaiTPName'] ?></label>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h4 class="mb-3">Sản phẩm nổi bật</h4>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 200px;">
                                        <img src="img/featur-1.jpg" class="img-fluid rounded" alt="" style="height: 200px;">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Táo đỏ</h6>

                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">150000</h5>
                                            <h5 class="text-danger text-decoration-line-through">170000</h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="img/featur-2.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Cà chua</h6>

                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="img/featur-3.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Dâu tây</h6>

                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="d-flex justify-content-center my-4">
                                    <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Xem thêm</a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="" style="height: 200px;">
                                    <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <h3 class="text-secondary fw-bold">Fresh <br>
                                            trái cây <br> Banner</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div id="sanpham" class="pav row g-4 justify-content-center">
                        <?php
    $thucpham = new thucpham;
    $fm = new Format;
    $hienthi = $thucpham->hienthi();

    // Kiểm tra và hiển thị danh sách sản phẩm
    if ($hienthi) {
        while ($row = $hienthi->fetch_assoc()) {
            // Kiểm tra và tính giá hiển thị (giá gốc hoặc giá khuyến mãi nếu có)
            $giaHienThi = isset($row['GiaKhuyenMai']) && $row['GiaKhuyenMai'] < $row['ChiTietGia'] ? $row['GiaKhuyenMai'] : $row['ChiTietGia'];

            // Nếu có khuyến mãi, tính giá sau khuyến mãi
            if (isset($row['GiaKhuyenMai']) && $row['GiaKhuyenMai'] < $row['ChiTietGia']) {
                $giaSauKhuyenMai = $row['ChiTietGia'] * (1 - $row['GiaKhuyenMai'] / 100);
            } else {
                $giaSauKhuyenMai = $row['ChiTietGia'];
            }
            
            // Mô tả rút gọn
            $motaRutGon = $fm->textShorten($row['mota'], 100);
?>
        <div class="col-md-6 col-lg-6 col-xl-4 item" style="height: 500px;">
            <div class="rounded position-relative fruite-item" style="height: 450px;">
                <!-- Hiển thị nhãn "Khuyến mãi" nếu có -->
                <?php if (isset($row['GiaKhuyenMai']) && $row['GiaKhuyenMai'] < $row['ChiTietGia']) { ?>
                    <span class="badge bg-success text-white position-absolute" style="top: 10px; right: 10px;">Khuyến mãi</span>
                <?php } ?>

                <div class="fruite-img" style="height: 200px;">
                    <img src="admin/upload/<?php echo $row['ChiTietImg']; ?>" 
                        class="img-fluid w-100 rounded-top" 
                        alt="<?php echo ($row['ChiTietName']); ?>" 
                        style="height: 200px;">
                </div>
                
                <!-- Chứa phần mô tả và giá, phần này sẽ chiếm không gian còn lại -->
                <div class="p-4 border border-secondary border-top-0 rounded-bottom" style="height:250px;">
                    <h4><?php echo ($row['ChiTietName']); ?></h4>
                    <?php echo ($motaRutGon); ?>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <!-- Giá và đơn vị tính trên cùng một dòng -->
                            <?php if (isset($row['GiaKhuyenMai']) && $row['GiaKhuyenMai'] < $row['ChiTietGia']) { ?>
                                <span class="text-danger fs-5 fw-bold">
                                    <?php echo number_format($giaSauKhuyenMai, 0, ',', '.'); ?> đ
                                </span>
                                <span class="text-secondary text-decoration-line-through">
                                    <?php echo number_format($row['ChiTietGia'], 0, ',', '.'); ?> đ
                                </span>
                            <?php } else { ?>
                                <span class="text-dark fs-5 fw-bold">
                                    <?php echo number_format($giaSauKhuyenMai, 0, ',', '.'); ?> đ
                                </span>
                            <?php } ?>

                            <!-- Đơn vị tính -->
                            <span>
                                <?php 
                                if ($row['donvitinh'] == 1) {
                                    echo '/bó';
                                } else if ($row['donvitinh'] == 2) {
                                    echo '/kí';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Phần "Xem chi tiết" sẽ được đặt riêng biệt ở dưới cùng -->
                <div class="text-center position-absolute bottom-0 w-99">
                    <a href="shop-detail.php?chitietid=<?php echo $row['ChiTietID']; ?>" 
                        class="btn border border-secondary rounded-pill px-3 py-1 text-primary w-99">
                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
<?php
        }
    }
?>

                <style>
                    .fruite-item {
                        position: relative;
                    }

                    .fruite-item .fruite-img {
                        height: 200px;
                    }

                    .fruite-item .p-4 {
                        padding-bottom: 60px; 
                    }

                    .fruite-item .text-center {
                        position: absolute;
                        bottom: 50px; 
                        left: 0px;
                        right: 0;
                        margin-bottom: 15px;
                         
                    }

                    ul li{
                        padding: 14px;
                        border: 1px solid #bbb;
                        margin: 8px;
                        cursor: pointer;border-radius: 12px;
                        background: #e0ffe4;
                        font-weight: bold;font-size: 16px;
                    }
                    .activee{
                        background: #1bce33;color: white;
                    }
                    .item{
                        display: block;
                    }
                </style>
                        <!-- div này là div chứa mấy cái nút số 1 2 3 4 để phân trang -->
                        <div class="col-12">
                            <ul class="pagination d-flex justify-content-center mt-5">
                                
                            </ul>
                        </div>   
                        <script>
                            let thisPage = 1; let limit = 6;
                            let list = document.querySelectorAll('.item');//.item là class con.tức là từng cục của sp
                            function loadItem(){
                                let bigin=limit *(thisPage-1);
                                let end=limit *thisPage-1;
                                list.forEach((item,key)=>{
                                    if(key >=bigin && key<=end){
                                        item.style.display='block';
                                    }else{
                                        item.style.display='none';
                                    }
                                })
                                listPage();
                            }
                            loadItem();
                            function listPage(){
                                let countt =Math.ceil(list.length / limit);
                                document.querySelector('.pagination').innerHTML ='';
                                //pagination:là class của thẻ ul

                                if(thisPage !=1){
                                    let quayToi=document.createElement('li');
                                    quayToi.innerText="<<";
                                    quayToi.setAttribute('onclick',"changePage("+(thisPage-1)+")");
                                    document.querySelector('.pagination').appendChild(quayToi);
                                }

                                for(i=1;i<=countt;i++){
                                    let newPage=document.createElement('li');
                                    newPage.innerText=i;
                                    if(i == thisPage){
                                        newPage.classList.add('activee');
                                    }
                                    newPage.setAttribute('onclick',"changePage("+i+")");
                                    document.querySelector('.pagination').appendChild(newPage);
                                }

                                if(thisPage !=countt){
                                    let quayVe=document.createElement('li');
                                    quayVe.innerText=">>";
                                    quayVe.setAttribute('onclick',"changePage("+(thisPage+1)+")");
                                    document.querySelector('.pagination').appendChild(quayVe);
                                }
                            }
                            function changePage(i){
                                thisPage =i;
                                loadItem();
                            }
                        </script>
                        </div>
                        <!-- <div class="col-12">
                            <div class="pagination d-flex justify-content-center mt-5">
                                <a href="#" class="rounded">&laquo;</a>
                                <a href="#" class="active rounded">1</a>
                                <a href="#" class="rounded">2</a>
                                <a href="#" class="rounded">3</a>
                                <a href="#" class="rounded">4</a>
                                <a href="#" class="rounded">5</a>
                                <a href="#" class="rounded">6</a>
                                <a href="#" class="rounded">&raquo;</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

<script>
    $(document).ready(function() {
        $('input[type=radio][name=categories]').change(function() {
            var selectedValue = $(this).val();
            $.ajax({
                type: "POST",
                url: "./get_products.php",
                data: {
                    'selectedValue': selectedValue
                },
                success: function(data) {
                    $('#sanpham').html(data);
                }
            });
            // $.get("./get_products.php",{sanpham:selectedValue},function(data){
            //     $("#sanpham").html(data);
            // });
        });
    });
</script>
<script>
    // Hàm loadPage được sử dụng để tải lại phần tử #sanpham từ một URL mới
    function loadPage(url) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var newContent = xhr.responseText;
                var newElement = document.createElement('div');
                newElement.innerHTML = newContent;
                var newSanpham = newElement.querySelector('#sanpham');
                document.getElementById('sanpham').innerHTML = newSanpham.innerHTML;
            }
        };
        xhr.open('GET', url, true);
        xhr.send();
    }

    // Bắt sự kiện click trên các liên kết phân trang
    document.addEventListener('DOMContentLoaded', function() {
        var paginationLinks = document.querySelectorAll('.pagination a');
        paginationLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
                var pageURL = this.getAttribute('href');
                loadPage(pageURL);
            });
        });
    });
</script>
<?php
include('./incc/chantrang.php');
?>