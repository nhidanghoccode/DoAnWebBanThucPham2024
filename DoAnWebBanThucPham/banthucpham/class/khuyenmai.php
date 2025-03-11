<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

class khuyenmai {
    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function themKM($tenKM, $moTa, $loaiKM, $giaTri, $donHangToiThieu, $ngayBatDau, $ngayKetThuc, $trangThai) {
        $tenKM = mysqli_real_escape_string($this->db->link, $tenKM);
        $moTa = mysqli_real_escape_string($this->db->link, $moTa);
        $loaiKM = mysqli_real_escape_string($this->db->link, $loaiKM);
        $giaTri = mysqli_real_escape_string($this->db->link, $giaTri);
        $donHangToiThieu = mysqli_real_escape_string($this->db->link, $donHangToiThieu);
        // $sanPhamCuThe = mysqli_real_escape_string($this->db->link, $sanPhamCuThe);
        $ngayBatDau = mysqli_real_escape_string($this->db->link, $ngayBatDau);
        $ngayKetThuc = mysqli_real_escape_string($this->db->link, $ngayKetThuc);
        $trangThai = mysqli_real_escape_string($this->db->link, $trangThai);
    
        $query = "INSERT INTO khuyenmai (ten_khuyenmai, mo_ta, kieu_khuyenmai, gia_tri_khuyenmai, don_hang_toi_thieu, ngay_bat_dau, ngay_ket_thuc, trang_thai) 
                  VALUES ('$tenKM', '$moTa', '$loaiKM', '$giaTri', '$donHangToiThieu', '$ngayBatDau', '$ngayKetThuc', '$trangThai')";
    
        $result = $this->db->insert($query);
        return $result;
    }
    
    public function themChiTietKM($ChiTietID, $KhuyenMaiID) {
        // Tránh SQL Injection
        $ChiTietID = mysqli_real_escape_string($this->db->link, $ChiTietID);
        $KhuyenMaiID = mysqli_real_escape_string($this->db->link, $KhuyenMaiID);
    
        // Lệnh SQL thêm liên kết sản phẩm với khuyến mãi
        $query = "INSERT INTO chitiet_khuyenmai (ChiTietID, KhuyenMaiID) 
                  VALUES ('$ChiTietID', '$KhuyenMaiID')";
    
        // Thực hiện truy vấn
        $result = $this->db->insert($query);
    
        return $result; // Trả về kết quả (true/false)
    }
    public function layChiTietKhuyenMai($id) {
        $query = "SELECT * FROM chitiet_khuyenmai WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function hienthidanhsachKM() {
        $query = "SELECT id_KM, ten_khuyenmai, mo_ta, kieu_khuyenmai, gia_tri_khuyenmai, don_hang_toi_thieu, ngay_bat_dau, ngay_ket_thuc, trang_thai
                  FROM khuyenmai 
                  ORDER BY ngay_bat_dau DESC";
        $result = $this->db->select($query);
        return $result;
    }  
    public function hienthidanhsachspKM() {
        // Câu truy vấn đơn giản, không có tham số người dùng, nên không cần prepared statements
        $query = "SELECT 
    ctk.id, 
    ctk.ChiTietID, 
    ctk.KhuyenMaiID, 
    ctk.KieuApDung, 
    ctk.PhanLoaiTPID, 
    ctk.SoLuongGioiHan,
    km.ten_khuyenmai,       
    km.mo_ta,              
    km.gia_tri_khuyenmai,   
    km.ngay_bat_dau,     
    km.ngay_ket_thuc,       
    km.trang_thai,        
    dct.ChiTietName,       
    ptp.PhanLoaiTPName 
FROM 
    chitiet_khuyenmai ctk
JOIN 
    khuyenmai km ON ctk.KhuyenMaiID = km.id_KM
LEFT JOIN 
    da_chitiettp dct ON ctk.ChiTietID = dct.ChiTietID
LEFT JOIN 
    da_phanloaitp ptp ON ctk.PhanLoaiTPID = ptp.PhanLoaiTPID;
";
        
        // Thực hiện truy vấn và trả về kết quả
        $result = $this->db->select($query);
        return $result;
    }
    
    
    public function suaChiTietKhuyenMai($id, $ChiTietID, $KhuyenMaiID) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $ChiTietID = mysqli_real_escape_string($this->db->link, $ChiTietID);
        $KhuyenMaiID = mysqli_real_escape_string($this->db->link, $KhuyenMaiID);
    
