<?php
namespace App\Controler;
use App\Model\ModelDanhMuc;
use App\Model\ModelSanPham;
use App\Controler\controlSanPham;
use App\Controler\controlGioHang;
use App\Controler\controlUser;
use App\Controler\controlUrl;
class Router{
    public $db;   
    public function __construct($pdo)
	{
        $this->db = $pdo;
	}
    public function Router($Url){
        if($Url === '/'){
            exit(require_once '../Views/Home.php');
        }
        $controlUser = new controlUser($this->db);
        $ModelDanhMuc = new ModelDanhMuc($this->db);
        $allDanhMuc = $ModelDanhMuc->getDanhMuc();
        $controlSanPham = new controlSanPham($this->db);
        $controlGioHang = new controlGioHang($this->db);
        $controlUrl=new controlUrl($this->db);
        $makeUrl = $controlUrl->getUrl($Url);
        $maDM =isset($_REQUEST['maDM']) ?
        filter_var($_REQUEST['maDM']) : 'all';
        $page =isset($_REQUEST['page'])&&!empty($_REQUEST['page']) ?
        filter_var($_REQUEST['page']) : 1;
        $tenDM =isset($_REQUEST['tenDM']) ?
        filter_var($_REQUEST['tenDM']) : $ModelDanhMuc->getTenDM($maDM);
        $maSP =isset($_REQUEST['maSP']) ?
        filter_var($_REQUEST['maSP']) : -1;
        $controlSanPham->addURL($makeUrl);
        $controlUser->addURL($makeUrl);
        $controlUser->checkLogin();
        $controlUser->registerUser();
        $controlUser->logoutUser();
        $errors=$controlUser->getErrors();
        $controlGioHang->addSanPham($makeUrl);
        $allGioHang=$controlGioHang->getGioHang();
        $chiTietSanPham = $controlSanPham->chiTietSanPham($maSP);
        $controlSanPham->addNewSanPham();
        $errors=$controlSanPham->getErrors();
        $controlSanPham->deleteSanPham();
        if($maDM==='all'){
            $allSanPham = $controlSanPham->trangSanPham($page);
            $soTrang = $controlSanPham->soTrangSanPham($maDM);
        }
        else{
            $allSanPham =$controlSanPham->trangSanPhamDM($maDM,$page);
            $soTrang = $controlSanPham->soTrangSanPhamDM($maDM);            
        }
        require_once '../Views/'.$makeUrl.'.php';
    }
}