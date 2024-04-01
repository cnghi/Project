<?php
namespace App\Controler;
use App\Model\ModelGioHang;
use App\Model\ModelHangTrongGio;
use App\Controler\controlUrl;
class controlGioHang{
    private $db;
    public function __construct($pdo)
	{
        $this->db = $pdo;
	}
    public function newGioHang($idnd){
        $controlGioHang = new ModelGioHang($this->db);
        return $controlGioHang->addGioHang($idnd);
    }
    public function idGioHang($idnd){
        $controlGioHang = new ModelGioHang($this->db);
        return $controlGioHang->findGioHang($idnd);
    }
    public function addSanPham($url){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $url=='/chiTietSanPham' && isset($_SESSION['id'])){
            $controlUrl = new controlURL($this->db);
            $controlGioHang = new ModelGioHang($this->db);
            $url=$controlUrl->back($_SERVER['HTTP_REFERER']);
            $controlGioHang->addSanPhamVaoGio($_POST)&&redirect(BASE_URL_PATH . $url);
        }
    }
    public function getGioHang(){
        if(isset($_SESSION['idgh'])){
            $controlHang= new ModelHangTrongGio($this->db);
            $allGioHang=$controlHang->getSanPhamTheoDanhMuc($_SESSION['idgh']);
            return $allGioHang;
        }
    }
}