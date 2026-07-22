<?php
include_once(__DIR__ . "/../Controller/cTkhoan.php");

if (isset($_REQUEST['restore'])) {
    $matk = $_REQUEST['mtk'];
    $p = new controlTaikhoan();
    $reset = $p->KhoiphucTaikhoan($matk);
    if ($reset == 1) {
        echo '<script>alert("Khôi phục mật khẩu thành công.")</script>';
        header("refresh: 0; url='../quanly.php?tkhoan'");
    } elseif ($reset == 0) {
        echo '<script>alert("Khôi phục mật khẩu thất bại.")</script>';
        header("refresh: 0; url='../quanly.php?tkhoan'");
    } else {
        echo '<script>alert("Lỗi.")</script>';
        header("refresh: 0; url='../quanly.php?tkhoan'");
    }
}
