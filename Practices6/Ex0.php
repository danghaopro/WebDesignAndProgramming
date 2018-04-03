<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 0</title>
    </head>
    <body>
        <h1>Nguyễn Đăng Hào - 20155470</h1>
        <h4>Danh sách cán bộ</h4>
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
        $result = $con->query("SELECT * FROM canbo");
        $x = 0;
        while($row = $result->fetch_assoc()) {
            echo $x . "&nbsp;" . $row['hocb'] . "&nbsp;" . $row['tencb'] . ". &nbsp;" . $row['ngaysinh'] . "<br>";
            $x++;
        }
        ?>
    </body>
</html>
