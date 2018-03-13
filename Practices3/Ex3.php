<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercises 3</title>
  </head>
  <body>
    <h1>Nguyễn Đăng Hào - 20155470</h1>
    <?php
      $n = 6;
      $S = "<table border=1>";
      $S .= "<tr><td colspan=3> Bảng cửu chương  $n </td></tr>";
      for ($i = 1; $i <= 10; $i++) {
        $S .= "<tr><td> " . $n . "</td>";
        $S .= "<td> " . $i . "</td>";
        $S .= "<td> " . ($n * $i) . "</td></tr>";
      }
      $S .= "</table>";
      echo $S;
    ?>

  </body>
</html>
