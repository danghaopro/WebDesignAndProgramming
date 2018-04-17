<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 1</title>
    </head>
    <body>
        <h1>Nguyễn Đăng Hào - 20155470</h1>
        <?php
        $host = 'localhost';
        $user = 'root';
        $pass = '123456';
        $dbname = 'webdesignandprogramming';

        $con = new mysqli($host, $user, $pass);
        if ($con->connect_error) {
            echo "Không kết nối được MySQL Database";
            exit();
        }
        $con->set_charset('utf8');
        $con->select_db($dbname);
        $totalRows = 0;
        $stSQL = "SELECT * FROM sanpham";
        $result = $con->query($stSQL);
        $totalRows = $result->num_rows; ?>
        <h3>Tổng số sản phẩm tìm thấy: <?php echo $totalRows; ?></h3>
        <table>
            <tr>
                <th>Mã SP</th>
                <th>Tên SP</th>
                <th>Đơn giá</th>
            </tr>
            <?php
            if ($totalRows > 0):
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo "{$row['idsp']}"; ?></td>
                        <td><?php echo "{$row['tensanpham']}"; ?></td>
                        <td><?php echo "{$row['dongia']}"; ?></td>
                    </tr>
                <?php endwhile;
            else: ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <b>
                            <font color="#FF0000">
                                Không tìm thấy thông tin sản phẩm!
                            </font>
                        </b>
                    </td>
                </tr>
            <?php endif;
            $con->close(); ?>
        </table>
    </body>
</html>
