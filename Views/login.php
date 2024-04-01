<hr>
<div class='container mx-auto'>
    <div class='row justify-content-center'>
        <h1 class='col-12 text-center'>Đăng nhập</h1>
        <form action="" method='post'>
            <table>
                <tr>
                    <td>
                        <label for="taikhoan">Tài khoản :</label>
                    </td>
                    <td>
                        <input type="text" name='taikhoan' id='taikhoan'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="matkhau">Mật khẩu :</label>
                    </td>
                    <td>
                        <input type="password" name='matkhau' id='matkhau'>
                    </td>
                </tr>
                
                <?php if (isset($errors['login'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['login']) ?></strong>
                    </span>
                    <?php endif ?>
                
                <tr>
                    <td></td>
                    <td>
                        <button type='submit' class='btn btn-primary offset-5 col-7'>Đăng nhập</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<hr>