<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 3</title>
        <script language=JavaScript>
            function checkInput() {
                if (document.frmPHP.txtID.value == "") {
                    alert("Invalid ID, Please enter ID");
                    document.frmPHP.txtID.focus();
                    return false;
                }
                if (document.frmPHP.txtName.value == "") {
                    alert("Please enter Name");
                    document.frmPHP.txtName.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body>
        <h1>Nguyễn Đăng Hào - 20155470</h1>
        <table>
            <form name="frmPHP" method="post" action="Ex3.php" onsubmit="return checkInput();">
                <tr>
                    <th>
                        Please enter ID and Name to update
                    </th>
                </tr>
                <tr>
                    <td>ID:</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="txtID" size="25" maxlength="3" class="textbox">
                    </td>
                </tr>
                <tr>
                    <td>Name:</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="txtName" size="25" maxlength="50" class="textbox">
                    </td>
                </tr>
                <tr>
                    <td>Value:</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="txtValue" size="25" maxlength="50" class="textbox">
                    </td>
                </tr>
                <tr>
                    <td> <br>
                        <input type="submit" value="Submit" class="button" name="submit">
                        <input type="reset" value="Reset" class="button">
                    </td>
                </tr>
            </form>
        </table>
        <?php
        if (isset($_POST['submit'])) {
            echo "<h3>UPDATE sản phẩm</h3>";
            $host = 'localhost';
            $user = 'root';
            $pass = '123456';
            $dbname = 'webdesignandprogramming';

            $con = new mysqli($host, $user, $pass);
            if ($con->connect_error) {
                echo "Không kết nối được MySQL Database";
                exit();
            }
            $con->set_charset('utf8');
            $con->select_db($dbname);

            $txtID = $_POST["txtID"];
            $txtName = $_POST["txtName"];
            $txtValue = $_POST['txtValue'];
            $affectrow = 0;
            $sql = "UPDATE sanpham SET tensanpham = '{$txtName}', dongia = '{$txtValue}' WHERE idsp = '{$txtID}'";
            $result = $con->query($sql);
            if ($result) {
                $affectrow = $con->affected_rows;
            }
            $con->close();
            echo "Số sản phẩm đã update: {$affectrow}";
        } ?>
    </body>
</html>
