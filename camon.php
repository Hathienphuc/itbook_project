<?php
session_start();
include_once(__DIR__ . "/Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (!$con) {
	die("Kết nối thất bại: " . mysqli_connect_error());
}

if (isset($_GET['partnerCode'])) {
	$codeOrder = rand(0, 9999);
	$partnerCode = $_GET['partnerCode'];
	$orderId = $_GET['orderId'];
	$amount = $_GET['amount'];
	$orderInfo = $_GET['orderInfo'];
	$orderType = $_GET['orderType'];
	$transId = $_GET['transId'];
	$payType = $_GET['payType'];
	$extraData = $_GET['extraData'];
	$mahd = $extraData;
	$resultCode = $_GET['resultCode'];
	$message = $_GET['message'];
	$insert_momo = "INSERT INTO momo (partnerCode, orderId, amount, orderInfo, orderType, transId, payType, extraData, codeOrder) VALUES ('$partnerCode', '$orderId', '$amount', '$orderInfo', '$orderType', '$transId', '$payType', '$extraData', '$codeOrder')";

	if ($resultCode == 0) {
		$cart_query = mysqli_query($con, $insert_momo);
		if ($cart_query) {
			mysqli_query($con, "UPDATE hoadonSET tinhtrangtt='Đã thanh toán',trangthai=0 WHERE mahd='$mahd'
        ");
			unset($_SESSION["cart"]);
		}
	} else {
		$sql = mysqli_query($con, "SELECT masp, soluongban FROM chitiethoadon WHERE mahd='$mahd'");
		while ($row = mysqli_fetch_assoc($sql)) {
			mysqli_query($con, "UPDATE sanpham SET soluong = soluong + " . $row['soluongban'] . "WHERE masp='" . $row['masp'] . "'");
		}
		mysqli_query($con, "DELETE FROM chitiethoadon WHERE mahd='$mahd'");
		mysqli_query($con, "DELETE FROM hoadon WHERE mahd='$mahd'");
	}

	if ($resultCode == 0) {
		echo '<script>
        alert("Giao dịch thanh toán MoMo ATM thành công");
        window.location.href="sanpham.php";
    	</script>';
	} else {
		echo '<script>
        alert("Giao dịch thanh toán MoMo ATM thất bại");
        window.location.href="sanpham.php";
    	</script>';
	}
}

mysqli_close($con);
