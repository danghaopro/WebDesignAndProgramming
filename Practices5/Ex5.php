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
            if (id == 'DelSV' || id == 'DelMH') {
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
    <script type="text/javascript" src="jquery-latest.js"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            $('#UpdSV').change(function() {
                var val = $("#UpdSV option:selected").text();
                var svid = $('#SV' + val + ' td#username').text();
                $('#userUpdSV').val($('#SV' + val + ' td#username').text());
                $('#passUpdSV').val($('#SV' + val + ' td#password').text());
                $('#hoUpdSV').val($('#SV' + val + ' td#hosv').text());
                $('#tenUpdSV').val($('#SV' + val + ' td#tensv').text());
                $('#gtUpdSV').val($('#SV' + val + ' td#gioitinh').text());
                $('#ngsUpdSV').val($('#SV' + val + ' td#ngaysinh').text());
                $('#nsUpdSV').val($('#SV' + val + ' td#noisinh').text());
                $('#dcUpdSV').val($('#SV' + val + ' td#diachi').text());
                $('#khUpdSV').val($('#SV' + val + ' td#makh').text());
                $('#hbUpdSV').val($('#SV' + val + ' td#hocbong').text());
            });
        });
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
        // echo $sql;
        $con->query($sql);
        echo "<h1>Da them {$con->affected_rows} hang</h1>";
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
        // echo $sql;
        $con->query($sql);
        echo "<h1>Da update {$con->affected_rows} hang</h1>";
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
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>HoSV</th>
                                            <th>TenSV</th>
                                            <th>GioiTinh</th>
                                            <th>NgaySinh</th>
                                            <th>NoiSinh</th>
                                            <th>DiaChi</th>
                                            <th>MaKhoa</th>
                                            <th>HocBong</th>
                                        </tr>
                                        <!-- mysql -->
                                        <?php if (isset($con)) {
                                            $result = $con->query('SELECT * FROM sinhvien');
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr id='SV{$row['masv']}'>";
                                                    echo "<td id='masv'>{$row['masv']}</td>";
                                                    echo "<td id='username'>{$row['username']}</td>";
                                                    echo "<td id='password'>{$row['password']}</td>";
                                                    echo "<td id='hosv'>{$row['hosv']}</td>";
                                                    echo "<td id='tensv'>{$row['tensv']}</td>";
                                                    echo "<td id='gioitinh'>{$row['gioitinh']}</td>";
                                                    echo "<td id='ngaysinh'>{$row['ngaysinh']}</td>";
                                                    echo "<td id='noisinh'>{$row['noisinh']}</td>";
                                                    echo "<td id='diachi'>{$row['diachi']}</td>";
                                                    echo "<td id='makh'>{$row['makh']}</td>";
                                                    echo "<td id='hocbong'>{$row['hocbong']}</td>";
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
                                                <td>MaSV:</td>
                                                <td>
                                                    <input type="text" name="idInsSV" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Username:</td>
                                                <td>
                                                    <input id="userInsSV" type="text" name="userInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Password:</td>
                                                <td>
                                                    <input id="passInsSV" type="text" name="passInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>HoSV:</td>
                                                <td>
                                                    <input id="hoInsSV" type="text" name="hoInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TenSV:</td>
                                                <td>
                                                    <input id="tenInsSV" type="text" name="tenInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>GioiTinh:</td>
                                                <td>
                                                    <input id="gtInsSV" type="text" name="gtInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NgaySinh:</td>
                                                <td>
                                                    <input id="ngsInsSV" type="text" name="ngsInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NoiSinh:</td>
                                                <td>
                                                    <input id="nsInsSV" type="text" name="nsInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DiaChi:</td>
                                                <td>
                                                    <input id="dcInsSV" type="text" name="dcInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaKhoa:</td>
                                                <td>
                                                    <input id="khInsSV" type="text" name="khInsSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>HocBong:</td>
                                                <td>
                                                    <input id="hbInsSV" type="text" name="hbInsSV">
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
                                                <td>MaSV:</td>
                                                <td>
                                                    <select id="UpdSV" name="idUpdSV">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT masv FROM sinhvien');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['masv']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Username:</td>
                                                <td>
                                                    <input id="userUpdSV" type="text" name="userUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Password:</td>
                                                <td>
                                                    <input id="passUpdSV" type="text" name="passUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>HoSV:</td>
                                                <td>
                                                    <input id="hoUpdSV" type="text" name="hoUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TenSV:</td>
                                                <td>
                                                    <input id="tenUpdSV" type="text" name="tenUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>GioiTinh:</td>
                                                <td>
                                                    <input id="gtUpdSV" type="text" name="gtUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NgaySinh:</td>
                                                <td>
                                                    <input id="ngsUpdSV" type="text" name="ngsUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NoiSinh:</td>
                                                <td>
                                                    <input id="nsUpdSV" type="text" name="nsUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DiaChi:</td>
                                                <td>
                                                    <input id="dcUpdSV" type="text" name="dcUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaKhoa:</td>
                                                <td>
                                                    <input id="khUpdSV" type="text" name="khUpdSV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>HocBong:</td>
                                                <td>
                                                    <input id="hbUpdSV" type="text" name="hbUpdSV">
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
                                                <td>MaSV:</td>
                                                <td>
                                                    <select id="DelSV" name="idDelSV">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT masv FROM sinhvien');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['masv']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
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
                                            <th>MaMH</th>
                                            <th>TenMH</th>
                                            <th>SoTiet</th>
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
                                                <td>MaMH:</td>
                                                <td>
                                                    <input type="text" name="idInsMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TenMH:</td>
                                                <td>
                                                    <input type="text" name="nameInsMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SoTiet:</td>
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
                                                <td>MaMH:</td>
                                                <td>
                                                    <input type="text" name="idUpdMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TenMH:</td>
                                                <td>
                                                    <input type="text" name="nameUpdMH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SoTiet:</td>
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
                                                <td>MaMH:</td>
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
                                            <th>MaSV</th>
                                            <th>MaMH</th>
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
                                                    <select id="UpdSV" name="svInsKQ">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT masv FROM sinhvien');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['masv']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaMH:</td>
                                                <td>
                                                    <select id="UpdSV" name="mhInsKQ">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT mamh FROM monhoc');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['mamh']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
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
                                                    <select id="UpdSV" name="svUpdKQ">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT masv FROM sinhvien');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['masv']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaMH:</td>
                                                <td>
                                                    <select id="UpdSV" name="mhUpdKQ">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT mamh FROM monhoc');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['mamh']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
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
                                                    <select id="UpdSV" name="svDelKQ">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT masv FROM sinhvien');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['masv']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MaMH:</td>
                                                <td>
                                                    <select id="UpdSV" name="mhDelKQ">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT mamh FROM monhoc');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['mamh']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
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
