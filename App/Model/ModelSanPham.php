<?php
namespace App\Model;
class ModelSanPham{
    private $db;
    public $id;
    public $tenSP; 
    public $img; 
    public $giatien;
    public $mota;
    public $iddm;
    public $soluongSP;
    private $errors = [];

    public function __construct($pdo)
	{
        $this->db = $pdo;
	}
    public function countSanPhamTheoDanhMuc($iddm){
        return count($this->getSanPhamTheoDanhMuc($iddm));
    }
    public function countSanPham(){
        return count($this->getSanPham());
    }
    public function getErrors(){
        $this->errors;
    }
    public function checkErrors(){
        if (!$this->tenSP) {
			$this->errors['tenSP'] = 'Tến sản phẩm không được trống.';
		}
		if (!$this->img) {
			$this->errors['img'] = 'Hình ảnh sai định dạng hoặc trống.';
		}
        if(!$this->giatien){
            $this->errors['giatien']='Giá bán không được trống.';
        }
        if(!$this->iddm){
            $this->errors['iddm']='Danh mục không được trống.';
        }
        if(!$this->soluongSP){
            $this->errors['soluongSP']='số lượng không được trống';
        }
        if (!$this->mota){
            $this->errors['mota']= 'Mô tả không được trống';
        }
		return empty($this->errors);
    }
    public function fillSanPham($Data,$img){
        if(isset($Data['id'])){
            $this->id = trim($Data['id']);
        }
        if(isset($Data['tenSP'])){
            $this->tenSP = trim($Data['tenSP']);
        }
        if(isset($Data['iddm'])){
            $this->iddm = trim($Data['iddm']);
        }
        if (isset($Data['giatien'])) {
			$this->giatien = preg_replace('/\D+/', '', $Data['giatien']);
		}
        if (isset($Data['soluongSP'])) {
			$this->soluongSP = preg_replace('/\D+/', '', $Data['soluongSP']);
		}
        if(isset($img)){
            $this->img = trim($img);
        }
        if(isset($Data['mota'])){
            $this->mota = trim($Data['mota']);
        }
        return $this;
    }
    public function getSanPhamTheoTrangDanhMuc($iddm,$page){
        $allSanPham = [];
        $statement = $this->db->prepare('call xuatSP(:iddm,:batdau,:ketthuc);');
        $statement->execute([
            "iddm"=>$iddm,
            "batdau"=>($page-1)*9,
            "ketthuc"=>($page)*9
        ]);
        while($row = $statement->fetch()){
            $SanPham = new ModelSanPham($this->db);
            $SanPham->fillFromSanPham($row);
            $allSanPham[]=$SanPham;
        }
        return $allSanPham;
    }
    public function getChiTietSanPham($id){
        $statement = $this->db->prepare('SELECT * FROM sanpham where id = :maSP');
        $statement->execute(array('maSP'=>$id));
        if($row = $statement->fetch()){
            $this->fillFromSanPham($row);
        }
        return $this;
    }
    public function getSanPhamTheoDanhMuc($iddm){
        $allSanPham = [];
        $k=1;
        $statement = $this->db->prepare('SELECT * FROM sanpham where iddm = :iddm');
        $statement->execute(array('iddm'=>$iddm));
        while($row = $statement->fetch()){
            $SanPham = new ModelSanPham($this->db);
            $SanPham->fillFromSanPham($row);
            $allSanPham[$k] =$SanPham;
            $k++;
        }
        return $allSanPham;
    }
    public function getTrangSanPham($page){
        $allSanPham = [];
        $k=1;
        $statement = $this->db->prepare('call xuatAllSP(:batdau,:ketthuc); ');
        $statement->execute([
            "batdau"=>($page-1)*9,
            "ketthuc"=>($page)*9
        ]);
        while($row = $statement->fetch()){
            $SanPham = new ModelSanPham($this->db);
            $SanPham->fillFromSanPham($row);
            $allSanPham[$k] =$SanPham;
            $k++;
        }
        return $allSanPham;
    }
    public function getSanPham(){
        $allSanPham = [];
        $k=1;
        $statement = $this->db->prepare('SELECT * FROM sanpham');
        $statement->execute();
        while($row = $statement->fetch()){
            $SanPham = new ModelSanPham($this->db);
            $SanPham->fillFromSanPham($row);
            $allSanPham[$k] =$SanPham;
            $k++;
        }
        return $allSanPham;
    }
    protected function fillFromSanPham(array $row)
	{
		[
			'id'=>$this->id,
            'tenSP'=>$this->tenSP, 
            'img'=>$this->img, 
            'giatien'=>$this->giatien,
            'mota'=>$this->mota,
            'soluongSP'=>$this->soluongSP,
            'iddm'=>$this->iddm
		] = $row;
		return $this;
	}
    function addSanPham(){
        if(!$this->id){
            $result = false;
            $statement = $this->db->prepare(
                'insert into sanpham(tenSP,img,giatien,mota,soluongSP,iddm) values(:tenSP,:img,:giatien,:mota,:soluongSP,:iddm);'
            );
            $result = $statement->execute([
                'tenSP'=>$this->tenSP,
                'img'=>$this->img,
                'giatien'=>$this->giatien,
                'mota'=>$this->mota,
                'soluongSP'=>$this->soluongSP,
                'iddm'=>$this->iddm
            ]);
            if ($result) {
                $this->id = $this->db->lastInsertId();
            }
            return $result;
        }
        else{
            $result = false;
            $statement = $this->db->prepare(
                'update sanpham set tenSP = :tenSP,
                img = :img, giatien = :giatien, mota = :mota, soluongSP = :soluongSP,iddm = :iddm
                where id = :id'
            );
            $result = $statement->execute([
                'id'=>$this->id,
                'tenSP'=>$this->tenSP,
                'img'=>$this->img,
                'giatien'=>$this->giatien,
                'mota'=>$this->mota,
                'soluongSP'=>$this->soluongSP,
                'iddm'=>$this->iddm
            ]);
            return $result;
        }
    }
    public function removeSanPham($Data){
        $result = false;
            $statement = $this->db->prepare(
                'delete from sanpham where id =:id;'
            );
            $result = $statement->execute([
                'id'=>$Data['id']
            ]);
            return $result;
    }
}