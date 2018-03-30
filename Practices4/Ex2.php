<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 2</title>
    </head>
    <body>
        <h1>Nguyễn Đăng Hào - 20155470</h1>
        <table>
            <form action="Ex2.php" method="get">
                <tr>
                    <td>Province</td>
                    <td>
                        :&nbsp;
                        <select name="province">
                            <option value="HAN">Ha Noi</option>
                            <option value="HCM">Ho Chi Minh</option>
                            <option value="HUE">Hue</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Industry</td>
                    <td>
                        :&nbsp;
                        <select name="industry" multiple>
                            <option value="AUT">Automobile</option>
                            <option value="FOO">Foods</option>
                            <option value="ENG">Enginering</option>
                            <option value="GAR">Garment</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Submit" name="submit">
                    </td>
                </tr>
            </form>
        </table>
        <?php
        if (isset($_GET['submit'])):
            $Province = $_GET['province'];
            $Industry = $_GET['industry']; ?>
            <table>
                <tr>
                    <td>Province</td>
                    <td>:&nbsp;<?php echo $Province; ?></td>
                </tr>
                <tr>
                    <td>Industry</td>
                    <td>:&nbsp;<?php echo $Industry; ?></td>
                </tr>
            </table>
        <?php endif; ?>
    </body>
</html>
