<?php
include_once(__DIR__ . "/../Controller/cNhacc.php");

if (isset($_REQUEST['delete'])) {
    $mancc = $_REQUEST['idsp'];
    $p = new controlNhacungcap();
    $del = $p->DeleteNhacungcap($mancc);
    if ($del == 1) {
        echo '<script>alert("Xóa thông tin nhà cung cấp thành công.")</script>';
        header("refresh: 0; url='../quanly.php?nccap'");
    } elseif ($del == 0) {
        echo '<script>alert("Xóa thông tin nhà cung cấp thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?nccap'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?nccap'");
    }
}
