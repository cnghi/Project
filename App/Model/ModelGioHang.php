<?php
namespace App\Model;

class ModelGioHang{
    private $db;
    public $id;
    public $idnd;
    public $maSP;
    public $soluong;
    public function __construct($pdo)
	{
        $this->db = $pdo;
	}
    public function addGioHang($idnd){
        $result = false;
            $statement = $this->db->prepare(
                'insert into giohang (idnd) values(:idnd);'
            );
            $result = $statement->execute(array('idnd'=>$idnd));
            if ($result) {
                $this->maUser = $this->db->lastInsertId();
            }   
        return $result;
    }
    public function findGioHang($idnd){
        $statement = $this->db->prepare('select * from giohang where idnd = :idnd;');
        $statement->execute(array('idnd'=>$idnd));
        if($row = $statement->fetch()){
            $this->fillFromGioHang($row);
        }
        return $this->id;
    }
    public function addSanPhamVaoGio($Data){
        $result = false;
        if($this->findSPTrongGio($_POST['maSP'])){
            $statement = $this->db->prepare(
                'update sanphamtronggio set 
                soluong = soluong + :soluong
                where maSP = :maSP and idgh = :idgh'
            );
            $result = $statement->execute([
                'idgh'=>$_SESSION['idgh'],
                'maSP'=>$Data['maSP'],
                'soluong'=>$Data['soluong']
            ]);
        }
        else{
                $statement = $this->db->prepare(
                    'insert into sanphamtronggio values(:idgh,:maSP,:soluong);'
                );
                $result = $statement->execute([
                    'idgh'=>$_SESSION['idgh'],
                    'maSP'=>$Data['maSP'],
                    'soluong'=>$Data['soluong']
                ]);
            }
            return $result;
        }
    public function findSPTrongGio($maSP){
        $statement = $this->db->prepare('select * from sanphamtronggio where idgh = :idgh and maSP= :maSP');
        $statement->execute([
            'idgh'=>$_SESSION['idgh'],
            'maSP'=>$maSP
        ]);
        if($row = $statement->fetch()){
            $this->fillFromHang($row);
        }
        return isset($this->maSP);
    }
    protected function fillFromHang(array $row)
	{
		[
			'idgh' => $this->id,
			'maSP'=>$this->maSP,
            'soluong'=>$this->soluong
		] = $row;
		return $this;
	}
    protected function fillFromGioHang(array $row)
	{
		[
			'id' => $this->id,
			'idnd'=>$this->idnd
		] = $row;
		return $this;
	}
}