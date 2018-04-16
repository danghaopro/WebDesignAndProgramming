<?php ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php 
session_start();
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Untitled Document</title>
</head>

<body>
    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="800" height="37" align="center" valign="middle" bgcolor="#FFFFCC" style="font-size:18px; color:#FF0000 ">
                <?php
                if (isset($_SESSION["tensv"])) {
                    echo "Xin chào: " . $_SESSION["tensv"];
                    echo "<br>";
                    echo "<a href='Ex3_Logout.php'>Đăng xuất</a>";
                } else	{
                    echo "Bạn đã đăng xuất";
                    echo "<br>";
                    echo "<a href='Ex3_Login.php'>Đăng nhập</a>";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td height="49" valign="top">
                <form name="form1" method="post" action="">
                    <a href="#">
                        <div id="ht" name="b"></div>
                    </a>
                    <div align="center">
                        <input type="button" name="Button" value="Xem thông tin cá nhân" onClick="javascript:window.open('Ex3_Info.php','_self')">
                        <input type="button" name="Button" value="Đăng xuất" onClick="javascript:window.open('Ex3_Logout.php','_self')">
                    </div>
                </form>
            </td>
        </tr>
        <tr>
            <td height="346">&nbsp;</td>
        </tr>
    </table>
</body>

</html>
<?php ob_flush(); ?>