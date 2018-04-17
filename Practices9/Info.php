<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercises 3 - Student Infomation</title>
</head>
<body>
    <h1>Nguyễn Đăng Hào - 20155470</h1>
    <?php
    if (isset($_SESSION['idnv'])) {
        $idnv = $_SESSION['idnv'];
        $con = new mysqli('localhost', 'root', '123456');
        if ($con->connect_error) {
            echo 'Không kết nối được cơ sở dữ liệu';
            exit();
        }
        $con->set_charset('utf8');
        $con->select_db('webdesignandprogramming');
        $result = $con->query("SELECT tennv, idhd FROM nhanvien, hoadon WHERE nhanvien.idnv = hoadon.idnv AND nhanvien.idnv='{$idnv}'");
        ?>
        <table>
            <tr>
                <th>TenNV</th>
                <th>id_hd</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['tennv']}</td>";
                echo "<td>{$row['idhd']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="Logout.php">Đăng xuất</a>
    <?php } else {
        echo 'Bạn chưa đăng nhập';
    }
    ?>
</body>
</html>
