<?php ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php 
session_start();
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Untitled Document</title>
    <style type="text/css">
        div {
            font-size: 18px;
            color: #FF0000
        }
    </style>
</head>

<body>
    <form name="form1" method="post">
        <table width="800" border="1" align="center">
            <tr>
                <td colspan="2">
                    <div align="center">ĐĂNG NHẬP</div>
                </td>
            </tr>
            <tr>
                <td width="394">
                    <div align="right">Mã nhân viên:</div>
                </td>
                <td width="390">
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <td width="394">
                    <div align="right">Mật khẩu:</div>
                </td>
                <td width="390">
                    <input type="password" name="password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="Submit" value="Dang nhap">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center" id="tbao">
                    </div>
                </td>
            </tr>
        </table>
    </form>
    <hr size="2" align="center" color="#000066" width="600">
    <?php
	if (isset($_POST['Submit']) && $_POST["Submit"] == "Dang nhap" && $_POST["username"]) {
		$username = $_POST["username"];
		//Ket noi den MySQL
        $con = mysqli_connect("localhost", "root", "123456") or die("Khong the ket noi den Server");
		//Chon CSDL qlsinhvien
        mysqli_select_db($con, "webdesignandprogramming") or die("khong ket noi CSDL duoc");
		//Chon bang ma la unicode utf-8
		mysqli_query($con, "SET NAMES 'utf8'");
		//Thuc hien cau truy van
        $query = "SELECT * FROM nhanvien WHERE idnv='{$_POST['username']}' AND password='{$_POST['password']}'";
		$result = mysqli_query($con, $query);

		if (mysqli_num_rows($result) > 0) {
			//Dang nhap thanh cong luu ten sinh vien vao session
			$row = mysqli_fetch_assoc($result);
			$tennv = $row["tennv"];
			$_SESSION["idnv"] = $row['idnv'];
			$_SESSION["tennv"] = $tennv;
			header("Location:LoginResult.php");
		} else {
		    echo "<div align=center >Đăng nhập không thành công!<div>";
		}
		mysqli_close($con);
	}
    ?>
</body>

</html>
<?php ob_flush(); ?>