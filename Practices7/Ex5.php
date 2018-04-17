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
            if (id == 'DelKH' || id == 'DelNV' || id == 'DelHD') {
                return confirm('Bạn có chắc chắn muốn xóa ' + inputID.value);
            }
            return true;
        }
    </script>
    <script type="text/javascript" src="jquery-latest.js"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            $('#UpdHD').change(function() {
                var val = $("#UpdHD option:selected").text();
                $('#nlUpdHD').val($('#HD' + val + ' td#nl').text());
                $('#khUpdHD').val($('#HD' + val + ' td#kh').text());
                $('#nvUpdHD').val($('#HD' + val + ' td#nv').text());
                $('#ngUpdHD').val($('#HD' + val + ' td#ng').text());
                $('#ttUpdHD').val($('#HD' + val + ' td#tt').text());
            });
        });
    </script>
</head>

<body>
    <?php
    /* Submit Handle */
    $table = '';
    $action = '';
    $tbls = array('KH', 'NV', 'HD');
    $acts = array('Ins', 'Upd', 'Del');
    $tables = array('KH' => "khachhang", 'NV' => 'nhanvien', 'HD' => 'hoadon');
    $insertValue = array(
        'KH' => '(idkh, tenkh, dienthoai, diachi)',
        'NV' => '(idnv, password, tennv, dienthoai, diachi)',
        'HD' => '(idhd, ngaylaphd, idkh, idnv, ngaygiaohang, tongtien)'
    );
    $inputIns = array(
        'KH' => array('id', 'name', 'dt', 'dc'),
        'NV' => array('id', 'pass', 'name', 'dt', 'dc'),
        'HD' => array('id', 'nl', 'kh', 'nv', 'ng', 'tt')
    );
    $inputUpd = array(
        'KH' => array(
            'tenkh' => 'name',
            'dienthoai' => 'dt',
            'diachi' => 'dc'),
        'NV' => array(
            'password' => 'pass',
            'tennv' => 'name',
            'dienthoai' => 'dt',
            'diachi' => 'dc'),
        'HD' => array(
            'ngaylaphd' => 'nl',
            'idkh' => 'kh',
            'idnv' => 'nv',
            'ngaygiaohang' => 'ng',
            'tongtien' => 'tt'
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
            'KH' => array(
                'idkh' => 'id'
            ),
            'NV' => array(
                'idnv' => 'id'
            ),
            'HD' => array(
                'idhd' => 'id'
            ),
        );
        $set = '';
        $where = '';
        foreach ($inputUpd[$table] as $key => $value) {
            if ($_POST[$value . 'Upd' . $table] != '') {
                $set .= "{$key} = '{$_POST[$value . 'Upd' . $table]}'";
                $set .= ', ';
            }
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
            'KH' => array(
                'idkh' => 'id'
            ),
            'NV' => array(
                'idnv' => 'id'
            ),
            'HD' => array(
                'idhd' => 'id'
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
                                <th colspan="4">KHACHHANG</th>
                            </tr>
                            <tr>
                                <td>
                                    <table style="text-align: left; margin: auto;" border="1">
                                        <tr>
                                            <td colspan="4" style="text-align: center;">SELECT</td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <th>idkh</th>
                                            <th>tenkh</th>
                                            <th>dienthoai</th>
                                            <th>diachi</th>
                                        </tr>
                                        <!-- mysql -->
                                        <?php if (isset($con)) {
                                            $result = $con->query('SELECT * FROM khachhang');
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['idkh']}</td>";
                                                    echo "<td>{$row['tenkh']}</td>";
                                                    echo "<td>{$row['dienthoai']}</td>";
                                                    echo "<td>{$row['diachi']}</td>";
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
                                    <form method="POST" onsubmit="return checkInput('InsKH')">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">INSERT</td>
                                            </tr>
                                            <tr>
                                                <td>idkh:</td>
                                                <td>
                                                    <input type="text" name="idInsKH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>tenkh:</td>
                                                <td>
                                                    <input type="text" name="nameInsKH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>dienthoai:</td>
                                                <td>
                                                    <input type="text" name="dtInsKH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>diachi:</td>
                                                <td>
                                                    <input type="text" name="dcInsKH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subInsKH" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('UpdKH');">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">UPDATE</td>
                                            </tr>
                                            <tr>
                                                <td>idkh:</td>
                                                <td>
                                                    <select name="idUpdKH">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT idkh FROM khachhang');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['idkh']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>tenkh:</td>
                                                <td>
                                                    <input type="text" name="nameUpdKH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>dienthoai:</td>
                                                <td>
                                                    <input type="text" name="dtUpdKH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>diachi:</td>
                                                <td>
                                                    <input type="text" name="dcUpdKH">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subUpdKH" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('DelKH');">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">DELETE</td>
                                            </tr>
                                            <tr>
                                                <td>idkh:</td>
                                                <td>
                                                    <select name="idDelKH">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT idkh FROM khachhang');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['idkh']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subDelKH" value="Submit">
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
                                <th colspan="4">NHANVIEN</th>
                            </tr>
                            <tr>
                                <td>
                                    <table style="text-align: left; margin: auto;" border="1">
                                        <tr>
                                            <td colspan="5" style="text-align: center;">SELECT</td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <th>idnv</th>
                                            <th>password</th>
                                            <th>tennv</th>
                                            <th>dienthoai</th>
                                            <th>diachi</th>
                                        </tr>
                                        <!-- mysql -->
                                        <?php if (isset($con)) {
                                            $result = $con->query('SELECT * FROM nhanvien');
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['idnv']}</td>";
                                                    echo "<td>{$row['password']}</td>";
                                                    echo "<td>{$row['tennv']}</td>";
                                                    echo "<td>{$row['dienthoai']}</td>";
                                                    echo "<td>{$row['diachi']}</td>";
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
                                    <form method="POST" onsubmit="return checkInput('InsNV')">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">INSERT</td>
                                            </tr>
                                            <tr>
                                                <td>idnv:</td>
                                                <td>
                                                    <input type="text" name="idInsNV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>password:</td>
                                                <td>
                                                    <input type="text" name="passInsNV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>tennv:</td>
                                                <td>
                                                    <input type="text" name="nameInsNV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>dienthoai:</td>
                                                <td>
                                                    <input type="text" name="dtInsNV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>diachi:</td>
                                                <td>
                                                    <input type="text" name="dcInsNV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subInsNV" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('UpdNV');">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">UPDATE</td>
                                            </tr>
                                            <tr>
                                                <td>idnv:</td>
                                                <td>
                                                    <select name="idUpdNV">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT idnv FROM nhanvien');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['idnv']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>password:</td>
                                                <td>
                                                    <input type="text" name="passUpdNV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>tennv:</td>
                                                <td>
                                                    <input type="text" name="nameUpdNV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>dienthoai:</td>
                                                <td>
                                                    <input type="text" name="dtUpdNV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>diachi:</td>
                                                <td>
                                                    <input type="text" name="dcUpdNV">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subUpdNV" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('DelNV');">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">DELETE</td>
                                            </tr>
                                            <tr>
                                                <td>idnv:</td>
                                                <td>
                                                    <select name="idDelNV">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT idnv FROM nhanvien');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['idnv']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subDelNV" value="Submit">
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
                                <th colspan="4">HOADON</th>
                            </tr>
                            <tr>
                                <td>
                                    <table style="text-align: left; margin: auto;" border="1">
                                        <tr>
                                            <td colspan="8" style="text-align: center;">SELECT</td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <th>idhd</th>
                                            <th>ngaylaphd</th>
                                            <th>idkh</th>
                                            <th>tenkh</th>
                                            <th>idnv</th>
                                            <th>tennv</th>
                                            <th>ngaygiaohang</th>
                                            <th>tongtien</th>
                                        </tr>
                                        <!-- mysql -->
                                        <?php if (isset($con)) {
                                            $query = 'SELECT idhd, ngaylaphd, kh.idkh idkh, tenkh, nv.idnv idnv, tennv, ngaygiaohang, tongtien';
                                            $query .= ' FROM hoadon hd, khachhang kh, nhanvien nv';
                                            $query .= ' WHERE hd.idkh = kh.idkh AND hd.idnv = nv.idnv';
                                            $result = $con->query($query);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr id='HD{$row['idhd']}'>";
                                                    echo "<td id='id'>{$row['idhd']}</td>";
                                                    echo "<td id='nl'>{$row['ngaylaphd']}</td>";
                                                    echo "<td id='kh'>{$row['idkh']}</td>";
                                                    echo "<td id='tkh'>{$row['tenkh']}</td>";
                                                    echo "<td id='nv'>{$row['idnv']}</td>";
                                                    echo "<td id='tnv'>{$row['tennv']}</td>";
                                                    echo "<td id='ng'>{$row['ngaygiaohang']}</td>";
                                                    echo "<td id='tt'>{$row['tongtien']}</td>";
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
                                    <form method="POST" onsubmit="return checkInput('InsHD')">
                                        <table  style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">INSERT</td>
                                            </tr>
                                            <tr>
                                                <td>idhd:</td>
                                                <td>
                                                    <input type="text" name="idInsHD">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ngaylaphd:</td>
                                                <td>
                                                    <input type="text" name="nlInsHD">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>idkh:</td>
                                                <td>
                                                    <select name="khInsHD">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT idkh, tenkh FROM khachhang');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option value='{$row['idkh']}'>{$row['tenkh']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>idnv:</td>
                                                <td>
                                                    <select name="nvInsHD">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT idnv, tennv FROM nhanvien');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option value='{$row['idnv']}'>{$row['tennv']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ngaygiaohang:</td>
                                                <td>
                                                    <input type="text" name="ngInsHD">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>tongtien:</td>
                                                <td>
                                                    <input type="text" name="ttInsHD">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subInsHD" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('UpdHD');">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">UPDATE</td>
                                            </tr>
                                            <tr>
                                                <td>idhd:</td>
                                                <td>
                                                    <select id="UpdHD" name="idUpdHD">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT idhd FROM hoadon');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['idhd']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ngaylaphd:</td>
                                                <td>
                                                    <input id="nlUpdHD" type="text" name="nlUpdHD">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>idkh:</td>
                                                <td>
                                                    <select id="khUpdHD" name="khUpdHD">
                                                        <option value=""></option>
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT idkh, tenkh FROM khachhang');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option id='{$row['idkh']}' value='{$row['idkh']}'>{$row['tenkh']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>idnv:</td>
                                                <td>
                                                    <select id="nvUpdHD" name="nvUpdHD">
                                                        <option value=""></option>
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT idnv, tennv FROM nhanvien');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option value='{$row['idnv']}'>{$row['tennv']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ngaygiaohang:</td>
                                                <td>
                                                    <input id="ngUpdHD" type="text" name="ngUpdHD">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>tongtien:</td>
                                                <td>
                                                    <input id='ttUpdHD' type="text" name="ttUpdHD">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subUpdHD" value="Submit">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" onsubmit="return checkInput('DelHD');">
                                        <table style="margin: auto; text-align: left;">
                                            <tr>
                                                <td colspan="2" style="text-align: center;">DELETE</td>
                                            </tr>
                                            <tr>
                                                <td>idhd:</td>
                                                <td>
                                                    <select name="idDelHD">
                                                        <?php if (isset($con)) {
                                                            $result = $con->query('SELECT idhd FROM hoadon');
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option>{$row['idhd']}</option>";
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <input type="submit" name="subDelHD" value="Submit">
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
