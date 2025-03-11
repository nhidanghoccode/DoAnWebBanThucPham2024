<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class login_class
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format();
    }
    public function hienthiTinh()
    {
        $query = " SELECT * from da_thanhpho";
        $result = $this->db->select($query);
        return $result;
    }
    public function hienthicacdonhang($madonhang)
    {
        $query = "SELECT 
        dh.*, 
        sp.ChiTietName, 
        sp.ChiTietGia, 
        sp.ChiTietImg, 
        COALESCE(km.gia_tri_khuyenmai, km_dm.gia_tri_khuyenmai, 0) AS gia_tri_khuyenmai,
        CASE 
            WHEN km.gia_tri_khuyenmai IS NOT NULL THEN sp.ChiTietGia * (1 - km.gia_tri_khuyenmai / 100)
            WHEN km_dm.gia_tri_khuyenmai IS NOT NULL THEN sp.ChiTietGia * (1 - km_dm.gia_tri_khuyenmai / 100)
            ELSE sp.ChiTietGia
        END AS GiaSauKhuyenMai
    FROM 
        da_dathang dh
    JOIN 
        da_chitiettp sp ON dh.ChiTietID = sp.ChiTietID
    LEFT JOIN 
        chitiet_khuyenmai ctkm ON sp.ChiTietID = ctkm.ChiTietID
    LEFT JOIN 
        khuyenmai km ON ctkm.KhuyenMaiID = km.id_KM
    LEFT JOIN 
        chitiet_khuyenmai ctkm_dm ON sp.PhanLoaiTPID = ctkm_dm.PhanLoaiTPID
    LEFT JOIN 
        khuyenmai km_dm ON ctkm_dm.KhuyenMaiID = km_dm.id_KM
    WHERE 
        dh.madonhang = '$madonhang'
    ";
        $result = $this->db->select($query);
        return $result;
    }
    public function hienthiloaiDM_ajax($tinhID)
    {
        $query = "SELECT *from da_huyen where tinhID='$tinhID'";
        $result = $this->db->select($query);
        return $result;
    }
    //THÊM THÀNH VIÊN
    public function themTV($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $tinh = mysqli_real_escape_string($this->db->link, $data['tinh']);
        $huyen = mysqli_real_escape_string($this->db->link, $data['huyen']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
        $sdt = mysqli_real_escape_string($this->db->link, $data['sdt']);
        $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));

        if ($name == "" || $tinh == "" || $huyen == "" ||  $email == "" || $diachi == "" || $sdt == "" || $pass == "") {
            $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống trường nào</span>";
            return $alert;
        } else {
            // $check_email = "SELECT *from da_loginuser where cusEmail='$email' LIMIT 1";
            // $check_em = $this->db->select($check_email);

             $check_sdt = "SELECT *from da_loginuser where cusSDT='$sdt' LIMIT 1";
            $check_em_sdt = $this->db->select($check_sdt);
            // if ($check_em) {
            //     $alert = "<span style='font-size: 18px;color: red;' class='success'>Email này đã tồn tại</span>";
            //     return $alert;
            // } else {
            //     $query = "INSERT INTO da_loginuser (cusName,cusDiaChi,tinhID,huyenID,cusSDT,cusEmail,cusPass) 
            //                     VALUE ('$name',' $diachi','$tinh','$huyen ','$sdt','$email','$pass')";
            //     $result = $this->db->insert($query);
            //     if ($result) {
            //         $alert = "<span style='font-size: 18px;color: yellow;' class='success'>Đăng Kí thành công</span>";
            //         // header('Location:order.php');
            //         return $alert;
            //     }
            // }
             // Kiểm tra số điện thoại bắt đầu bằng số 0 và có 10 chữ số
    if (!preg_match('/^0\d{9}$/', $sdt)) {
        $alert = "<span style='font-size: 18px;color: red;' class='success'>Số điện thoại không hợp lệ. Số điện thoại phải bắt đầu bằng số 0 và có 10 chữ số.</span>";
        return $alert;
    }
            if ($check_em_sdt) {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>SDT này đã được đăng kí hãy đăng nhập</span>";
                return $alert;
            } else {
                $query = "INSERT INTO da_loginuser (cusName,cusDiaChi,tinhID,huyenID,cusSDT,cusEmail,cusPass) 
                                VALUE ('$name',' $diachi','$tinh','$huyen ','$sdt','$email','$pass')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span style='font-size: 18px;color: yellow;' class='success'>Đăng Kí thành công</span>";
                    // header('Location:order.php');
                    return $alert;
                }
            }
        }
    }
    public function dangnhap($data)
    {
        $sdtt = mysqli_real_escape_string($this->db->link, $data['sdt']);
        $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
        if ($sdtt == "" || $pass == "") {
            $alert = "<span style='font-size: 18px;color: red;' class='success'>Hãy nhập Pass hoặc số điện thoại</span>";
            return $alert;
        } else {
            $check_login = "SELECT *from da_loginuser where cusSDT='$sdtt' and cusPass='$pass'";
            $check_emm = $this->db->select($check_login);
            if ($check_emm != false) {
                $valuee = $check_emm->fetch_assoc();
                Session::set('curtomer_login', true);
                Session::set('curtomer_id', $valuee['cusID']);
                Session::set('curtomer_name', $valuee['cusName']);
                // header('Location:order.php');
            } else {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>số điện thoại  hoặc Pass sai</span>";
                return $alert;
            }
        }
    }
    public function layTTnguoidung($id)
    {
        $show_login = "SELECT p.*,b.tenTinh,c.TenHuyen 
                    from da_loginuser as p,da_thanhpho as b,da_huyen as c 
                    where p.huyenID=c.huyenID and p.tinhID=b.tinhID and cusID='$id'";
        $check_em = $this->db->select($show_login);
        return $check_em;
    }
    public function capnhattt($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
        $phone = mysqli_real_escape_string($this->db->link, $data['sdt']);
        $huyen = mysqli_real_escape_string($this->db->link, $data['huyen']);
        $tinh = mysqli_real_escape_string($this->db->link, $data['tinh']);


        if ($name == "" || $email == "" || $diachi == "" || $phone == "" || $huyen == "" || $tinh == "") {
            $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống trường nào</span>";
            return $alert;
        } else {
            $query = "UPDATE da_loginuser set cusName='$name' ,cusEmail='$email ',cusDiaChi='$diachi',cusSDT='$phone',tinhID='$tinh',huyenID='$huyen' where cusID='$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span style='font-size: 18px;color: yellow;' class='success'>cập nhật thành công</span>";
                return $alert;
            }
        }
    }
    public function layEmailNguoidung($cus_id) {
        $query = "SELECT cusEmail FROM da_loginuser WHERE cusID = '$cus_id'";
        $result = $this->db->select($query);
    
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['cusEmail']; // Trả về email người dùng
        } else {
            return null; // Nếu không tìm thấy, trả về null
        }
    }
    
    public function layTenNguoidung($cus_id) {
        $query = "SELECT cusName FROM da_loginuser WHERE cusID = '$cus_id'";
        $result = $this->db->select($query);
    
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['cusName']; // Trả về tên người dùng
        } else {
            return null; // Nếu không tìm thấy, trả về null
        }
    }
}
?>