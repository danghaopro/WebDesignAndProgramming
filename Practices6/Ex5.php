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
            if (id == 'DelCB' || id == 'DelHP') {
                return confirm('Bạn có chắc chắn muốn xóa ' + inputID.value);
            }
            if (id == 'DelKQ') {
                var inputSV = document.getElementsByName("sv" + id)[0];
                var inputMH = document.getElementsByName("mh" + id)[0];
                if (inputSV.value == "" || inputMH.value == "") {
                    alert("Invalid ID, Please enter ID");
                    return false;
                }
                return confirm('Bạn có chắc chắn muốn xóa ' + inputSV.value + ' - ' + inputMH.value);
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
    $tbls = array('CB', 'HP', 'KQ');
    $acts = array('Ins', 'Upd', 'Del');
    $tables = array('CB' => "canbo", 'HP' => 'hocphan', 'KQ' => 'giangday');
    $insertValue = array(
        'CB' => '(macb, username, password, hocb, tencb, gioitinh, ngaysinh, noisinh, diachi, mavien, chucdanh)',
        'HP' => '(mahp, tenhp, khoiluong, loaigio)',
        'KQ' => '(macb, mamh, maky, malop, sosv)'
    );
    $inputIns = array(
        'CB' => array('id', 'user', 'pass', 'ho', 'ten', 'gt', 'ngs', 'ns', 'dc', 'kh', 'hb'),
        'HP' => array('id', 'name', 'num', 'type'),
        'KQ' => array('sv', 'mh', 'ky', 'lop', 'kq')
    );
    $inputUpd = array(
        'CB' => array(
            'username' => 'user',
            'password' => 'pass',
            'hocb' => 'ho',
            'tencb' => 'ten',
            'gioitinh' => 'gt',
            'ngaysinh' => 'ngs',
            'noisinh' => 'ns',
            'diachi' => 'dc',
            'mavien' => 'kh',
            'chucdanh' => 'hb'),
        'HP' => array(
            'tenhp' => 'name',
            'khoiluong' => 'num',
            'loaigio' => 'type'),
        'KQ' => array(
            'maky' => 'ky',
            'malop' => 'lop',
            'sosv' => 'kq'
        )
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
        // echo $sql;
        $con->query($sql);
        echo "<h1>Da them {$con->affected_rows} hang</h1>";
    }

    function Upd()
    {
        global $table, $con, $tables, $insertValue, $inputUpd;
        $wheres = array(
            'CB' => array(
                'macb' => 'id'
            ),
            'HP' => array(
                'mahp' => 'id'
            ),
            'KQ' => array(
                'macb' => 'sv',
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
        // echo $sql;
        $con->query($sql);
        echo "<h1>Da update {$con->affected_rows} hang</h1>";
    }

    function Del()
    {
        global $table, $con, $tables, $insertValue, $inputDel;
        $wheres = array(
            'CB' => array(
                'macb' => 'id'
            ),
            'HP' => array(
                'mahp' => 'id'
            ),
            'KQ' => array(
                'macb' => 'sv',
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
        // echo $sql;
        $con->query($sql);
        echo "<h1>Da xoa {$con->affected_rows} hang</h1>";
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
                                <th colspan="4">CANBO</th>
                            </tr>
                            <tr>
                                <td>
                                    <table style="text-align: left; margin: auto;" border="1">
                                        <tr>
                                            <td colspan="11" style="text-align: center;">SELECT</td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <th>MaCB</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>HoCB</th>
                                            <th>TenCB</th>
                                            <th>GioiTinh</th>
                                            <th>NgaySinh</th>
                                            <th>NoiSinh</th>
                                            <th>DiaChi</th>
                                            <th>MaVien</th>
                                            <th>ChucDanh</th>
                                        </tr>
                                        <!-- mysql -->
                                        <?php if (isset($con)) {
                                            $result = $con->query('SELECT * FROM canbo');
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['macb']}</td>";
                                                    echo "<td>{$row['username']}</td>";
                                                    echo "<td>{$row['password']}</td>";
                                                    echo "<td>{$row['hocb']}</td>";
                                                    echo "<td>{$row['tencb']}</td>";
                                                    echo "<td>{$row['gioitinh']}</td>";
                                                    echo "<td>{$row['ngaysinh']}</td>";
                                                    echo "<td>{$row['noisinh']}</td>";
                                                    echo "<td>{$row['diachi']}</td>";
                                                    echo "<td>{$row['mavien']}</td>";
                                                    echo "<td>{$row['chucdanh']}</td>";
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
                                    <form method="POST" onsubmit="return checkInput('InsCB')">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">INSERT</td>
                                            </tr>
                                            <tr>
                                                <td>MaCB:</td>
                                                <td>
                                                    <input type="text" name="idInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Username:</td>
                                                <td>
                                                    <input type="text" name="userInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Password:</td>
                                                <td>
                                                    <input type="text" name="passInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>HoCB:</td>
                                                <td>
                                                    <input type="text" name="hoInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TenCB:</td>
                                                <td>
                                                    <input type="text" name="tenInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>GioiTinh:</td>
                                                <td>
                                                    <input type="text" name="gtInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NgaySinh:</td>
                                                <td>
                                                    <input type="text" name="ngsInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NoiSinh:</td>
                                                <td>
                                                    <input type="text" name="nsInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DiaChi:</td>
                                                <td>
                                                    <input type="text" name="dcInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaVien:</td>
                                                <td>
                                                    <input type="text" name="khInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ChucDanh:</td>
                                                <td>
                                                    <input type="text" name="hbInsCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subInsCB" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('UpdCB');">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">UPDATE</td>
                                            </tr>
                                            <tr>
                                                <td>MaCB:</td>
                                                <td>
                                                    <input type="text" name="idUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Username:</td>
                                                <td>
                                                    <input type="text" name="userUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Password:</td>
                                                <td>
                                                    <input type="text" name="passUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>HoCB:</td>
                                                <td>
                                                    <input type="text" name="hoUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TenCB:</td>
                                                <td>
                                                    <input type="text" name="tenUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>GioiTinh:</td>
                                                <td>
                                                    <input type="text" name="gtUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NgaySinh:</td>
                                                <td>
                                                    <input type="text" name="ngsUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NoiSinh:</td>
                                                <td>
                                                    <input type="text" name="nsUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DiaChi:</td>
                                                <td>
                                                    <input type="text" name="dcUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaVien:</td>
                                                <td>
                                                    <input type="text" name="khUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ChucDanh:</td>
                                                <td>
                                                    <input type="text" name="hbUpdCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subUpdCB" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('DelCB');">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">DELETE</td>
                                            </tr>
                                            <tr>
                                                <td>MaCB:</td>
                                                <td>
                                                    <input type="text" name="idDelCB">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subDelCB" value="Submit">
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
                                <th colspan="4">HOCPHAN</th>
                            </tr>
                            <tr>
                                <td>
                                    <table style="text-align: left; margin: auto;" border="1">
                                        <tr>
                                            <td colspan="4" style="text-align: center;">SELECT</td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <th>MaHP</th>
                                            <th>TenHP</th>
                                            <th>KhoiLuong</th>
                                            <th>LoaiGio</th>
                                        </tr>
                                        <!-- mysql -->
                                        <?php if (isset($con)) {
                                            $result = $con->query('SELECT * FROM hocphan');
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['mahp']}</td>";
                                                    echo "<td>{$row['tenhp']}</td>";
                                                    echo "<td>{$row['khoiluong']}</td>";
                                                    echo "<td>{$row['loaigio']}</td>";
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
                                    <form method="POST" onsubmit="return checkInput('InsHP')">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">INSERT</td>
                                            </tr>
                                            <tr>
                                                <td>MaHP:</td>
                                                <td>
                                                    <input type="text" name="idInsHP">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TenHP:</td>
                                                <td>
                                                    <input type="text" name="nameInsHP">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>KhoiLuong:</td>
                                                <td>
                                                    <input type="text" name="numInsHP">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>LoaiGio:</td>
                                                <td>
                                                    <input type="text" name="typeInsHP">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subInsHP" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('UpdHP');">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">UPDATE</td>
                                            </tr>
                                            <tr>
                                                <td>MaHP:</td>
                                                <td>
                                                    <input type="text" name="idUpdHP">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TenHP:</td>
                                                <td>
                                                    <input type="text" name="nameUpdHP">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>KhoiLuong:</td>
                                                <td>
                                                    <input type="text" name="numUpdHP">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>LoaiGio:</td>
                                                <td>
                                                    <input type="text" name="typeUpdHP">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subUpdHP" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('DelHP');">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">DELETE</td>
                                            </tr>
                                            <tr>
                                                <td>MaHP:</td>
                                                <td>
                                                    <input type="text" name="idDelHP">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subDelHP" value="Submit">
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
                                <th colspan="4">GIANGDAY</th>
                            </tr>
                            <tr>
                                <td>
                                    <table style="text-align: left; margin: auto;" border="1">
                                        <tr>
                                            <td colspan="5" style="text-align: center;">SELECT</td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <th>MaCB</th>
                                            <th>MaMH</th>
                                            <th>MaKy</th>
                                            <th>MaLop</th>
                                            <th>SoSV</th>
                                        </tr>
                                        <!-- mysql -->
                                        <?php if (isset($con)) {
                                            $result = $con->query('SELECT * FROM giangday');
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['macb']}</td>";
                                                    echo "<td>{$row['mamh']}</td>";
                                                    echo "<td>{$row['maky']}</td>";
                                                    echo "<td>{$row['malop']}</td>";
                                                    echo "<td>{$row['sosv']}</td>";
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
                                                <td>MaCB:</td>
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
                                                <td>MaKy:</td>
                                                <td>
                                                    <input type="text" name="kyInsKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaLop:</td>
                                                <td>
                                                    <input type="text" name="lopInsKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SoSV:</td>
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
                                                <td>MaCB:</td>
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
                                                <td>MaKy:</td>
                                                <td>
                                                    <input type="text" name="kyUpdKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaLop:</td>
                                                <td>
                                                    <input type="text" name="lopUpdKQ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SoSV:</td>
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
                                                <td>MaCB:</td>
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
