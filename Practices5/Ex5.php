<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Exercises 5</title>
    <style media="screen">
        body {
            background-color: #e0e0e0;
        }

        div.main {
            margin: auto;
            text-align: center;
            background-color: #00ff00;
        }

        div.tblSV {
            background-color: #ffcccc;
        }

        div.tblMH {
            background-color: #ccffcc;
        }

        div.tblKQ {
            background-color: #ccccff;
        }
    </style>
    <script language=JavaScript>
        function checkInput(id) {
            var inputID = document.getElementsByName("id" + id)[0];
            if (inputID != null && inputID.value == "") {
                alert("Invalid ID, Please enter ID");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <?php
    /* Submit Handle */
    $table = '';
    $action = '';
    $tbls = array('SV', 'MH', 'KQ');
    $acts = array('Ins', 'Upd', 'Del');
    $tables = array('SV' => "sinhvien", 'MH' => 'monhoc', 'KQ' => 'ketqua');
    $insertValue = array(
        'SV' => '(masv, username, password, hosv, tensv, gioitinh, ngaysinh, noisinh, diachi, makh, hocbong)',
        'MH' => '(mamh, tenmh, sotiet)',
        'KQ' => '(masv, mamh, diem)'
    );
    $inputIns = array(
        'SV' => array('id', 'user', 'pass', 'ho', 'ten', 'gt', 'ngs', 'ns', 'dc', 'kh', 'hb'),
        'MH' => array('id', 'name', 'num'),
        'KQ' => array('sv', 'mh', 'kq')
    );
    $inputUpd = array(
        'SV' => array(
            'username' => 'user',
            'password' => 'pass',
            'hosv' => 'ho',
            'tensv' => 'ten',
            'gioitinh' => 'gt',
            'ngaysinh' => 'ngs',
            'noisinh' => 'ns',
            'diachi' => 'dc',
            'makh' => 'kh',
            'hocbong' => 'hb'),
        'MH' => array(
            'tenmh' => 'name',
            'sotiet' => 'num'),
        'KQ' => array('diem' => 'kq')
    );
    function isSubmit()
    {
        global $table, $action, $tbls, $acts;
        foreach ($tbls as $tbl) {
            foreach ($acts as $act) {
                if (isset($_POST['sub' . $act . $tbl])) {
                    $table = $tbl;
                    $action = $act;
                    return true;
                }
            }
        }
        return false;
    }

    function Ins()
    {
        global $table, $con, $tables, $insertValue, $inputIns;
        $values = '';
        foreach ($inputIns[$table] as $value) {
            $values .= "'" . $_POST[$value . 'Ins' . $table] . "'";
            $values .= ', ';
        }
        $values = substr($values, 0, -2);
        $sql = "INSERT INTO {$tables[$table]} {$insertValue[$table]} VALUES ({$values})";
        echo $sql;
        // $con->query($sql);
    }

    function Upd()
    {
        global $table, $con, $tables, $insertValue, $inputUpd;
        $wheres = array(
            'SV' => array(
                'masv' => 'id'
            ),
            'MH' => array(
                'mamh' => 'id'
            ),
            'KQ' => array(
                'masv' => 'sv',
                'mamh' => 'mh'
            ),
        );
        $set = '';
        $where = '';
        foreach ($inputUpd[$table] as $key => $value) {
            $set .= "{$key} = '{$_POST[$value . 'Upd' . $table]}'";
            $set .= ', ';
        }
        $set = substr($set, 0, -2);
        foreach ($wheres[$table] as $key => $value) {
            $where .= "{$key} = '{$_POST[$value . 'Upd' . $table]}'";
            $where .= ' AND ';
        }
        $where = substr($where, 0, -5);
        $sql = "UPDATE {$tables[$table]} SET {$set} WHERE {$where}";
        echo $sql;
        // $con->query($sql);
    }

    function Del()
    {
        global $table, $con, $tables, $insertValue, $inputDel;
        $wheres = array(
            'SV' => array(
                'masv' => 'id'
            ),
            'MH' => array(
                'mamh' => 'id'
            ),
            'KQ' => array(
                'masv' => 'sv',
                'mamh' => 'mh'
            ),
        );
        $where = '';
        foreach ($wheres[$table] as $key => $value) {
            $where .= "{$key} = '{$_POST[$value . 'Del' . $table]}'";
            $where .= ' AND ';
        }
        $where = substr($where, 0, -5);
        $sql = "DELETE FROM {$tables[$table]} WHERE {$where}";
        echo $sql;
        // $con->query($sql);
    }
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
    if (isSubmit()) {
        switch ($action) {
            case 'Ins':
                Ins();
                break;
            case 'Upd':
                Upd();
                break;
            case 'Del':
                Del();
                break;
        }
    }
    ?>
    <div class="main">
        <h1>Nguyễn Đăng Hào - 20155470</h1>
        <table width="100%">
            <tr>
                <td>
                    <div class="tblSV">
                        <table width="100%" border="1" style="border-collapse: collapse;">
                            <tr>
                                <th colspan="4">SINHVIEN</th>
                            </tr>
                            <tr>
                                <td>
                                    <table style="text-align: left; margin: auto;" border="1">
                                        <tr>
                                            <td colspan="11" style="text-align: center;">SELECT</td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <th>MaSV</th>
                                            <th>User</th>
                                            <th>Pass</th>
                                            <th>Ho</th>
                                            <th>Ten</th>
                                            <th>Gioi tinh</th>
                                            <th>Ngay sinh</th>
                                            <th>Noi sinh</th>
                                            <th>Dia chi</th>
                                            <th>MaKH</th>
                                            <th>Hoc bong</th>
                                        </tr>
                                        <!-- mysql -->
                                        <?php if (isset($con)) {
                                            $result = $con->query('SELECT * FROM sinhvien');
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['masv']}</td>";
                                                    echo "<td>{$row['username']}</td>";
                                                    echo "<td>{$row['password']}</td>";
                                                    echo "<td>{$row['hosv']}</td>";
                                                    echo "<td>{$row['tensv']}</td>";
                                                    echo "<td>{$row['gioitinh']}</td>";
                                                    echo "<td>{$row['ngaysinh']}</td>";
                                                    echo "<td>{$row['noisinh']}</td>";
                                                    echo "<td>{$row['diachi']}</td>";
                                                    echo "<td>{$row['makh']}</td>";
                                                    echo "<td>{$row['hocbong']}</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='11'>Khong co du lieu</td></tr>";
                                            }
                                        } ?>
                                        <!-- mysql -->
                                    </table>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('InsSV')">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">INSERT</td>
                                            </tr>
                                            <tr>
                                                <td>ID:</td>
                                                <td>
                                                    <input type="text" name="idInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>User:</td>
                                                <td>
                                                    <input type="text" name="userInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pass:</td>
                                                <td>
                                                    <input type="text" name="passInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ho:</td>
                                                <td>
                                                    <input type="text" name="hoInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ten:</td>
                                                <td>
                                                    <input type="text" name="tenInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gioi tinh:</td>
                                                <td>
                                                    <input type="text" name="gtInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ngay sinh:</td>
                                                <td>
                                                    <input type="text" name="ngsInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Noi sinh:</td>
                                                <td>
                                                    <input type="text" name="nsInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dia chi:</td>
                                                <td>
                                                    <input type="text" name="dcInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaKH:</td>
                                                <td>
                                                    <input type="text" name="khInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hoc bong:</td>
                                                <td>
                                                    <input type="text" name="hbInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subInsSV" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('UpdSV');">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">UPDATE</td>
                                            </tr>
                                            <tr>
                                                <td>ID:</td>
                                                <td>
                                                    <input type="text" name="idUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>User:</td>
                                                <td>
                                                    <input type="text" name="userUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pass:</td>
                                                <td>
                                                    <input type="text" name="passUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ho:</td>
                                                <td>
                                                    <input type="text" name="hoUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ten:</td>
                                                <td>
                                                    <input type="text" name="tenUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gioi tinh:</td>
                                                <td>
                                                    <input type="text" name="gtUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ngay sinh:</td>
                                                <td>
                                                    <input type="text" name="ngsUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Noi sinh:</td>
                                                <td>
                                                    <input type="text" name="nsUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dia chi:</td>
                                                <td>
                                                    <input type="text" name="dcUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaKH:</td>
                                                <td>
                                                    <input type="text" name="khUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hoc bong:</td>
                                                <td>
                                                    <input type="text" name="hbUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subUpdSV" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('DelSV');">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">DELETE</td>
                                            </tr>
                                            <tr>
                                                <td>ID:</td>
                                                <td>
                                                    <input type="text" name="idDelSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subDelSV" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="tblMH">
                        <table width="100%" border="1" style="border-collapse: collapse;">
                            <tr>
                                <th colspan="4">MONHOC</th>
                            </tr>
                            <tr>
                                <td>
                                    <table style="text-align: left; margin: auto;" border="1">
                                        <tr>
                                            <td colspan="3" style="text-align: center;">SELECT</td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <th>Ma mon hoc</th>
                                            <th>Ten mon hoc</th>
                                            <th>So tiet</th>
                                        </tr>
                                        <!-- mysql -->
                                        <?php if (isset($con)) {
                                            $result = $con->query('SELECT * FROM monhoc');
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['mamh']}</td>";
                                                    echo "<td>{$row['tenmh']}</td>";
                                                    echo "<td>{$row['sotiet']}</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='3'>Khong co du lieu</td></tr>";
                                            }
                                        } ?>
                                        <!-- mysql -->
                                    </table>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('InsMH')">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">INSERT</td>
                                            </tr>
                                            <tr>
                                                <td>ID:</td>
                                                <td>
                                                    <input type="text" name="idInsMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ten:</td>
                                                <td>
                                                    <input type="text" name="nameInsMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>So tiet:</td>
                                                <td>
                                                    <input type="text" name="numInsMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subInsMH" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('UpdMH');">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">UPDATE</td>
                                            </tr>
                                            <tr>
                                                <td>ID:</td>
                                                <td>
                                                    <input type="text" name="idUpdMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ten:</td>
                                                <td>
                                                    <input type="text" name="nameUpdMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>So tiet:</td>
                                                <td>
                                                    <input type="text" name="numUpdMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subUpdMH" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('DelMH');">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">DELETE</td>
                                            </tr>
                                            <tr>
                                                <td>ID:</td>
                                                <td>
                                                    <input type="text" name="idDelMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subDelMH" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="tblKQ">
                        <table width="100%" border="1" style="border-collapse: collapse;">
                            <tr>
                                <th colspan="4">KETQUA</th>
                            </tr>
                            <tr>
                                <td>
                                    <table style="text-align: left; margin: auto;" border="1">
                                        <tr>
                                            <td colspan="3" style="text-align: center;">SELECT</td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <th>Ma sinh vien</th>
                                            <th>Ma mon hoc</th>
                                            <th>Diem</th>
                                        </tr>
                                        <!-- mysql -->
                                        <?php if (isset($con)) {
                                            $result = $con->query('SELECT * FROM ketqua');
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['masv']}</td>";
                                                    echo "<td>{$row['mamh']}</td>";
                                                    echo "<td>{$row['diem']}</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='3'>Khong co du lieu</td></tr>";
                                            }
                                        } ?>
                                        <!-- mysql -->
                                    </table>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('InsKQ')">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">INSERT</td>
                                            </tr>
                                            <tr>
                                                <td>MaSV:</td>
                                                <td>
                                                    <input type="text" name="svInsKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaMH:</td>
                                                <td>
                                                    <input type="text" name="mhInsKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Diem:</td>
                                                <td>
                                                    <input type="text" name="kqInsKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subInsKQ" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('UpdKQ');">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">UPDATE</td>
                                            </tr>
                                            <tr>
                                                <td>MaSV:</td>
                                                <td>
                                                    <input type="text" name="svUpdKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaMH:</td>
                                                <td>
                                                    <input type="text" name="mhUpdKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Diem:</td>
                                                <td>
                                                    <input type="text" name="kqUpdKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subUpdKQ" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('DelKQ');">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">DELETE</td>
                                            </tr>
                                            <tr>
                                                <td>MaSV:</td>
                                                <td>
                                                    <input type="text" name="svDelKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaMH:</td>
                                                <td>
                                                    <input type="text" name="mhDelKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subDelKQ" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <?php if (isset($con)) {
        $con->close();
    } ?>
</body>

</html>
