<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../class/khuyenmai.php';

$KM = new khuyenmai();

// Kiểm tra nếu có ID khuyến mãi được truyền qua URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin khuyến mãi cần sửa
    $khuyenMai = $KM->getKhuyenMaiById($id);
    if ($khuyenMai) {
        $data = $khuyenMai->fetch_assoc();
    } else {
        echo "<script>alert('Khuyến mãi không tồn tại!');</script>";
        echo "<script>window.location = 'danhsachKM.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID không hợp lệ!');</script>";
    echo "<script>window.location = 'danhsachKM.php';</script>";
    exit;
}

// Xử lý khi người dùng submit form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tenKM = isset($_POST['ten_khuyenmai']) ? $_POST['ten_khuyenmai'] : '';
    $moTa = isset($_POST['mo_ta']) ? $_POST['mo_ta'] : '';
    $loaiKM = isset($_POST['kieu_khuyenmai']) ? $_POST['kieu_khuyenmai'] : '';
    $giaTri = isset($_POST['gia_tri_khuyenmai']) ? $_POST['gia_tri_khuyenmai'] : '';
    $donHangToiThieu = isset($_POST['don_hang_toi_thieu']) ? $_POST['don_hang_toi_thieu'] : '';
    $ngayBatDau = isset($_POST['ngay_bat_dau']) ? $_POST['ngay_bat_dau'] : '';
    $ngayKetThuc = isset($_POST['ngay_ket_thuc']) ? $_POST['ngay_ket_thuc'] : '';
    $trangThai = isset($_POST['trang_thai']) ? $_POST['trang_thai'] : '';

    // Gọi phương thức cập nhật khuyến mãi
    $result = $KM->suaKhuyenMai($id, $tenKM, $moTa, $loaiKM, $giaTri, $donHangToiThieu, $ngayBatDau, $ngayKetThuc, $trangThai);
    
    if ($result) {
        echo "<script>alert('Cập nhật khuyến mãi thành công!');</script>";
        echo "<script>window.location = 'danhsachKM.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra!');</script>";
    }
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa khuyến mãi</h2>
        <div class="block">
            <form method="POST" action="suaKM.php?id=<?php echo $id; ?>">
                <label for="ten_khuyenmai">Tên khuyến mãi:</label>
                <input type="text" id="ten_khuyenmai" name="ten_khuyenmai" value="<?php echo $data['ten_khuyenmai']; ?>" required><br>

                <label for="mo_ta">Mô tả chi tiết:</label>
                <textarea id="mo_ta" name="mo_ta"><?php echo $data['mo_ta']; ?></textarea><br>

                <label for="kieu_khuyenmai">Loại khuyến mãi:</label>
                <select id="kieu_khuyenmai" name="kieu_khuyenmai" required>
                    <option value="phan_tram" <?php echo ($data['kieu_khuyenmai'] == 'phan_tram') ? 'selected' : ''; ?>>Giảm giá theo phần trăm</option>
                    <option value="tien_mat" <?php echo ($data['kieu_khuyenmai'] == 'tien_mat') ? 'selected' : ''; ?>>Giảm giá theo số tiền</option>
                    <option value="qua_tang" <?php echo ($data['kieu_khuyenmai'] == 'qua_tang') ? 'selected' : ''; ?>>Quà tặng đi kèm</option>
                </select><br>

                <label for="gia_tri_khuyenmai">Giá trị khuyến mãi:</label>
                <input type="number" id="gia_tri_khuyenmai" name="gia_tri_khuyenmai" value="<?php echo $data['gia_tri_khuyenmai']; ?>" required><br>

                <label for="don_hang_toi_thieu">Đơn hàng tối thiểu:</label>
                <input type="number" id="don_hang_toi_thieu" name="don_hang_toi_thieu" value="<?php echo $data['don_hang_toi_thieu']; ?>"><br>

                <label for="ngay_bat_dau">Ngày bắt đầu:</label>
                <input type="date" id="ngay_bat_dau" name="ngay_bat_dau" value="<?php echo $data['ngay_bat_dau']; ?>" required><br>

                <label for="ngay_ket_thuc">Ngày kết thúc:</label>
                <input type="date" id="ngay_ket_thuc" name="ngay_ket_thuc" value="<?php echo $data['ngay_ket_thuc']; ?>" required><br>

                <label for="trang_thai">Trạng thái:</label>
                <select id="trang_thai" name="trang_thai" required>
                    <option value="hoat_dong" <?php echo ($data['trang_thai'] == 'hoat_dong') ? 'selected' : ''; ?>>Hoạt động</option>
                    <option value="tam_ngung" <?php echo ($data['trang_thai'] == 'tam_ngung') ? 'selected' : ''; ?>>Tạm ngưng</option>
                </select><br>
                <button type="submit">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
