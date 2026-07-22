<?php
include_once(__DIR__ . "/../Controller/cTkhoan.php");

if (isset($_REQUEST['edit'])) {
    $tendn = $_REQUEST['tendn'];
    $tk = $_REQUEST['matk'];
    $p = new controlTaikhoan();
    $kq = $p->EditTaikhoan($tendn, $tk);
    if ($kq == 1) {
        echo '<script>alert("Sửa thông tin tài khoản thành công.")</script>';
        header("refresh: 0; url='../quanly.php?tkhoan'");
    } elseif ($kq == 0) {
        echo '<script>alert("Sửa thông tin tài khoản thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?tkhoan'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?tkhoan'");
    }
}
