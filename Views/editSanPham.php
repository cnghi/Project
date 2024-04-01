<div>
    <div class="row justify-content-center">
        <h1 class='text-center col-12'>Thêm Sản Phẩm</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name='id' id='idS' value='<?=htmlspecialchars($maSP)?>'>
            <table>
                <tr>
                    <td>
                        <label for="tenSP">Tên sản phẩm :</label>
                    </td>
                    <td>
                        <input type="text" class='w-100' name='tenSP' id='tenSP'>
                    </td>
                    <td>
                        <?php if (isset($errors['tenSP'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['tenSP']) ?></strong>
                            </span>
                            <?php endif ?>
                        </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="img">Hình ảnh :</label>
                    </td>
                    <td>
                        <input type="file" name='img' id='img'>
                    </td>
                    <td>
                        <?php if (isset($errors['img'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['img']) ?></strong>
                            </span>
                            <?php endif ?>
                        </td>
                </tr>
                <tr>
                    <td>
                        <label for="giatien">Giá Bán :</label>
                    </td>
                    <td>
                        <input type="text" class='w-100' name='giatien' id='giatien'>
                    </td>
                    <td>
                        <?php if (isset($errors['giatien'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['giatien']) ?></strong>
                            </span>
                            <?php endif ?>
                        </td>
                </tr>
                <tr>
                    <td>
                        <label for="iddm">Danh mục :</label>
                    </td>
                    <td>
                        <select name="iddm" class='w-100' id="iddm">
                            <?php foreach($allDanhMuc as $DanhMuc):?>
                                <option value="<?= htmlspecialchars($DanhMuc->id)?>"><?=htmlspecialchars($DanhMuc->tenDM)?></option>
                            <?php endforeach?>
                        </select>
                    </td>
                    <td>
                        <?php if (isset($errors['iddm'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['iddm']) ?></strong>
                            </span>
                            <?php endif ?>
                        </td>
                </tr>
                <tr>
                    <td>
                        <label for="soluongSP">Số Lượng :</label>
                    </td>
                    <td>
                        <input type="number" class='w-100' name='soluongSP' id='soluongSP'>
                    </td>
                    <td>
                        <?php if (isset($errors['soluongSP'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['soluongSP']) ?></strong>
                            </span>
                            <?php endif ?>
                        </td>
                </tr>
                <tr>
                    <td>
                        <label for="mota">Mô tả :</label>
                    </td>
                    <td>
                        <textarea name="mota" id="mota" class='w-100' cols="30" rows="5"></textarea>
                    </td>
                    <td>
                            <?php if (isset($errors['mota'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['mota']) ?></strong>
                                </span>
                                <?php endif ?>
                            </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type='submit' class='btn btn-primary offset-5 col-7'>Thêm sản phẩm</button>
                    </td>
                </tr>
            </table>
        </form>
        <script>console.log('<?=$_POST['id']?>')</script>
    </div>
</div>