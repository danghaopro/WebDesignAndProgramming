<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 4</title>
        <script language=JavaScript>
            function checkInput() {
                if (document.frmPHP.txtID.value=="") {
                    alert("Invalid ID, Please enter ID");
                    document.frmPHP.txtID.focus();
                    return false;
                }
                if (document.frmPHP.txtName.value=="") {
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
            <form name="frmPHP" method="post" action="Ex4.php" onsubmit="return checkInput();">
                <tr>
                    <td align="left" class="content-sm"><b>
                        Please enter ID and Name to update
                    </b></td>
                </tr>
                <tr>
                    <td align="left" >ID:</td>
                </tr>
                <tr>
                    <td align="left">
                        <input type="text" name="txtID" size="25" maxlength="3" class="textbox">
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top"> <br>
                        <input type="submit" value="Delete" class="button" name="submit">
                        <input type="reset" value="Reset" class="button">
                    </td>
                </tr>
            </form>
        </table>
        <?php
        if (isset($_POST['submit'])) {
            echo "<h3>Update khoa hoc</h3>";
            $host = 'localhost';
            $user = 'root';
            $pass = '123456';
            $dbname = 'webdesignandprogramming';

            $con = new mysqli($host, $user, $pass);
            if ($con->connect_error) {
                echo "Khong ket noi duoc MySQL Database";
                exit();
            }
            $con->set_charset('utf8');
            $con->select_db($dbname);

            $txtID = $_POST["txtID"];
            $affectrow = 0;
            $sql = "DELETE FROM khoa WHERE makh = '{$txtID}'";
            $result = $con->query($sql);
            if ($result) {
                $affectrow = $con->affected_rows;
            }
            $con->close();
            echo "So mau tin da xoa {$affectrow}";
        } ?>
    </body>
</html>
