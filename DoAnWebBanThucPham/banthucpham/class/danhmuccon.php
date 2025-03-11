<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
?>

<?php
class danhmuccon{
    private $db;
    private $fm ;
    public function __construct(){
        $this -> db = new Database;
        $this ->fm=new Format();
    }
    public function themDMcon($IDDM,$brandName){
        $query="INSERT into da_dmcon(PhanLoaiTPID,DMName) values ('$IDDM','$brandName')";
        $result =$this ->db ->insert($query);
        return $result;

    }
    public function hienthiDMcha(){
        $query = " SELECT * from da_phanloaitp order by PhanLoaiTPID desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function hienthiDMcon(){
        $query = " SELECT * from da_dmcon order by PhanLoaiTPID desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function   hienthiDMchatheocon($brandID){
        $query = " SELECT * from da_dmcon where DMID='$brandID'";
        $result = $this->db->select($query);
        return $result;
    }
    public function LayDMcha($DMID){
        $query =" SELECT PhanLoaiTPName from da_phanloaitp where PhanLoaiTPID='$DMID' ";
        $result =$this->db->select($query);
        return $result;
    }
    public function LayDMcon($brandID){
        $query =" SELECT DMName from da_dmcon where DMID='$brandID' ";
        $result =$this->db->select($query);
        return $result;
    }
    public function hienthidanhmucon(){
        $query="SELECT da_dmcon.* ,da_phanloaitp.PhanLoaiTPName FROM da_dmcon INNER JOIN da_phanloaitp ON da_dmcon.PhanLoaiTPID = da_phanloaitp.PhanLoaiTPID ORDER BY da_dmcon.PhanLoaiTPID DESC";
        $result =$this ->db ->select($query);
        return $result;
    }
    public function suaDMcon($IDDMcha,$brandName, $brandID){
        $query = "UPDATE da_dmcon SET DMName = '$brandName',PhanLoaiTPID='$IDDMcha' WHERE DMID='$brandID' ";
        $result =$this ->db ->update($query);
        if($result){
            $alert ="<span style='font-size: 18px;color: green;' class='success'>Cập nhật thành công</span>";
            // header('Location:catlist.php');
            return $alert;
            // header('Location:catlist.php',true);
        }else{
            $alert ="<span style='font-size: 18px;color: red;' class='error'> đã sảy ra lỗi cập nhật không thành công</span>";
            return $alert;
        }
    }
    public function XOA_DMcon($brandID){
        $query = " DELETE from da_dmcon where DMID='$brandID' ";
        $result = $this->db->delete($query);
        header('Location:brandlist.php');
       return $result;
    }
}
?>