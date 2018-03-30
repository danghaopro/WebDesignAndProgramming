<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 8</title>
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
            $n = $_POST['n'];
            if (is_numeric($n)) {
                $count = 0;
                $result = '';
                for ($i = 2; $i <= $n; $i++) {
                    $dem = 0;
                    for ($j = 2; $j <= ($i / 2); $j++) {
                        if ($i % $j == 0) {
                            $dem++;
                        }
                    }
                    if ($dem == 0) {
                        $count++;
                        $result .= "{$i} ";
                    }
                }
                if ($count == 0) {
                    $result = "Không có số nguyên tố nào <= {$n}";
                } else if ($count == 1) {
                    $result .= " là số Nguyên tố";
                } else {
                    $result .= " là các số Nguyên tố";
                }
            } else {
                $result = 'ERORR: Not a Number!';
            }
        } else {
            $n = 0;
            $result = '';
        } ?>
        <div class="main">
            <div class="header">
                <h1>Nguyễn Đăng Hào - 20155470</h1>
                Tìm số nguyên tố
            </div>
            <div class="footer">
                <table>
                    <form action="Ex8.php" method="post" name="form">
                        <tr>
                            <td width="50%">Nhập N:</td>
                            <td width="50%">
                                <input type="text" name="n" value="<?php echo $n; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Các số nguyên tố <= N" name="submit">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="text" name="result" value="<?php echo $result; ?>" disabled size="30">
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </body>
</html>
