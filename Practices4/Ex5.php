<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 5</title>
        <style media="screen">
            div.main {
                width: 500px;
                margin: auto;
            }
            div.header {
                text-align: center;
                background-color: #f4c242;
            }
            div.footer {
                background-color: #fcfa74;
            }
            div.footer table {
                margin: auto;
            }
        </style>
    </head>
    <body>
        <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $old = $_POST['old'];
            $new = $_POST['new'];
            $price = $_POST['price'];
            if (is_numeric($old) && is_numeric($new) && is_numeric($price)) {
                $total = ($new - $old) * $price;
            } else {
                $total = 'ERORR: Not a Number!';
            }
        } else {
            $name = '';
            $old = 0;
            $new = 0;
            $price = 2000;
            $total = 0;
        } ?>
        <div class="main">
            <div class="header">
                <h1>Nguyễn Đăng Hào - 20155470</h1>
                Thanh toán tiền điện
            </div>
            <div class="footer">
                <table>
                    <form action="Ex5.php" method="post" name="form">
                        <tr>
                            <td width="50%">Tên chủ hộ:</td>
                            <td width="50%">
                                <input type="text" name="name" value="<?php echo $name; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Chỉ số cũ:</td>
                            <td>
                                <input type="text" name="old" value="<?php echo $old; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Chỉ số mới:</td>
                            <td>
                                <input type="text" name="new" value="<?php echo $new; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Đơn giá:</td>
                            <td>
                                <input type="text" name="price" value="<?php echo $price; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Chỉ số mới:</td>
                            <td>
                                <input type="text" name="total" value="<?php echo $total; ?>" disabled>
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
