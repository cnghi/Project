<?php
namespace App\Model;
class ModelUser{
    private $db;
    public  $id;
    public  $taikhoan;
    public  $matkhau;
    public  $hoten;
    public  $email;
    public  $sdt;
    public  $diachi;
    private  $user_type;
    private $errors = [];

    public function __construct($pdo)
	{
        $this->db = $pdo;
	}
    public function getUserType(){
        return $this->user_type;
    }
    public function checkUser(){
        if(!$this->taikhoan){
            return false;
        }
        if(!$this->matkhau){
            return false;
        }
        return true;
    }
    public function getUsertheoTaiKhoan($User){
        $statement = $this->db->prepare('select * from nguoidung where taikhoan like :taikhoan and matkhau like :matkhau');
        $statement->execute(['taikhoan'=>$User['taikhoan'],'matkhau'=>$User['matkhau']]);
        if($row = $statement->fetch()){
            $this->fillFromUser($row);
        }
        return $this;
    }
    public function findUsertheoTaiKhoan($taikhoan){
        $statement = $this->db->prepare('select * from nguoidung where taikhoan like :taikhoan');
        $statement->execute(array('taikhoan'=>$taikhoan));
        if($row = $statement->fetch()){
            $this->fillFromUser($row);
        }
        return isset($this->id);
    }
    protected function fillFromUser(array $row)
	{
		[
			'id' => $this->id,
			'taikhoan' => $this->taikhoan,
			'matkhau' => $this->matkhau,
            'hoten' => $this->hoten,
            'email'=> $this->email,
            'sdt'=> $this->sdt,
            'diachi'=>$this->diachi,
            'user_type' => $this->user_type
		] = $row;
		return $this;
	}
    public function getErrors(){
        return $this->errors;
    }
    public function checkErrors(){
        if (!$this->hoten) {
			$this->errors['hoten'] = 'Họ và Tên không được trống.';
		}
		if (strlen($this->sdt) < 10 || strlen($this->sdt) > 11) {
			$this->errors['sdt'] = 'Số điện thoại sai định dạng hoặc trống.';
		}
        if(!$this->taikhoan){
            $this->errors['taikhoan']='Tài khoản không được trống.';
        }
        if(!$this->matkhau){
            $this->errors['matkhau']='Mật khẩu không được trống.';
        }
        if(!$this->email){
            $this->errors['email']='Email không được trống';
        }
        if (!$this->diachi){
            $this->errors['diachi']= 'Địa chỉ không được trống';
        }
		return empty($this->errors);
    }
    public function fillUser($User){
        if(isset($User['taikhoan'])){
            $this->taikhoan = trim($User['taikhoan']);
        }
        if(isset($User['matkhau'])){
            $this->matkhau = trim($User['matkhau']);
        }
        if(isset($User['hoten'])){
            $this->hoten = trim($User['hoten']);
        }
        if(isset($User['diachi'])){
            $this->diachi = trim($User['diachi']);
        }
        if (isset($User['sdt'])) {
			$this->sdt = preg_replace('/\D+/', '', $User['sdt']);
		}
        if(isset($User['email'])){
            $this->email = trim($User['email']);
        }
        if(isset($User['diachi'])){
            $this->diachi = trim($User['diachi']);
        }
        if($this->findUsertheoTaiKhoan($this->taikhoan)){
            $this->errors['taikhoan']='Tài khoản đã tồn tại.';
        }
        return $this;
    }
    public function addUser(){
        $result = false;
            $statement = $this->db->prepare(
                'insert into nguoidung(taikhoan,matkhau,hoten,email,sdt,diachi,user_type) values(:taikhoan,:matkhau,:hoten,:email,:sdt,:diachi,:user_type);'
            );
            $result = $statement->execute([
                'taikhoan'=> $this->taikhoan,
                'matkhau'=> $this->matkhau,
                'hoten'=> $this->hoten,
                'email'=> $this->diachi,
                'sdt'=>$this->sdt,
                'diachi'=>$this->diachi,
                'user_type'=> 'user'
            ]);
            if ($result) {
                $this->id = $this->db->lastInsertId();
        }
        return $result;
    }
}