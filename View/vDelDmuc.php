<?php
include_once(__DIR__ . "/../Controller/cDmuc.php");

if (isset($_REQUEST['delete'])) {
    $maloai = $_REQUEST['iddm'];
    $p = new controlDanhmuc();
    $del = $p->DeleteDanhmuc($maloai);
    if ($del == 1) {
        echo '<script>alert("Xóa thông tin loại sản phẩm thành công.")</script>';
        header("refresh: 0; url='../quanly.php?dmuc'");
    } elseif ($del == 0) {
        echo '<script>alert("Xóa thông tin loại sản phẩm thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?dmuc'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?dmuc'");
    }
}
