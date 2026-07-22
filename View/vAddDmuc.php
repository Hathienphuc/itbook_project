<?php
include_once(__DIR__ . "/../Controller/cDmuc.php");

if (isset($_REQUEST['add'])) {
    $tenloai = $_REQUEST['loaisp'];
    $p = new controlDanhmuc();
    $kq = $p->AddDanhmuc($tenloai);
    if ($kq == 1) {
        echo '<script>alert("Thêm thông tin loại sản phẩm thành công.")</script>';
        header("refresh: 0; url='../quanly.php?dmuc'");
    } elseif ($kq == 0) {
        echo '<script>alert("Thêm thông tin loại sản phẩm thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?dmuc'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?dmuc'");
    }
}
