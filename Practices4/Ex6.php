<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 6</title>
        <style media="screen">
            div.main {
                width: 500px;
                margin: auto;
                background-color: #fc83bf;
            }
            div.header {
                text-align: center;
                background-color: #ef097c;
                margin: 5px;
            }
            div.footer {

            }
            div.footer table {
                margin: auto;
            }
        </style>
    </head>
    <body>
        <?php
        if (isset($_POST['submit'])) {
            $hk1 = $_POST['hk1'];
            $hk2 = $_POST['hk2'];
            if (is_numeric($hk1) && is_numeric($hk2)) {
                $dtb = ($hk1 + $hk2 * 2) / 3;
                $kq = $dtb >= 5 ? 'Được lên lớp' : 'Ở lại lớp';
                $xl = $dtb >= 8 ? 'Giỏi' : ($dtb >= 6.5 ? 'Khá' : ($dtb >= 5 ? 'Trung bình' : 'Yếu'));
            } else {
                $dtb = $kq = $xl = 'ERORR: Not a Number!';
            }
        } else {
            $hk1 = 0;
            $hk2 = 0;
            $dtb = '';
            $kq = '';
            $xl = '';
        } ?>
        <div class="main">
            <div class="header">
                <h1>Nguyễn Đăng Hào - 20155470</h1>
                Kết quả học tập
            </div>
            <div class="footer">
                <table>
                    <form action="Ex6.php" method="post" name="form">
                        <tr>
                            <td width="50%">Điểm HK1:</td>
                            <td width="50%">
                                <input type="text" name="hk1" value="<?php echo $hk1; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Điểm HK2:</td>
                            <td>
                                <input type="text" name="hk2" value="<?php echo $hk2; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Điểm trung bình:</td>
                            <td>
                                <input type="text" name="dtb" value="<?php echo $dtb; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Kết quả:</td>
                            <td>
                                <input type="text" name="kq" value="<?php echo $kq; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Xếp loại học lực:</td>
                            <td>
                                <input type="text" name="xl" value="<?php echo $xl; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Xem kết quả" name="submit">
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </body>
</html>
