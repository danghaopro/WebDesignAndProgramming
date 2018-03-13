<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercises 11</title>
  </head>
  <body>
    <?php
      for ($i = 1; $i <= 200; $i++) {
        if ($i % 2 == 0) {// Chia het cho 2
          echo '<b style="color: red;">' . $i . '</b><br>';
        } else {
          echo '<i style="color: blue;">' . $i . '</i><br>';
        }
      }
    ?>
  </body>
</html>