        $query = "UPDATE chitiet_khuyenmai 
                  SET ChiTietID = '$ChiTietID', KhuyenMaiID = '$KhuyenMaiID' 
                  WHERE id = '$id'";
    
        $result = $this->db->update($query);
    
        if ($result) {
            return "<span class='success'>Cập nhật thành công!</span>";
        } else {
            return "<span class='error'>Có lỗi xảy ra!</span>";
        }
    }
    
    public function themTatCaSanPham($KhuyenMaiID) {
        $KhuyenMaiID = mysqli_real_escape_string($this->db->link, $KhuyenMaiID);
        $query = "INSERT INTO chitiet_khuyenmai (ChiTietID, KhuyenMaiID) 
                  SELECT SanPhamID, '$KhuyenMaiID' FROM san_pham";
        return $this->db->insert($query);
    }
    
    public function themDanhMucSanPham($KhuyenMaiID, $DanhMucID) {
        $KhuyenMaiID = mysqli_real_escape_string($this->db->link, $KhuyenMaiID);
        $DanhMucID = mysqli_real_escape_string($this->db->link, $DanhMucID);
        $query = "INSERT INTO chitiet_khuyenmai (ChiTietID, KhuyenMaiID) 
                  SELECT SanPhamID, '$KhuyenMaiID' FROM san_pham WHERE DanhMucID = '$DanhMucID'";
        return $this->db->insert($query);
    }
    
    public function themChiTietspKM($SanPhamID, $KhuyenMaiID) {
        $SanPhamID = mysqli_real_escape_string($this->db->link, $SanPhamID);
        $KhuyenMaiID = mysqli_real_escape_string($this->db->link, $KhuyenMaiID);
        $query = "INSERT INTO chitiet_khuyenmai (ChiTietID, KhuyenMaiID) 
                  VALUES ('$SanPhamID', '$KhuyenMaiID')";
        return $this->db->insert($query);
    }
    
    public function hienThiSanPham() {
        $query = "SELECT ChiTietID, ChiTietName FROM da_chitiettp";
        $result = $this->db->select($query);
        return $result;
    }
    public function hienThiKhuyenMai() {
        $query = "SELECT id_KM, ten_khuyenmai FROM khuyenmai";
        $result = $this->db->select($query);
        return $result;
    }    
    public function xoaKM($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM khuyenmai WHERE id_KM = '$id'";
        $result = $this->db->delete($query);
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function xoaspKM($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM chitiet_khuyenmai WHERE `chitiet_khuyenmai`.`id` = '$id'";
        $result = $this->db->delete($query);
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function huyLienKetSanPham($id) {
        $query = "UPDATE chitiet_khuyenmai SET id = NULL WHERE id = '$id'";
        $this->db->update($query);
    }

    public function show_KhuyenMai() {
        $query = "SELECT id_KM, ten_khuyenmai FROM khuyenmai";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_danhmuc() {
        $query = "SELECT PhanLoaiTPID, PhanLoaiTPName FROM da_phanloaitp";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_sanpham() {
        $query = "SELECT ChiTietID, ChiTietName FROM da_chitiettp";
        $result = $this->db->select($query);
        return $result;
    }
    public function themspKhuyenMai($khuyenMaiID, $kieuApDung, $soLuong, $danhMucID = null, $sanPhamID = null) {
        if ($kieuApDung == 'danh_muc') {
            $query = "INSERT INTO chitiet_khuyenmai (KhuyenMaiID, KieuApDung, SoLuongGioiHan, PhanLoaiTPID) 
                      VALUES (?, ?, ?, ?)";
            $params = [$khuyenMaiID, $kieuApDung, $soLuong, $danhMucID];
        } elseif ($kieuApDung == 'san_pham_cu_the') {
            $query = "INSERT INTO chitiet_khuyenmai (KhuyenMaiID, KieuApDung, SoLuongGioiHan, ChiTietID) 
                      VALUES (?, ?, ?, ?)";
            $params = [$khuyenMaiID, $kieuApDung, $soLuong, $sanPhamID];
        } else {
            $query = "INSERT INTO chitiet_khuyenmai (KhuyenMaiID, KieuApDung, SoLuongGioiHan) 
                      VALUES (?, ?, ?)";
            $params = [$khuyenMaiID, $kieuApDung, $soLuong];
        }
    
        $stmt = $this->db->link->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params); // 's' cho string và 'i' cho integer nếu cần
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                return "<span class='success'>Khuyến mãi đã được liên kết thành công!</span>";
            } else {
                return "<span class='error'>Có lỗi xảy ra khi liên kết khuyến mãi.</span>";
            }
        } else {
            return "<span class='error'>Không thể thực hiện câu lệnh SQL.</span>";
        }
    }
    
    ////////// Hiển thị người dùng
    public function getKhuyenMai() {
        $query = "SELECT ten_khuyenmai, mo_ta, gia_tri_khuyenmai, kieu_khuyenmai, ngay_bat_dau, ngay_ket_thuc 
                FROM khuyenmai 
                WHERE ngay_bat_dau <= CURDATE() AND ngay_ket_thuc >= CURDATE()";
        $result = $this->db->select($query);
        
        // Kiểm tra xem có kết quả trả về không
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); // Trả về dữ liệu của một khuyến mãi
        } else {
            return null; // Nếu không có khuyến mãi, trả về null
        }
    }
    public function getChiTietKhuyenMaiById($id) {
        $query = "SELECT * FROM chitiet_khuyenmai WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function capnhatChiTietKhuyenMai($id, $khuyenMaiID, $kieuApDung, $SoLuongGioiHan, $PhanLoaiTPID, $ChiTietID) {
        $PhanLoaiTPID = $PhanLoaiTPID === null ? "NULL" : "'$PhanLoaiTPID'";
        $ChiTietID = $ChiTietID === null ? "NULL" : "'$ChiTietID'";
        $query = "UPDATE chitiet_khuyenmai SET 
                    KhuyenMaiID = '$khuyenMaiID',
                    KieuApDung = '$kieuApDung',
                    SoLuongGioiHan = '$SoLuongGioiHan',
                    PhanLoaiTPID = $PhanLoaiTPID,
                    ChiTietID = $ChiTietID
                  WHERE id = '$id'";
        return $this->db->update($query);
    }    
    public function getKhuyenMaiById($id) {
        $query = "SELECT * FROM khuyenmai WHERE id_KM = '$id'";
        $result = $this->db->select($query);
    
        if (!$result) {
            die("Lỗi: Không thể lấy thông tin khuyến mãi. " . $this->db->link->error);
        }
    
        return $result;
    }  
    public function suaKhuyenMai($id, $tenKM, $moTa, $loaiKM, $giaTri, $donHangToiThieu, $ngayBatDau, $ngayKetThuc, $trangThai) {
        $query = "UPDATE khuyenmai 
                  SET 
                      ten_khuyenmai = '$tenKM',
                      mo_ta = '$moTa',
                      kieu_khuyenmai = '$loaiKM',
                      gia_tri_khuyenmai = '$giaTri',
                      don_hang_toi_thieu = '$donHangToiThieu',
                      ngay_bat_dau = '$ngayBatDau',
                      ngay_ket_thuc = '$ngayKetThuc',
                      trang_thai = '$trangThai'
                  WHERE id_KM = '$id'";
        $result = $this->db->update($query);
    
        if (!$result) {
            die("Lỗi: Không thể cập nhật khuyến mãi. " . $this->db->link->error);
        }
    
        return $result;
    }
    
    
}
?>
