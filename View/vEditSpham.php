<?php
include_once(__DIR__ . "/../Controller/cSpham.php");

if (isset($_REQUEST['edit'])) {
    $mancc = $_REQUEST['nhacungcap'];
    $maloai = $_REQUEST['loaisp'];
    $tensp = $_REQUEST['tensp'];
    $tacgia = $_REQUEST['tacgia'];
    $soluong = $_REQUEST['soluong'];
    $giaban = $_REQUEST['giaban'];
    $ngayxuatban = $_REQUEST['ngayxuatban'];
    $hinhanh = $_REQUEST['hinhanh'];
    $sp = $_REQUEST['masp'];
    $file = isset($_FILES['hinhanh']['tmp_name']) ? $_FILES['hinhanh']['tmp_name'] : "";
    $type = isset($_FILES['hinhanh']['type']) ? $_FILES['hinhanh']['type'] : "";
    $p = new controlSanpham();
    $kq = $p->EditSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh, $type, $file, $sp);
    if ($kq == 1) {
        echo '<script>alert("Sửa thông tin sản phẩm thành công.")</script>';
        header("refresh: 0; url='../quanly.php?spham'");
    } elseif ($kq == 0) {
        echo '<script>alert("Sửa thông tin sản phẩm thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?spham'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?spham'");
    }
}
