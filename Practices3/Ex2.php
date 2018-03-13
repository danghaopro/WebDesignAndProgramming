<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercises 2</title>
  </head>
  <body>
    <h1>Nguyễn Đăng Hào - 20155470</h1>
    <h4>Giai PT bac 2</h4>
    <?php
      $a = 1;  $b = 4;   $c = 1;
      $pt = "<b>" . $a ."x<sup>2 </sup>+ ". $b. "x + " .$c. " = 0 </b>";
      if ($a == 0) {
        echo "Đây là phương trình bậc nhất!";
      } else {
        $delta = $b * $b - 4 * $a * $c;
        if ($delta < 0) {
          printf ("Phương trình %s vô nghiệm!", $pt);
        } elseif ($delta == 0) {
          printf("Phương trình %s có một nghiệm kép x= %.2f", $pt, (-$b/(2*$a)));
        } else {
          $x1 = (-$b + sqrt($delta))/(2*$a);
          $x2 = (-$b - sqrt($delta))/(2*$a);
          printf("Phương trình %s có 2 nghiệm phân biệt:", $pt);
          printf("x1= %.2f và x2= %.2f", $x1, $x2);
        }
      }
    ?>

  </body>
</html>
