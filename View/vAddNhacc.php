<?php
include_once(__DIR__ . "/../Controller/cNhacc.php");

if (isset($_REQUEST['add'])) {
    $tenncc = $_REQUEST['tncc'];
    $diachi = $_REQUEST['dc'];
    $sodienthoai = $_REQUEST['sdt'];
    $email = $_REQUEST['mail'];
    $p = new controlNhacungcap();
    $kq = $p->AddNhacungcap($tenncc, $diachi, $sodienthoai, $email);
    if ($kq == 1) {
        echo '<script>alert("Thêm thông tin nhà cung cấp thành công.")</script>';
        header("refresh: 0; url='../quanly.php?nccap'");
    } elseif ($kq == 0) {
        echo '<script>alert("Thêm thông tin nhà cung cấp thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?nccap'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?nccap'");
    }
}
