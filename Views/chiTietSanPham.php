    <a href="<?='ListSanPham?maDM='.$chiTietSanPham->iddm?>" class="btn"><< Trở về</a>
    <form action="" method='post'>
        <div class="row">
            <img src="<?=htmlspecialchars($chiTietSanPham->img)?>" class="card-img col-4" />
            <input type="hidden" name='maSP' id='maSP' value='<?=$chiTietSanPham->id?>'> 
            <div class="card-body col-8">
                <h4 class="card-title"><?=htmlspecialchars($chiTietSanPham->tenSP)?></h4>
                <p class="card-text">
                    <?=htmlspecialchars($chiTietSanPham->mota)?>
                </p>
                <p>
                    Tồn kho: <?=htmlspecialchars($chiTietSanPham->soluongSP)?>
                </p>
                <p class='card-coim'><?=htmlspecialchars($chiTietSanPham->giatien)?></p>
                <input type="number" name="soluong" min="1" max="<?=htmlspecialchars($chiTietSanPham->soluongSP)?>" value='1'>
                <button type='submit' class="btn btn-primary">Thêm vào giỏ hàng</button>
            </div>
        </div>
    </form>