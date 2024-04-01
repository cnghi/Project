<?php
namespace App\Controler;
use App\Model\ModelUser;
use App\Controler\controlGioHang;
class controlUser{
    public $db;
    public $url;
    public $errors=[];
    public function __construct($pdo)
	{
        $this->db = $pdo;
	}
    public function addUrl($URL){
        $this->url = $URL;
    }
    public function getErrors(){
        return $this->errors;
    }
    public function checkLogin(){
        $controlUser = new ModelUser($this->db);
        $controlGioHang = new controlGioHang($this->db);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->url=='/login'){
            $User = $controlUser->getUsertheoTaiKhoan($_POST);
            if($User->checkUser()){
                $_SESSION['id']=$User->id;
                $_SESSION['user_type']=$User->getUserType();
                $_SESSION['hoten']=$User->hoten;
                $_SESSION['idgh']=$controlGioHang->idGioHang($User->id);
                $this->errors['login']='';
                redirect(BASE_URL_PATH.'Home');
            }
            else{
                $this->errors['login']='Sai tài khoản hoặc mật khẩu';
            }    
        } 
    }
    public function registerUser(){
        $controlUser = new ModelUser($this->db);
        $controlGioHang = new controlGioHang($this->db);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->url=='/register'){
            $controlUser->fillUser($_POST);
            if($controlUser->checkErrors()){
                $controlUser->addUser()&&$controlGioHang->newGioHang($controlUser->id)&&redirect(BASE_URL_PATH .'login');
            }
            $this->errors=$controlUser->getErrors();
        } 
    }

    public function logoutUser(){
        if ($_SERVER['REQUEST_URI']=='/logout'&&isset($_SESSION['id'])){
            session_destroy()&&redirect(BASE_URL_PATH .'Home');
        }
    }
}