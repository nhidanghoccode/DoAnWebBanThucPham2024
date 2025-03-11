<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
?>
<?php
class thongke
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function tong_so_sp() {
        // Query để đếm số lượng truyện
        $query = "SELECT COUNT(*) AS tongsosp FROM da_chitiettp";
        $result = $this->db->select($query);
        if($result) {
            $row = $result->fetch_assoc();
            $tongsosp = $row['tongsosp'];
            return $tongsosp;
        } else {
            return 0;
        }
    }
    public function tong_so_nguoi_dung(){
        $query = "SELECT COUNT(*) as tongsonguoidung FROM da_loginuser";
        $result = $this->db->select($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['tongsonguoidung'];
        } else {
            return 0;
        }
    }
    public function tong_so_doanh_thu() {
        $query = "SELECT SUM(tongtien) AS doanhthu FROM da_donhangdadat WHERE TrangThai = 2";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_revenue = $row['doanhthu']; 
            return number_format($total_revenue, 0, ',', '.') . ' VNĐ'; 
        } else {
            return '0 VNĐ';
        }
    }
    public function san_pham_duoc_mua_nhieu_nhat() {
        $query = "SELECT da_dathang.ChiTietName, COUNT(*) AS so_luong_mua
                  FROM da_donhangdadat
                  INNER JOIN da_dathang ON da_donhangdadat.madonhang = da_dathang.madonhang
                  WHERE da_donhangdadat.TrangThai = 2
                  GROUP BY da_dathang.ChiTietName
                  ORDER BY so_luong_mua DESC
                  LIMIT 1";
        $result = $this->db->select($query);
        $chart_data = array(
            'labels' => array(),
            'data' => array()
        );
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $chart_data['labels'][] = $row['ChiTietName'];
                $chart_data['data'][] = $row['so_luong_mua'];
            }
            return $chart_data;
        } else {
            return null; 
        }
    }    
    public function ds_san_pham_duoc_mua_nhieu_nhat() {
        $query = "SELECT da_dathang.ChiTietName, COUNT(*) AS so_luong_mua
                  FROM da_donhangdadat
                  INNER JOIN da_dathang ON da_donhangdadat.madonhang = da_dathang.madonhang
                  WHERE da_donhangdadat.TrangThai = 2
                  GROUP BY da_dathang.ChiTietName
                  ORDER BY so_luong_mua DESC
                  LIMIT 10;";
        $result = $this->db->select($query);
        $chart_data = array(
            'labels' => array(),
            'data' => array()
        );
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $chart_data['labels'][] = $row['ChiTietName'];
                $chart_data['data'][] = $row['so_luong_mua'];
            }
            return $chart_data;
        } else {
            return null; 
        }
    }
    public function san_pham_duoc_danh_gia_tot_nhat() {
        $query = "SELECT da_dathang.ChiTietName, AVG(rating) AS average_rating
                  FROM product_ratings
                  INNER JOIN da_dathang ON product_ratings.product_id = da_dathang.dathangID
                  GROUP BY da_dathang.ChiTietName
                  ORDER BY average_rating DESC
                  LIMIT 10";
        $result = $this->db->select($query);
        $chart_data = array(
            'labels' => array(),
            'data' => array()
        );
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $chart_data['labels'][] = $row['ChiTietName'];
                $chart_data['data'][] = $row['average_rating'];
            }
            return $chart_data;
        } else {
            return null;
        }
    }
    public function tongTienChiTieu() {
        $query = "SELECT customer_id, SUM(tongtien) AS total_spent
                  FROM da_donhangdadat
                  WHERE TrangThai = 2
                  GROUP BY customer_id
                  ORDER BY total_spent DESC
                  LIMIT 10";
        return $this->db->select($query);
    }

    // Thống kê số đơn hàng của khách hàng
    public function soDonHang() {
        $query = "SELECT customer_id, COUNT(*) AS total_orders
                  FROM da_donhangdadat
                  WHERE TrangThai = 2
                  GROUP BY customer_id
                  ORDER BY total_orders DESC
                  LIMIT 10";
        return $this->db->select($query);
    }

    // Thống kê giá trị trung bình của mỗi đơn hàng
    public function giaTriTrungBinhDonHang() {
        $query = "SELECT AVG(tongtien) AS average_order_value
                    FROM da_donhangdadat
                    WHERE TrangThai = 2;";
        $result = $this->db->select($query);
        
        // Kiểm tra và lấy dữ liệu từ kết quả truy vấn
        if ($row = $result->fetch_assoc()) {
            return $row;
        } else {
            return null; // Trả về null nếu không có dữ liệu
        }
    }
    

    // Thống kê trạng thái đơn hàng
    public function soLuongDonHangTheoTrangThai() {
        $query = "SELECT TrangThai, COUNT(*) AS order_count
                  FROM da_donhangdadat
                  GROUP BY TrangThai";
        return $this->db->select($query);
    }
    public function doanhThuSanPham() {
        $query = "SELECT da_dathang.ChiTietName, SUM(da_dathang.orderGia) AS product_revenue
                  FROM da_dathang
                  INNER JOIN da_donhangdadat ON da_dathang.madonhang = da_donhangdadat.madonhang
                  WHERE da_donhangdadat.TrangThai = 2
                  GROUP BY da_dathang.ChiTietName
                  ORDER BY product_revenue DESC";
        return $this->db->select($query);
    }
    public function doanhThuHangNgay() {
        $query = "SELECT DATE(ngaydat) AS order_date, SUM(tongtien) AS daily_sales
                  FROM da_donhangdadat
                  WHERE TrangThai = 2
                  GROUP BY order_date
                  ORDER BY order_date DESC";
        return $this->db->select($query);
    }
}
?>