<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Exercises 8</title>
  <link href="Ex6.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div id="wrap">
    <div id="header">
      <div id="header-tabs">
        <ul>
          <li id="current"><a href="#"><span>Tab1</span></a></li>
          <li><a href="#"><span>Tab2</span></a></li>
          <li><a href="#"><span>Tab3</span></a></li>
          <li><a href="#"><span>Tab4</span></a></li>
          <li><a href="#"><span>Tab5</span></a></li>
          <li><a href="#"><span>Tab6</span></a></li>
          <li><a href="#"><span>Tab7</span></a></li>
          <li><a href="#"><span>Tab8</span></a></li>
        </ul>
        --> Đây là TabMenu
      </div>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Nguyễn Đăng Hào - 20155470</p>
    </div>
    <div id="content-wrap">
      <div align=center style="font-family: Times New Roman;">
        <h1 style="color: red;">HÓA ĐƠN BÁN HÀNG</h1>
        <form method="POST">
        <table border=2 style="color: blue; border-collapse: collapse;">
          <tr>
            <td>Mua</td>
            <td>STT</td>
            <td>Tên sản phẩm</td>
            <td>Đơn giá</td>
            <td>Số lượng</td>
            <td>Thành tiền</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="cb1"></td>
            <td>1</td>
            <td>Sách tin học cơ bản</td>
            <td>15000</td>
            <td><input type="text" name="sl1"></td>
            <td><input type="text" name="tt1" value="0"></td>
          </tr>
          <tr>
            <td><input type="checkbox" name="cb1"></td>
            <td>2</td>
            <td>Sách Word</td>
            <td>15000</td>
            <td><input type="text" name="sl2"></td>
            <td><input type="text" name="tt2" value="0"></td>
          </tr>
          <tr>
            <td><input type="checkbox" name="cb1"></td>
            <td>3</td>
            <td>Sách PowerPoint</td>
            <td>15000</td>
            <td><input type="text" name="sl3"></td>
            <td><input type="text" name="tt3" value="0"></td>
          </tr>
          <tr>
            <td><input type="checkbox" name="cb1"></td>
            <td>4</td>
            <td>USB KingStone 2G</td>
            <td>120000</td>
            <td><input type="text" name="sl4"></td>
            <td><input type="text" name="tt4" value="0"></td>
          </tr>
          <tr>
            <td colspan="4">
              <input type="reset" value="Nhập lại">
            </td>
            <td>Tổng cộng</td>
            <td><input type="text" name="total" value="0"></td>
          </tr>
        </table>
      </form>
      </div>
    </div>
    <div id="footer">
      <p align="center">--> Đây là Footer </p>
    </div>
  </div>

</body>

</html>
