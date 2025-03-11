<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../class/khuyenmai.php';

$KM = new khuyenmai();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tenKM = isset($_POST['ten_khuyenmai']) ? $_POST['ten_khuyenmai'] : '';
    $moTa = isset($_POST['mo_ta']) ? $_POST['mo_ta'] : '';
    $loaiKM = isset($_POST['kieu_khuyenmai']) ? $_POST['kieu_khuyenmai'] : '';
    $giaTri = isset($_POST['gia_tri_khuyenmai']) ? $_POST['gia_tri_khuyenmai'] : '';
    $donHangToiThieu = isset($_POST['don_hang_toi_thieu']) ? $_POST['don_hang_toi_thieu'] : '';
    $ngayBatDau = isset($_POST['ngay_bat_dau']) ? $_POST['ngay_bat_dau'] : '';
    $ngayKetThuc = isset($_POST['ngay_ket_thuc']) ? $_POST['ngay_ket_thuc'] : '';
    $trangThai = isset($_POST['trang_thai']) ? $_POST['trang_thai'] : '';

    // Gọi phương thức thêm khuyến mãi
    $result = $KM->themKM($tenKM, $moTa, $loaiKM, $giaTri, $donHangToiThieu, $ngayBatDau, $ngayKetThuc, $trangThai);

    if ($result) {
        echo "<script>alert('Thêm khuyến mãi thành công!');</script>";
        echo "<script>window.location = 'danhsachKM.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra!');</script>";
    }
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm mới khuyến mãi</h2>
        <div class="block">
        <form method="POST" action="themkhuyenmai.php">
    <div class="form-row">
        <label for="ten_khuyenmai">Tên khuyến mãi:</label>
        <input type="text" id="ten_khuyenmai" name="ten_khuyenmai" required>
    </div>

    <div class="form-row">
        <label for="mo_ta">Mô tả chi tiết:</label>
        <textarea id="mo_ta" name="mo_ta"></textarea>
    </div>

    <div class="form-row">
        <label for="kieu_khuyenmai">Loại khuyến mãi:</label>
        <select id="kieu_khuyenmai" name="kieu_khuyenmai" required>
            <option value="phan_tram">Giảm giá theo phần trăm</option>
            <option value="tien_mat">Giảm giá theo số tiền</option>
            <option value="qua_tang">Quà tặng đi kèm</option>
        </select>
    </div>

    <div class="form-row">
        <label for="gia_tri_khuyenmai">Giá trị khuyến mãi:</label>
        <input type="number" id="gia_tri_khuyenmai" name="gia_tri_khuyenmai" required>
    </div>

    <div class="form-row">
        <label for="don_hang_toi_thieu">Đơn hàng tối thiểu:</label>
        <input type="number" id="don_hang_toi_thieu" name="don_hang_toi_thieu">
    </div>

    <div class="form-row">
        <label for="ngay_bat_dau">Ngày bắt đầu:</label>
        <input type="date" id="ngay_bat_dau" name="ngay_bat_dau" required>
    </div>

    <div class="form-row">
        <label for="ngay_ket_thuc">Ngày kết thúc:</label>
        <input type="date" id="ngay_ket_thuc" name="ngay_ket_thuc" required>
    </div>

    <div class="form-row">
        <label for="trang_thai">Trạng thái:</label>
        <select id="trang_thai" name="trang_thai" required>
            <option value="hoat_dong">Hoạt động</option>
            <option value="tam_ngung">Tạm ngưng</option>
        </select>
    </div>

    <button type="submit">Thêm khuyến mãi</button>
</form>

        </div>
    </div>
</div>
<style>
    /* Reset một số thuộc tính cơ bản
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
} */

/* Định dạng chung cho trang */
/* body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
} */

/* .grid_10 {
    max-width: 1200px;
    margin: 20px auto;
    padding: 15px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
} */

/* Định dạng cho box */
/* .box {
    margin: 0;
    padding: 15px;
} */

/* Tiêu đề form */
h2 {
    text-align: center;
    color: #2c3e50;
    font-size: 20px;
    margin-bottom: 15px;
}

/* Định dạng cho các label và input */
/* .form-row {
    display: flex;
    align-items: center; 
    margin-bottom: 10px;
} */

.form-row label {
    flex: 0 0 30%; 
    margin-right: 10px; 
    font-size: 14px;
    color: #333;
}

.form-row input, .form-row select, .form-row textarea {
    flex: 1; 
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

/* Giảm chiều cao của textarea */
textarea {
    height: 60px;
}

/* Định dạng cho nút submit */
button[type="submit"] {
    background-color: #3498db;
    color: white;
    padding: 8px 16px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
}

/* Hiệu ứng hover cho nút submit */
button[type="submit"]:hover {
    background-color: #2980b9;
}

/* Cải thiện cách hiển thị form */
/* .block {
    padding: 10px;
} */

/* Thêm khoảng cách cho các input */
input, select, textarea {
    margin-top: 5px;
}

</style>