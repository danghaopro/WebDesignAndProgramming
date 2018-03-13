<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercises 4</title>
  </head>
  <body>
    <h1>Nguyễn Đăng Hào - 20155470</h1>
    <?php
    $S = '<table style="background: #FEE0DA;"><tr>';
    for ($n = 2; $n < 6; $n++) {
      $S .= '<td><table border=1>';
      $S .= "<tr><td colspan=3> Bảng cửu chương  $n </td></tr>";
      for ($i = 1; $i <= 10; $i++) {
        $S .= "<tr><td> " . $n . "</td>";
        $S .= "<td> " . $i . "</td>";
        $S .= "<td> " . ($n * $i) . "</td></tr>";
      }
      $S .= "</table></td>";
    }
    $S .= '</tr></table>';
    echo $S;
    ?>

  </body>
</html>
