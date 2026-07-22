<?php
include_once(__DIR__ . "/../Controller/cNhacc.php");

if (isset($_REQUEST['edit'])) {
    $tenncc = $_REQUEST['tenncc'];
    $diachi = $_REQUEST['diachi'];
    $sodienthoai = $_REQUEST['sodienthoai'];
    $email = $_REQUEST['email'];
    $ncc = $_REQUEST['mancc'];
    $p = new controlNhacungcap();
    $kq = $p->EditNhacungcap($tenncc, $diachi, $sodienthoai, $email, $ncc);
    if ($kq == 1) {
        echo '<script>alert("Sửa thông tin nhà cung cấp thành công.")</script>';
        header("refresh: 0; url='../quanly.php?nccap'");
    } elseif ($kq == 0) {
        echo '<script>alert("Sửa thông tin nhà cung cấp thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?nccap'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?nccap'");
    }
}
