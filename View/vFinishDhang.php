<?php
include_once(__DIR__ . "/../Controller/cDhang.php");

if (isset($_GET['mahd'])) {
    $mahd = $_GET['mahd'];
    $p = new controlDonhang();
    $tblorder = $p->HoanthanhDonhang($mahd);
    header("refresh: 0; url='../quanly.php?dhangnvgh'");
}
