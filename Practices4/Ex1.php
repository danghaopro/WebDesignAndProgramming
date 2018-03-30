<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 1</title>
    </head>
    <body>
        <h1>Nguyễn Đăng Hào - 20155470</h1>
        <table>
            <form action="Ex1.php" method="post">
                <tr>
                    <td>Name</td>
                    <td>:&nbsp;<input type="text" name="fullname"></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        :&nbsp;
                        <input type="radio" value="M" name="gender" checked> Male
                        <input type="radio" value="F" name="gender"> Female
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Submit"></td>
                </tr>
            </form>
        </table>
        <?php
        if (isset($_POST['submit'])):
            $Name = $_POST["fullname"];
            $Gender = $_POST["gender"]; ?>

            <table>
                <tr>
                    <td>Name</td>
                    <td>:&nbsp;<?php echo $Name; ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>:&nbsp;<?php echo $Gender; ?></td>
                </tr>
            </table>
        <?php endif; ?>
    </body>
</html>
