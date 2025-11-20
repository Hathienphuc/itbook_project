<?php
	// Hàm bắt đầu session
	session_start();

	// Kết nối CSDL
	include_once(__DIR__ . "/Model/ketnoi.php");

	// Gọi hàm trong class của Model
	$p = new clsketnoi();
	$connect = $p->ketnoiDB($con);

	// Kiểm tra kết nối
	if (!$con) {
		die("Kết nối thất bại: " . mysqli_connect_error());
	}

	// Kiểm tra xem URL có chứa tham số resultCode do MoMo trả về hay không
	if (!isset($_GET['resultCode'])) {
		echo '<script>alert("Không nhận được phản hồi từ MoMo!"); window.location.href="sanpham.php";</script>';
		exit;
	}

	// Khai báo biến
	$resultCode = $_GET['resultCode'];
	$message    = $_GET['message'];
	$orderId    = $_GET['orderId'];
	$amount     = $_GET['amount'];
	$transId    = $_GET['transId'];

	// Điều kiện xử lý CSDL
	if ($resultCode == "0") {

		// Xử lý thêm dữ liệu vào bảng momo
		$sql = "INSERT INTO momo (partnerCode, orderId, amount, orderInfo, orderType, transId, payType)
				VALUES (
					'{$_GET['partnerCode']}',
					'{$orderId}',
					'{$amount}',
					'{$_GET['orderInfo']}',
					'{$_GET['orderType']}',
					'{$transId}',
					'{$_GET['payType']}'
				)";
		mysqli_query($con, $sql);


		// Khai báo biến
		$makh = $_SESSION['makh'] ?? 0;

		// Xử lý thêm dữ liệu vào bảng hóa đơn
		$insert = "INSERT INTO hoadon(makh, tongtien, tinhtrangtt, trangthai) VALUES ('$makh', '$amount', 'Đã thanh toán', 1)";
		mysqli_query($con, $insert);

		// Hủy SESSION của giỏ hàng
		unset($_SESSION["cart"]);

		// Thông báo thành công
		echo '<script>alert("Thanh toán thành công!"); window.location.href="sanpham.php";</script>';
		exit;
	}

	// Thông báo thất bại
	$err = "Thanh toán thất bại!";
	echo '<script>alert("'.$err.'"); window.location.href="sanpham.php";</script>';
	exit;
?>
	


	  