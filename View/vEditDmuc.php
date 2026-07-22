<?php
include_once(__DIR__ . "/../Controller/cDmuc.php");

if (isset($_REQUEST['edit'])) {
    $tenloai = $_REQUEST['tenloai'];
    $dm = $_REQUEST['maloai'];
    $p = new controlDanhmuc();
    $kq = $p->EditDanhmuc($tenloai, $dm);
    if ($kq == 1) {
        echo '<script>alert("Sửa thông tin loại sản phẩm thành công.")</script>';
        header("refresh: 0; url='../quanly.php?dmuc'");
    } elseif ($kq == 0) {
        echo '<script>alert("Sửa thông tin loại sản phẩm thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?dmuc'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?dmuc'");
    }
}
