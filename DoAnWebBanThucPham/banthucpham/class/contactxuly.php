<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
?>

<?php
class contactxuly{
    private $db;
    private $fm ;
    public function __construct(){
        $this -> db = new Database;
        $this ->fm=new Format();
    }
    public function themlienhe($name,$email,$ghichu){
        $query="INSERT INTO lienhe (ten, email, ghichu) VALUES ('$name', '$email', '$ghichu')";
        $result =$this ->db ->insert($query);
        return $result;
    }
    public function laylienhe(){
        $query="SELECT * FROM lienhe";
        $result =$this ->db ->select($query);
        return $result;
    }
    public function xoalienhe($delectID){
        $query = "DELETE from lienhe where id='$delectID'";
        $result = $this->db->delete($query);
        header('Location:dslienhe.php');
        return $result;
    }
    
}
?>