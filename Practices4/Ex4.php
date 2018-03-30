<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 4</title>
        <style media="screen">
            div.main {
                width: 500px;
                margin: auto;
            }
            div.header {
                text-align: center;
                background-color: #f4c242;
                margin: auto;
            }
            div.footer {
                background-color: #fcfa74;
                margin: auto;
            }
            div.footer table {
                margin: auto;
            }
        </style>
    </head>
    <body>
        <?php
        if (isset($_POST['submit'])) {
            define("PI", 3.14);
            $r = $_POST['r'];
            if (is_numeric($r)) {
                $S = PI * $r * $r;
                $c = 2 * PI * $r;
            } else {
                $S = 0;
                $c = 0;
            }
        } else {
            $r = 0;
            $S = 0;
            $c = 0;
        } ?>
        <div class="main">
            <div class="header">
                <h1>Nguyễn Đăng Hào - 20155470</h1>
                Diện tích và chu vi hình tròn
            </div>
            <div class="footer">
                <table>
                    <form action="Ex4.php" method="post" name="form">
                        <tr>
                            <td width="50%">Bán kính:</td>
                            <td width="50%">
                                <input type="text" name="r" value="<?php echo $r; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Diện tích:</td>
                            <td>
                                <input type="text" name="S" value="<?php echo $S; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Chu vi:</td>
                            <td>
                                <input type="text" name="c" value="<?php echo $c; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Tính" name="submit">
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </body>
</html>
