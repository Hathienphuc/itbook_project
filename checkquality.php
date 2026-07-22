<?php
session_start();
include_once(__DIR__ . "/Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (isset($_POST['soluong'])) {
    $masp = (array_keys($_POST['soluong']))[0];
    $soluong = $_POST['soluong'][$masp];
    $addProduct = mysqli_query($con, "SELECT `soluong` FROM `sanpham` WHERE `masp` = " . $masp);
    $addProduct = mysqli_fetch_assoc($addProduct);
    if (isset($_SESSION["cart"][$masp])) {
        $soluong += $_SESSION["cart"][$masp];
    }
    if ($soluong > $addProduct['soluong']) {
        echo json_encode("Số lượng tồn kho không đủ, chỉ có thể mua tối đa: " . $addProduct['soluong'] . " sản phẩm. Vui lòng kiểm tra lại giỏ hàng.");
    } else {
        echo json_encode(true);
    }
}
