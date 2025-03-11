<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
?>

<?php
class danhmuccha{
    private $db;
    private $fm ;
    public function __construct(){
        $this -> db = new Database;
        $this ->fm=new Format();
    }
    public function themDMcha($DMName){
        $DMName=$this ->fm->validation($DMName);
        $DMName =mysqli_real_escape_string( $this->db->link,$DMName);
        //empty: trống
        if(empty($DMName)){
            $alert="Danh mục không được trống";
            return $alert;
        }else{
            $query ="INSERT INTO da_phanloaitp (PhanLoaiTPName) VALUE ('$DMName')";
            $result =$this->db->insert($query);
            if($result){
                $alert ="<span style='font-size: 18px;color: green;' class='success'>Thêm thành công</span>";
                return $alert;
            }else{
                $alert ="<span style='font-size: 18px;color: red;' class='error'> đã sảy ra lỗi thêm không thành công</span>";
                return $alert;
            }
            
        }

    }
    public function hienthiDMcha(){
        $query = " SELECT * from da_phanloaitp";
        $result = $this->db->select($query);
        return $result;
    }
    public function LayDMcha($DMID){
        $query =" SELECT PhanLoaiTPName from da_phanloaitp where PhanLoaiTPID='$DMID' ";
        $result =$this->db->select($query);
        return $result;
    }
    public function suaDMcha($DMName,$DMID){
        $DMName=$this ->fm->validation($DMName);
        $DMName =mysqli_real_escape_string( $this->db->link,$DMName);
        $DMID=mysqli_real_escape_string( $this->db->link,$DMID);
        //empty: trống
        if(empty($DMName)){
            $alert="Danh mục không được trống";
            return $alert;
        }else{
            $query =" UPDATE da_phanloaitp SET PhanLoaiTPName='$DMName' WHERE PhanLoaiTPID='$DMID'";
            $result =$this->db->update($query);
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
    }
    public function xoaDMcha($delectID){
        $query = " DELETE from da_phanloaitp where PhanLoaiTPID='$delectID' ";
        $result = $this->db->delete($query);
        header('Location:catlist.php');
       return $result;
    }
}
?>