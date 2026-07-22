<?php
include_once(__DIR__ . "/../Controller/cTkhoan.php");

if (isset($_GET['matk'])) {
    $matk = $_GET['matk'];
    $p = new controlTaikhoan();
    $tblaccount = $p->MokhoaTaikhoan($matk);
    header("refresh: 0; url='../quanly.php?tkhoan'");
}
