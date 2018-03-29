<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercises 2</title>
  </head>
  <body>
    <h1>Nguyễn Đăng Hào - 201554470</h1>
    <h4>Scope of Variable</h4>
    <?php
      $a = 100;
      /* global scope */
      function Test()
      {
          global $a;
          $i = 10;
          $a += 10;
          echo "<br>a := $a";
          echo "<br>i := $i";
          /* reference to local scope variable */
      }
      Test();
      echo "<br>a := $a";
      $i = 1000;
      echo "<br>i := $i";
    ?>
  </body>
</html>
