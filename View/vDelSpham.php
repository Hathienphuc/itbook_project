<?php
include_once(__DIR__ . "/../Controller/cSpham.php");

if (isset($_REQUEST['delete'])) {
    $masp = $_REQUEST['msp'];
    $p = new controlSanpham();
    $del = $p->DeleteSanpham($masp);
    if ($del == 1) {
        echo '<script>alert("Xóa thông tin sản phẩm thành công.")</script>';
        header("refresh: 0; url='../quanly.php?spham'");
    } elseif ($del == 0) {
        echo '<script>alert("Xóa thông tin sản phẩm thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?spham'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?spham'");
    }
}
