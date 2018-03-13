<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Exercises 7</title>
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
      <h1 style="color: red;">PHIẾU ĐĂNG KÝ HỌC TIN HỌC</h1>
      <form method="POST">
      <table border=1 style="color: blue;">
        <tr>
          <td>Họ Tên</td>
          <td><input type="text" name="hoten"></td>
          <td>Điện thoại</td>
          <td><input type="text" name="dienthoai"></td>
        </tr>
        <tr>
          <td>Ngày sinh</td>
          <td><input type="text" name="ngaysinh"></td>
          <td>Nơi sinh</td>
          <td><input type="text" name="noisinh"></td>
        </tr>
        <tr>
          <td>Môn học</td>
          <td>
            <select name="monhoc">
              <option value="tin">Tin học căn bản</option>
              <option value="word">Word</option>
              <option value="excel">Excel</option>
              <option value="access">Access1</option>
              <option value="ppx">PowerPoint</option>
              <option value="webdesign">Thiết kế Web</option>
            </select>
          </td>
          <td>Ca học</td>
          <td>
            <select name="cahoc">
              <option value=ab"">AB</option>
              <option value=cj"">CJ</option>
              <option value=de"">DE</option>
              <option value="hi">HI</option>
              <option value="kl">KL</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Ngày</td>
          <td>
            <select name="ngay">
              <option value="246">Thứ 2, 4, 6</option>
              <option value="357">Thứ 3, 5, 7</option>
              <option value="all">Thứ 2, 3, 4, 5, 6, 7</option>
              <option value="cn">Chủ nhật</option>
            </select>
          </td>
          <td>Giờ</td>
          <td>
            <select name="gio">
              <option value="1">7h00 -> 11h00</option>
              <option value="2">7h30 -> 17h00</option>
              <option value="3">11h00 -> 13h00</option>
              <option value="4">13h00 -> 17h00</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Khai giảng</td>
          <td><input type="text" name="khaigiang"></td>
          <td>Kết thúc</td>
          <td><input type="text" name=ketthuc></td>
        </tr>
        <tr>
          <td colspan="2" align=center><input type="submit" value="Gửi"></td>
          <td colspan="2" align=center><input type="reset" value="Xóa"></td>
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
