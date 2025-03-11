<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../class/thongke.php';?>

        <div class="grid_10">
       
<?php
    $tk = new thongke();
    $tongsosp = $tk->tong_so_sp();
    $tongsonguoidung = $tk->tong_so_nguoi_dung();
    $tongsodoanhthu = $tk->tong_so_doanh_thu();
    $spduocmuanhieunhat = $tk->san_pham_duoc_mua_nhieu_nhat();
    $tienchitieu = $tk->tongTienChiTieu();
    $donhang = $tk->soDonHang();
    $giatritrungbinh = $tk->giaTriTrungBinhDonHang();
    $donhangtrangthai = $tk->soLuongDonHangTheoTrangThai();
    $doanhthusanpham = $tk->doanhThuSanPham();
    $doanhthuhangngay = $tk->doanhThuHangNgay();
    ?>
<?php 

?>
<div class="container" style="background-color: #fff; color:black;">
    <h2>Thống Kê</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng Số Sản Phẩm</h5>
                    <p class="card-text"><?php echo $tongsosp; ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Số Lượng Người Dùng</h5>
                    <p class="card-text"><?php echo $tongsonguoidung; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng Số Doanh Thu</h5>
                    <p class="card-text"><?php echo $tongsodoanhthu; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Sản Phẩm Được Mua Nhiều Nhất</h5>
                <?php if($spduocmuanhieunhat && isset($spduocmuanhieunhat['labels'][0]) && isset($spduocmuanhieunhat['data'][0])): ?>
                    <p class="card-text"><?php echo $spduocmuanhieunhat['labels'][0]; ?> (Số lượng:<?php echo $spduocmuanhieunhat['data'][0]; ?>)</p>
                <?php else: ?>
                    <p class="card-text">Không có dữ liệu</p>
                <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Tiền Chi Tiêu Của Khách Hàng (Top 10)</h5>
                        <ul>
                            <?php foreach($tienchitieu as $row): ?>
                                <li>Khách hàng ID: <?php echo $row['customer_id']; ?> - Tổng chi tiêu: <?php echo $row['total_spent']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Thống kê Số Đơn Hàng -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Số Đơn Hàng Của Khách Hàng (Top 10)</h5>
                        <ul>
                            <?php foreach($donhang as $row): ?>
                                <li>Khách hàng ID: <?php echo $row['customer_id']; ?> - Số đơn hàng: <?php echo $row['total_orders']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Thống kê Doanh Thu Sản Phẩm -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Doanh Thu Sản Phẩm</h5>
                        <ul>
                            <?php foreach($doanhthusanpham as $row): ?>
                                <li>Sản phẩm: <?php echo $row['ChiTietName']; ?> - Doanh thu: <?php echo $row['product_revenue']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Giá Trị Trung Bình Đơn Hàng</h5>
                        <p class="card-text">
                            <?php echo $giatritrungbinh['average_order_value']; ?>
                        </p>
                    </div>
                </div>
            </div>
    </div>
   
    <?php
    $ds_spduocmuanhieunhat = $tk->ds_san_pham_duoc_mua_nhieu_nhat();
?>
<br>
<h5 class="card-title">Biểu Đồ Thống Kê Sản Phẩm Được Mua Nhiều Nhất:</h5>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="myChart" width="400" height="200"></canvas>

<script>
    var dsspduocmuanhieunhat = <?php echo json_encode($ds_spduocmuanhieunhat); ?>;
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dsspduocmuanhieunhat.labels, 
            datasets: [{
                label: 'Số lượng', 
                data: dsspduocmuanhieunhat.data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1 
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true 
                }
            }
        }
    });
</script>
    </div>
</div>



</div>
<?php include 'inc/footer.php';?>