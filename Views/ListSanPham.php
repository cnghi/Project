<div class="container-fluid">

    <div class='row'> 
        <div class='col-2 nav-css'>
            <nav >
                <div class="link-css p-3"><a href="<?='ListSanPham?maDM=all&tenDM=all&page='?>" >Tất cả sản phẩm</a></div>
                <?php foreach ($allDanhMuc as $DanhMuc):?>
                        <div class="link-css  p-3"><a href="<?='ListSanPham?maDM='.$DanhMuc->id.'&tenDM='.$DanhMuc->tenDM."&page="?>" ><?=htmlspecialchars($DanhMuc->tenDM)?></a></div>
                    <?php endforeach?>
                </nav>
        </div>
        <div class="col-10 row">
            <?php foreach($allSanPham as $SanPham):?>
                <div class="card col-4" style="width: 23rem;">
                    <img src="<?=htmlspecialchars($SanPham->img)?>" class="card-img-top img-css" />
                    <div class="card-body">
                        <h4 class="card-title"><?=htmlspecialchars($SanPham->tenSP)?></h4>
                        <p class="card-text"></p>
                        <a href="<?='chiTietSanPham?maSP='.$SanPham->id.'&tenSP'.$SanPham->tenSP?>" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div> 
            <?php endforeach?>
            <div class='col-12 row justify-content-center'>
                    <?php for($i=1;$i<=$soTrang;$i++):?>
                        <a href="<?='ListSanPham?maDM='.$maDM.'&tenDM='.$tenDM."&page=".$i?>" class='p-2'><?=htmlspecialchars($i)?></a>
                        <?php endfor?>
                    </div>
        </div>
    </div>
</div>