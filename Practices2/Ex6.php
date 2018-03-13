<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercises 6</title>
  </head>
  <body>
    <h1>Nguyễn Đăng Hào - 201554470</h1>
    <h4>ELSEIF Statement</h4>
    <?php
      $b = true;
      $j = 3;
      if ($j > 3) {
	      echo "result is true";
      } elseif ($j == 0) {
        $j++;
        echo "result is $j";
      } else {
        $j--;
        echo "result is ". $j--;
      }
    ?>
  </body>
</html>
