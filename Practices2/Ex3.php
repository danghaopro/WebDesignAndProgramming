<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercises 3</title>
  </head>
  <body>
    <h1>Nguyễn Đăng Hào - 201554470</h1>
    <h4>Constant</h4>
    <?php
      define("pi",3.14);
      //define("hrs",8);
      function Test(){
        if(defined("pi")) {
          echo "<br>pi :=" . pi;
        } else {
          echo "<br>pi not defined";
        }
        if(defined("hrs")) {
          echo "<br>hrs :=" . hrs;
        } else {
          echo "<br>hrs not defined";
        }
      }
      Test();
    ?>

  </body>
</html>
