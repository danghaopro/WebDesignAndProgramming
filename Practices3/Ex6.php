<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Exercises 6</title>
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
      <div id="main">
        <h1>Thông tin cá nhân</h1>
        <form id="frm_info" name="frm_info" method="post" action="index.php" onsubmit="return CheckForm()">
          <table width="100%" border="0">
            <tr>
              <td width="40%">Họ và tên (*)</td>
              <td width="60%"><input name="txtname" type="text" id="textfield" tabindex="1" size="30" maxlength="50" /></td>
            </tr>
            <tr>
              <td>Email (*)</td>
              <td><input name="txtemail" type="text" id="email" tabindex="2" size="30" maxlength="50" /></td>
            </tr>
            <tr>
              <td>Điện thoại (*)</td>
              <td><input name="txtphone" type="text" id="phone" tabindex="2" size="30" maxlength="10" /></td>
            </tr>
            <tr>
              <td>Giới tính</td>
              <td>
                <input type="radio" name="rdbsex" id="radio" value="Nam" tabindex="3" />Nam
                <input type="radio" name="rdbsex" id="radio2" value="Nữ" tabindex="4" />Nữ </td>
            </tr>
            <tr>
              <td>Công việc hiện tại (*)</td>
              <td><input name="txtjob" type="text" id="textfield2" tabindex="2" size="30" maxlength="50" /></td>
            </tr>
            <tr>
              <td>Quê quán</td>
              <td>
                <select name="selhomeland" id="homeland" tabindex="5">
		          <option value="Hà Nội" selected="selected">Hà Nội</option>
        		  <option value="Huế">Huế</option>
		          <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                  <option value="Khác">Khác</option>
		        </select>
              </td>
            </tr>
            <tr>
              <td>Sở thích</td>
              <td>
                <input type="checkbox" name="ckb[]" value="Đi dã ngoại" tabindex="6" />Dã ngoại
                <input type="checkbox" name="ckb[]" value="Đi ăn" tabindex="7" />Ăn uống
                <input type="checkbox" name="ckb[]" value="Đi xem phim" tabindex="9" />Phim ảnh
                <input type="checkbox" name="ckb[]" value="Đi khiêu vũ" tabindex="10" />Khiêu vũ
                <br />
                <input type="checkbox" name="ckb[]" value="Đi dạo" tabindex="11" />Dạo bộ
                <input type="checkbox" name="ckb[]" value="Đi nghỉ mát" tabindex="12" />Nghỉ mát
                <input type="checkbox" name="ckb[]" value="Đi mua sắm" tabindex="13" />Mua sắm
                <input type="checkbox" name="ckb[]" value="Đi câu cá" tabindex="14" />Câu cá
              </td>
            </tr>
            <tr>
              <td>Mô tả thêm về bản thân</td>
              <td><textarea name="txtdetail" id="detail" cols="45" rows="5" tabindex="15"></textarea></td>
            </tr>
            <tr align="center">
              <td colspan="2">
                <p>
                  <input type="submit" name="submit" value="Đăng ký" tabindex="16" />
                </p>
                <p>Các trường đánh dấu (*) là bắt buộc phải điền và điền chính xác</p>
              </td>
            </tr>
          </table>
        </form>
      </div>
      <div id="sidebar">
        <h1>Đăng nhập</h1>
        <form name="frmlogin" method="post" id="frmlogin" action="log_exc.php">
          <p><strong>Tài khoản</strong>&nbsp <input name="txuser" type="text" class="textbox" maxlength="50" /></p>
          <p><strong>Mật khẩu</strong> &nbsp <input name="txpass" type="password" class="textbox" maxlength="50" /></p>
          <p align="center">
            <input name="login" class="loginbutton" value="Đăng nhập" type="submit" />
          </p>
        </form>
      </div>
    </div>
    <div id="footer">
      <p align="center">--> Đây là Footer </p>
    </div>
  </div>

</body>

</html>
