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
            echo "Khong ket noi duoc MySQL Database";
            exit();
        }
        $con->set_charset('utf8');
        $con->select_db($dbname);
        $totalRows = 0;
        $stSQL = "SELECT * FROM khoa";
        $result = $con->query($stSQL);
        $totalRows = $result->num_rows; ?>
        <h3>Tong so mau tin tim thay: <?php echo $totalRows; ?></h3>
        <table>
            <tr>
                <th><b>Mã khoa</b></th>
                <th><b>Tên khoa</b></th>
            </tr>
            <?php
            if ($totalRows > 0) {
                $i=0;
                while ($row = $result->fetch_assoc()) {
                    $i+=1; ?>
                    <tr valign="top">
                        <td><?php echo "{$row["makh"]}"; ?> </td>
                        <td ><?=$row["tenkhoa"]?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr valign="top">
                    <td >&nbsp;</td>
                    <td > <b><font face="Arial" color="#FF0000">
                        Khong tim thay thong tin khoa hoc!</font></b>
                    </td>
                </tr>
            <?php }
            $con->close(); ?>
        </table>
    </body>
</html>
