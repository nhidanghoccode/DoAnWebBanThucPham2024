<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../class/khuyenmai.php';
?>
<?php
    $KM = new khuyenmai();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Nhận giá trị từ form
        $khuyenMaiID = isset($_POST['KhuyenMaiID']) ? $_POST['KhuyenMaiID'] : null;
        $kieuApDung = isset($_POST['kieu_ap_dung']) ? $_POST['kieu_ap_dung'] : null;
        $soLuong = isset($_POST['so_luong']) ? $_POST['so_luong'] : null;
        $danhMucID = isset($_POST['DanhMucID']) ? $_POST['DanhMucID'] : null;
        $sanPhamID = isset($_POST['SanPhamID']) ? $_POST['SanPhamID'] : null;

        // Kiểm tra dữ liệu
        if (empty($khuyenMaiID)) {
            echo "Vui lòng chọn khuyến mãi.";
        } elseif (empty($soLuong) || $soLuong <= 0) {
            echo "Vui lòng nhập số lượng hợp lệ.";
        } elseif ($kieuApDung == 'danh_muc' && empty($danhMucID)) {
            echo "Vui lòng chọn danh mục sản phẩm.";
        } elseif ($kieuApDung == 'san_pham_cu_the' && empty($sanPhamID)) {
            echo "Vui lòng chọn sản phẩm cụ thể.";
        } else {
            // Nếu tất cả các kiểm tra hợp lệ, tiến hành xử lý và lưu dữ liệu
            $KM->themspKhuyenMai($khuyenMaiID, $kieuApDung, $soLuong, $danhMucID, $sanPhamID);
            echo "Khuyến mãi đã được liên kết thành công!";
        }
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm khuyến mãi</h2>
        <form method="POST" action="themchitietKM.php">
            <div class="form-group">
                <label for="khuyenmai">Chọn khuyến mãi:</label>
                <select id="khuyenmai" name="KhuyenMaiID" required>
                    <option value="" disabled selected>Chọn khuyến mãi</option>
                    <?php
                    $dskm = $KM->show_KhuyenMai();
                    if($dskm){
                        while($result = $dskm->fetch_assoc()){
                    ?>
                    <option value="<?php echo $result['id_KM'] ?>"><?php echo $result['ten_khuyenmai'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="kieu_ap_dung">Kiểu áp dụng:</label>
                <select id="kieu_ap_dung" name="kieu_ap_dung" required>
                    <option value="danh_muc">Danh mục sản phẩm</option>
                    <option value="san_pham_cu_the">Sản phẩm cụ thể</option>
                </select>
            </div>

            <!-- Phần chọn danh mục sản phẩm -->
            <div id="chon_danh_muc" class="form-group" style="display: none;">
                <label for="danh_muc">Chọn danh mục sản phẩm:</label>
                <select id="danh_muc" name="DanhMucID">
                    <option value="" disabled selected>Chọn danh mục</option>
                    <?php
                    $dsdm = $KM->show_danhmuc();
                    if($dsdm){
                        while($resultdm = $dsdm->fetch_assoc()){
                    ?>
                    <option value="<?php echo $resultdm['PhanLoaiTPID'] ?>"><?php echo $resultdm['PhanLoaiTPName'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Phần chọn sản phẩm cụ thể -->
            <div id="chon_san_pham" class="form-group" style="display: none;">
                <label for="san_pham">Chọn sản phẩm cụ thể:</label>
                <select id="san_pham" name="SanPhamID">
                    <option value="" disabled selected>Chọn sản phẩm</option>
                    <?php
                    $dssp = $KM->show_sanpham();
                    if($dssp){
                        while($result = $dssp->fetch_assoc()){
                    ?>
                    <option value="<?php echo $result['ChiTietID'] ?>"><?php echo $result['ChiTietName'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Phần nhập số lượng giới hạn -->
            <div class="form-group">
                <label for="so_luong">Số lượng giới hạn:</label>
                <input type="number" id="so_luong" name="so_luong" min="1" placeholder="Nhập số lượng" required>
            </div>

            <button type="submit">Liên kết</button>
        </form>
    </div>
</div>

<script>
    // Thêm sự kiện thay đổi kiểu áp dụng
    document.getElementById('kieu_ap_dung').addEventListener('change', function () {
        const kieu = this.value;
        document.getElementById('chon_danh_muc').style.display = kieu === 'danh_muc' ? 'block' : 'none';
        document.getElementById('chon_san_pham').style.display = kieu === 'san_pham_cu_the' ? 'block' : 'none';
    });
</script>
<style>
    /* Định dạng chung cho khung chứa form */
/* .grid_10 {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
} */

/* Định dạng cho mỗi phần nhóm trong form */
.form-group {
    margin-bottom: 20px;
}

/* Định dạng cho các label */
.form-group label {
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 5px;
}

/* Định dạng cho các select và input */
.form-group select,
.form-group input,
.form-group textarea {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Định dạng cho nút submit */
button[type="submit"] {
    background-color: #3498db;
    color: white;
    padding: 10px 15px;
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

/* Ẩn các phần chọn danh mục và sản phẩm khi chưa cần thiết */
#chon_danh_muc,
#chon_san_pham {
    display: none;
}

/* Định dạng cho các select box */
.form-group select {
    height: 35px;
}

/* Định dạng cho input số lượng */
.form-group input[type="number"] {
    height: 35px;
}

/* Điều chỉnh font-size cho các lựa chọn */
.form-group select option {
    font-size: 14px;
}

/* Điều chỉnh chiều cao của textarea nếu có */
textarea {
    height: 100px;
    resize: none;
}

</style>