<?php
include_once(__DIR__ . "/../Controller/cKhang.php");

if (isset($_REQUEST['delete'])) {
    $makh = $_REQUEST['makh'];
    $p = new controlKhachhang();
    $del = $p->DeleteKhachhang($makh);
    if ($del == 1) {
        echo '<script>alert("Xóa thông tin khách hàng thành công.")</script>';
        header("refresh: 0; url='../quanly.php?khang'");
    } elseif ($del == 0) {
        echo '<script>alert("Xóa thông tin khách hàng thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?khang'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?khang'");
    }
}
