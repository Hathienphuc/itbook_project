<?php
include_once(__DIR__ . "/../Controller/cNvien.php");

if (isset($_REQUEST['delete'])) {
    $manv = $_REQUEST['manv'];
    $p = new controlNhanvien();
    $del = $p->DeleteNhanvien($manv);
    if ($del == 1) {
        echo '<script>alert("Xóa thông tin nhân viên thành công.")</script>';
        header("refresh: 0; url='../quanly.php?nvien'");
    } elseif ($del == 0) {
        echo '<script>alert("Xóa thông tin nhân viên thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?nvien'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?nvien'");
    }
}
