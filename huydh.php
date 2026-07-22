<?php
include_once(__DIR__ . "/Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (isset($_GET['mahd'])) {
    $mahd  = base64_decode($_GET['mahd']);
    $huydhang = "UPDATE hoadon SET trangthai = '4', tinhtrangtt = CASE WHEN tinhtrangtt = 'Đã thanh toán' THEN 'Đã hoàn tiền' ELSE tinhtrangtt END WHERE mahd = '$mahd'";
    $kqhdh = mysqli_query($con, $huydhang);

    if (isset($kqhdh)) {
        $upsl = "UPDATE sanpham SET soluong = soluong + (SELECT soluongban FROM chitiethoadon WHERE mahd = '$mahd' AND sanpham.masp = chitiethoadon.masp) WHERE masp IN (SELECT masp FROM chitiethoadon WHERE mahd = '$mahd')";
        $kqupsl = mysqli_query($con, $upsl);
        if (isset($kqupsl)) {
            echo '<script>
                    alert("Hủy đơn hàng thành công");
                    window.location.href="xemlsdh.php";
                </script>';
        }
    }
}
