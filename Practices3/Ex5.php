<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercises 5</title>
  </head>
  <body>
    <h1>Nguyễn Đăng Hào - 20155470</h1>
    <table border="1" style="border-collapse: collapse;" width="50%">
      <tr>
        <th>STT</th>
        <th>Tên sách</th>
        <th>Nội dung sách</th>
      </tr>
      <?php
        for ($i = 1; $i <= 100; $i++) {
          echo "<tr>";
          echo "<td>{$i}</td>";
          echo "<td>Tensach{$i}</td>";
          echo "<td>Noidung{$i}</td>";
          echo "</tr>";
        }
      ?>
    </table>
  </body>
</html>
