<?php
namespace App\Controler;
use App\Model\ModelSanPham;
use App\Model\ModelHangTrongGio;
class controlSanPham{
    public $db;
    public $sotrang;
    public $url;
    public $errors = [];
    public function __construct($pdo)
	{
        $this->db = $pdo;
	}
    public function getErrors(){
        $this->errors;
    }
    public function addUrl($URL){
        $this->url = $URL;
    }
    public function trangSanPham($page){
        $controlSanPham = new ModelSanPham($this->db);
        $allSanPham =$controlSanPham->getTrangSanPham($page);
        return $allSanPham;
    }
    public function soTrangSanPham($iddm){
        $controlSanPham = new ModelSanPham($this->db);
        return ceil($controlSanPham->countSanPham()/9);
    }
    public function trangSanPhamDM($iddm,$page){
        $controlSanPham = new ModelSanPham($this->db);
        $allSanPham =$controlSanPham->getSanPhamTheoTrangDanhMuc($iddm,$page);
        return $allSanPham;
    }
    public function soTrangSanPhamDM($iddm){
        $controlSanPham = new ModelSanPham($this->db);
        return ceil($controlSanPham->countSanPhamTheoDanhMuc($iddm)/9);
    }
    public function chiTietSanPham($id){
        $controlSanPham = new ModelSanPham($this->db);
        return $controlSanPham->getChiTietSanPham($id);
    }
    public function addNewSanPham(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->url=='/addSanPham'||$_SERVER['REQUEST_METHOD'] === 'POST' && $this->url=='/editSanPham'){
            if(isset($_FILES["img"])&&$_FILES['img']['error']===0){
                $file_dir='image/';
                $file_name=$file_dir. basename($_FILES["img"]["name"]);
                $imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);
                $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
                $maxfilesize   = 800000;
                if(getimagesize($_FILES["img"]["tmp_name"])&&!file_exists($file_name)&&$_FILES["img"]["size"] <= $maxfilesize&&in_array($imageFileType,$allowtypes )&&move_uploaded_file($_FILES["img"]["tmp_name"], $file_name)){
                    $controlSanPham = new ModelSanPham($this->db);
                    $controlSanPham->fillSanPham($_POST,$file_name);
                    if($controlSanPham->checkErrors()){
                        $controlSanPham->addSanPham()&&redirect(BASE_URL_PATH.'admin?maDM=all&tenDM=all&page=');
                    }
                    $this->errors = $controlSanPham->getErrors();
                }
            }
        } 
    }
    public function deleteSanPham(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->url=='/admin'){
            $controlSanPham = new ModelSanPham($this->db);
            $controlHang = new ModelHangTrongGio($this->db);
            return $controlHang->removeSanPham($_POST)&&$controlSanPham->removeSanPham($_POST)&&redirect(BASE_URL_PATH.'admin?maDM=all&tenDM=all&page=');
        }
    }
}