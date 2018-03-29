<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Exercises 11</title>
</head>
<body>
    <h1>Nguyễn Đăng Hào - 201554470</h1>
    <?php
    for ($i = 1; $i <= 200; $i++) {
        if ($i % 2 == 0) {// Chia het cho 2
            echo '<b style="color: red;">' . $i . '</b>';
        } else {
            echo '<i style="color: blue;">' . $i . '</i>';
        }
        if ($i % 10 == 0) {
            echo "<br>";
        }
    }
    ?>
</body>
</html>
