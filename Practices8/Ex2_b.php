<?php
session_start();
?>
<html>
<head><title>Result Page</title></head>
<body>
    <h1>Nguyễn Đăng Hào - 20155470</h1>
    <?php
    echo "Ten cua ban la <b>" . $_SESSION["name"] . "</b>";
    ?>

    <br>
    <b><a href=Ex2_c.php>Xóa SESSION</a></b>
</body>
</html>
