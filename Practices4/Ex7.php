<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Exercises 7</title>
        <style media="screen">
            div.main {
                width: 500px;
                margin: auto;
                background-color: #fc83bf;
            }
            div.header {
                text-align: center;
                background-color: #ef097c;
                margin: 5px;
            }
            div.footer {

            }
            div.footer table {
                margin: auto;
            }
        </style>
    </head>
    <body>
        <?php
        if (isset($_POST['submit'])) {
            $month = $_POST['month'];
            $year = $_POST['year'];
            if (is_numeric($month) && is_numeric($year)) {
                switch ($month) {
                    case 1:
                    case 3:
                    case 5:
                    case 7:
                    case 8:
                    case 10:
                    case 12:
                        $days = 31;
                        break;
                    case 4:
                    case 6:
                    case 9:
                    case 11:
                        $days = 30;
                        break;
                    default:
                        $days = 28;
                        break;
                }
                if ($month == 2) {
                    if ((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0)) {
                        $days++;
                    }
                }
                $result = "Tháng {$month} năm {$year} có {$days} ngày";
            } else {
                $result = 'ERORR: Not a Number!';
            }
        } else {
            $month = 4;
            $year = 2018;
            $result = '';
        } ?>
        <div class="main">
            <div class="header">
                <h1>Nguyễn Đăng Hào - 20155470</h1>
                Tính ngày trong tháng
            </div>
            <div class="footer">
                <table>
                    <form action="Ex7.php" method="post" name="form">
                        <tr>
                            <td width="50%">Tháng/năm:</td>
                            <td width="50%">
                                <input type="text" name="month" value="<?php echo $month; ?>" maxlength="4" size="1">
                                /
                                <input type="text" name="year" value="<?php echo $year; ?>" maxlength="4" size="1">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Xem kết quả" name="submit">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="text" name="result" value="<?php echo $result; ?>" disabled size="30">
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </body>
</html>
