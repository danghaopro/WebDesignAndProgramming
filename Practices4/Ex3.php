<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 3</title>
        <style media="screen">
            input.text {
                width: 300px;
            }
        </style>
    </head>
    <body align="center">
        <h1>Nguyễn Đăng Hào - 20155470</h1>
        <h3>PHÉP TÍNH TRÊN HAI SỐ</h3>
        <div align="center">
            <table>
                <form method="post">
                    <tr>
                        <td style="text-align: right;">Chọn phép tính:</td>
                        <td>
                            <input class="radio" type="radio" name="pheptinh" value="add" checked>&nbsp;Cộng
                            <input class="radio" type="radio" name="pheptinh" value="sub">&nbsp;Trừ
                            <input class="radio" type="radio" name="pheptinh" value="mul">&nbsp;Nhân
                            <input class="radio" type="radio" name="pheptinh" value="div">&nbsp;Chia
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Số thứ nhất:</td>
                        <td>
                            &nbsp;<input class="text" type="text" name="first" value="">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Số thứ hai:</td>
                        <td>
                            &nbsp;<input class="text" type="text" name="second" value="">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            &nbsp;<input class="submit" type="submit" name="submit" value="OK">
                        </td>
                    </tr>
                </form>
            </table>
        </div>
        <?php
        if (isset($_POST['submit'])) :
            $pheptinh = $_POST['pheptinh'];
            $first = $_POST['first'];
            $second = $_POST['second'];
            $pheptinhs = array('add' => 'Cộng', 'sub' => 'Trừ', 'mul' => 'Nhân', 'div' => 'Chia');
            switch ($pheptinh) {
                case 'add':
                    $result = $first + $second;
                    break;
                case 'sub':
                    $result = $first - $second;
                    break;
                case 'mul':
                    $result = $first * $second;
                    break;
                case 'div':
                    $result = $second == 0 ? 'ERORR: chia cho 0!' : ($first + $second);
                    break;
            }
            if (!is_numeric($first) || !is_numeric($second)) {
                echo "ERROR: Input not a Number!<br>";
                echo '<a href="javascript:window.history.back(-1);">Quay lại</a>';
                exit();
            } ?>
            <hr>
            <h3>KẾT QUẢ PHÉP TÍNH</h3>
            <div align="center">
                <table>
                    <tr>
                        <td style="text-align: right;">Chọn phép tính:</td>
                        <td>
                            &nbsp;<?php echo $pheptinhs[$pheptinh]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Số thứ nhất:</td>
                        <td>
                            &nbsp;<input class="text" type="text" name="first" value="<?php echo $first; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Số thứ hai:</td>
                        <td>
                            &nbsp;<input class="text" type="text" name="first" value="<?php echo $second; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Kết quả:</td>
                        <td>
                            &nbsp;<input class="text" type="text" name="first" value="<?php echo $result; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            &nbsp;<a href="javascript:window.history.back(-1);">Quay lại</a>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
    </body>
</html>
