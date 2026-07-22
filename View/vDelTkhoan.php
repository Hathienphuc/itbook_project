<?php
include_once(__DIR__ . "/../Controller/cTkhoan.php");

if (isset($_REQUEST['delete'])) {
    $matk = $_REQUEST['idtk'];
    $p = new controlTaikhoan();
    $del = $p->DeleteTaikhoan($matk);
    if ($del == 1) {
        echo '<script>alert("Xóa thông tin tài khoản thành công.")</script>';
        header("refresh: 0; url='../quanly.php?tkhoan'");
    } elseif ($del == 0) {
        echo '<script>alert("Xóa thông tin tài khoản thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?tkhoan'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?tkhoan'");
    }
}
