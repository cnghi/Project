<?php
namespace App\Model;
class ModelHangTrongGio{
    private $db;
    public $id;
    public $tenSP; 
    public $img; 
    public $giatien;
    public $mota;
    public $iddm;
    public $soluongtonkho;
    public $soluongtronggio;

    public function __construct($pdo)
	{
        $this->db = $pdo;
	}
    public function getSanPhamTheoDanhMuc($idgh){
        $allSanPham = [];
        $k=1;
        $statement = $this->db->prepare('select sanpham.*, sptg.soluong from sanpham , sanphamtronggio as sptg where sanpham.id = sptg.maSP 
        and sptg.idgh=:idgh;');
        $statement->execute(array('idgh'=>$idgh));
        while($row = $statement->fetch()){
            $SanPham = new ModelHangTrongGio($this->db);
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
        'iddm'=>$this->iddm,
        'soluongSP'=>$this->soluongtonkho,
        'soluong'=>$this->soluongtronggio
    ] = $row;
    return $this;
}
public function removeSanPham($Data){
    $result = false;
        $statement = $this->db->prepare(
            'delete from sanphamtronggio where maSP =:id;'
        );
        $result = $statement->execute([
            'id'=>$Data['id']
        ]);
        return $result;
}
}