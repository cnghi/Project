<hr>
<div>
    <div class='row justify-content-center'>
        <h1 class='col-12 text-center'>Đăng ký</h1>
        <form action="" method='post'>
        <table>
                <tr>
                    <td>
                        <label for="hoten">Họ và tên :</label>
                    </td>
                    <td>
                        <input type="text" class='w-100' name='hoten' id='hoten'>
                    </td>
                    <td>
                        <?php if (isset($errors['hoten'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['hoten']) ?></strong>
                            </span>
                            <?php endif ?>
                        </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="taikhoan">Tài khoản :</label>
                    </td>
                    <td>
                        <input type="text" class='w-100' name='taikhoan' id='taikhoan'>
                    </td>
                    <td>
                        <?php if (isset($errors['taikhoan'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['taikhoan']) ?></strong>
                            </span>
                            <?php endif ?>
                        </td>
                </tr>
                <tr>
                    <td>
                        <label for="matkhau">Mật khẩu :</label>
                    </td>
                    <td>
                        <input type="password" class='w-100' name='matkhau' id='matkhau'>
                    </td>
                    <td>
                        <?php if (isset($errors['matkhau'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['matkhau']) ?></strong>
                            </span>
                            <?php endif ?>
                        </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email :</label>
                    </td>
                    <td>
                        <input type="email" class='w-100' name='email' id='email'>
                    </td>
                    <td>
                        <?php if (isset($errors['email'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['email']) ?></strong>
                            </span>
                            <?php endif ?>
                        </td>
                </tr>
                <tr>
                    <td>
                        <label for="sdt">Sđt :</label>
                    </td>
                    <td>
                        <input type="text" class='w-100' name='sdt' id='sdt'>
                    </td>
                    <td>
                        <?php if (isset($errors['sdt'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['sdt']) ?></strong>
                            </span>
                            <?php endif ?>
                        </td>
                </tr>
                <tr>
                    <td>
                        <label for="diachi">Địa chỉ :</label>
                    </td>
                    <td>
                        <textarea name="diachi" id="diachi" cols="30" rows="5"></textarea>
                    </td>
                        <td>
                            <?php if (isset($errors['diachi'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['diachi']) ?></strong>
                                </span>
                                <?php endif ?>
                            </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type='submit' class='btn btn-primary offset-5 col-7'>Đăng ký</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<hr>