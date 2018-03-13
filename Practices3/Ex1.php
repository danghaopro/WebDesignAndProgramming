<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercises 1</title>
  </head>
  <body>
    <h1>Nguyễn Đăng Hào - 20155470</h1>
    <h4>Variable</h4>
    <?php
      $var = 0;
      if (empty($var)) {
        echo "<br>1. Var is either 0 or not at all set";
      }
      if (!isset($var)) {
        echo "<br>2. The Var is not set at all";
      }
      $var ="";
      if (empty($var)) {
        echo "<br>3.Var is either 0 or not at all set";
      }
      $var ="123";
      if (empty($var)) {
        echo "<br>4. Var is either 0 or not at all set";
      }
      unset($var);
      if (isset($var) == false) {
        echo "<br>5. Var is not set or unset().";
      } else {
        echo "<br>5. Var’value is $var";
      }
      if (empty($var)) {
        echo "<br>6. Var is either 0 or not at all set";
      }
    ?>

  </body>
</html>
