<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercises 1</title>
  </head>
  <body>
    <h1>Nguyễn Đăng Hào - 201554470</h1>
    <h4>Variable</h4>
    <?php
      $sotrang = 10;
      $record = 5;
      $check = true;
      $strSQL = "select * from tblCustomers";
      echo "$strSQL" . "<br>";
      echo '$strSQL' . '<br>';
      $myarrs= array("first", "last", "company");
      $myarrs[0] = "Number 0";
      $myarrs[1] = "Number 1";
      $myarrs[2] = "Number 2";
      echo $myarrs[1];
      echo "<br>";
      echo $myarrs[2];
    ?>

  </body>
</html>
