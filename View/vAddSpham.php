<?php
include_once(__DIR__ . "/../Controller/cSpham.php");

if (isset($_REQUEST['add'])) {
    $mancc = $_REQUEST['idncc'];
    $maloai = $_REQUEST['iddm'];
    $tensp = $_REQUEST['tsp'];
    $tacgia = $_REQUEST['tg'];
    $soluong = $_REQUEST['sl'];
    $giaban = $_REQUEST['gb'];
    $ngayxuatban = $_REQUEST['nxb'];
    $hinhanh = $_REQUEST['hinh'];
    $file = isset($_FILES['hinhanh']['tmp_name']) ? $_FILES['hinhanh']['tmp_name'] : "";
    $type = isset($_FILES['hinhanh']['type']) ? $_FILES['hinhanh']['type'] : "";
    $p = new controlSanpham();
    $kq = $p->AddSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh, $type, $file);
    if ($kq == 1) {
        echo '<script>alert("Thêm thông tin sản phẩm thành công.")</script>';
        header("refresh: 0; url='../quanly.php?spham'");
    } elseif ($kq == 0) {
        echo '<script>alert("Thêm thông tin sản phẩm thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?spham'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?spham'");
    }
}
