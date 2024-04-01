<?php if(isset($_SESSION['id'])):?>
<?php if(isset($allGioHang)):?>
    <div>
        <?php foreach($allGioHang as $SanPham):?>
            <table>
                <tr>
                    <td>
                        <div class="m-4">
                            <input type="checkbox">
                        </div>
                    </td>
                    <td>
                        <div class='m-4'>
                            <div class="row">
                                <img src="<?=htmlspecialchars($SanPham->img)?>" class="card-img col-4" />
                                <input type="hidden" name='maSP' id='maSP' value='<?=$SanPham->id?>'> 
                                <div class="card-body col-8">
                                    <h4 class="card-title"><?=htmlspecialchars($SanPham->tenSP)?></h4>
                                    <p class="card-text">
                                        <?=htmlspecialchars($SanPham->mota)?>
                                    </p>
                                    <p>
                                        Tồn kho: <?=htmlspecialchars($SanPham->soluongtonkho)?>
                                    </p>
                                    <p class='card-coim'><?=htmlspecialchars($SanPham->giatien)?></p>
                                    <input type="number" name="soluong" min="1" max="<?=htmlspecialchars($SanPham->soluongtonkho)?>" value='<?=$SanPham->soluongtonkho>=$SanPham->soluongtronggio?htmlspecialchars($SanPham->soluongtronggio):htmlspecialchars($SanPham->soluongtonkho)?>'>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
        </table>
            <?php endforeach?>
            <button class="btn btn-primary col-12">Thanh Toán</button>
        </div>
        <?php else :?>
            <div>Bạn không có đơn hàng nào trong giỏ</div>
        <?php endif?>
<?php else :?>
    <div>Vui Lòng đăng nhập <a href="<?=BASE_URL_PATH.'login'?>">Đăng nhập</a></div>
<?php endif?>
