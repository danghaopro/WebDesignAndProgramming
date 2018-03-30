<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 9</title>
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
            $bao = $_POST['bao'];
            $links = array('btt' => 'https://tuoitre.vn', 'btn' => 'https://thanhnien.vn', 'vnex' => 'https://vnexpress.net');
            $link = $links[$bao];
        } else {
            $link = "";
        } ?>
        <div class="main">
            <div class="header">
                <h1>Nguyễn Đăng Hào - 20155470</h1>
                Đọc báo trên mạng
            </div>
            <div class="footer">
                <table>
                    <form action="Ex9.php" method="post" name="form">
                        <tr>
                            <td width="50%">Chọn báo muốn đọc:</td>
                            <td width="50%">
                                <select name="bao">
                                    <option value="btt">Báo tuổi trẻ</option>
                                    <option value="btn">Báo thanh niên</option>
                                    <option value="vnex">Việt Nam Express</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Đến báo muốn đọc" name="submit">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <a href="<?php echo $link; ?>"><?php echo $link; ?></a>
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </body>
</html>
