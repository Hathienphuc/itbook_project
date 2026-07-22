<?php
session_start();
include_once(__DIR__ . "/Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (!isset($_SESSION['tendn'])) {
	echo '<script>
            alert("Bạn vui lòng đăng nhập.");
            window.location.href="login_kh.php";
        </script>';
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>ITBOOK</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="CSS/animate.css">
	<link rel="stylesheet" href="CSS/owl.carousel.min.css">
	<link rel="stylesheet" href="CSS/owl.theme.default.min.css">
	<link rel="stylesheet" href="CSS/magnific-popup.css">
	<link rel="stylesheet" href="CSS/flaticon.css">
	<link rel="stylesheet" href="CSS/index.css">
	<link rel="stylesheet" href="CSS/locsp.css">
	<link rel="stylesheet" href="CSS/quanly.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<style>
		.product-img img {
			max-width: 100px;
			height: auto;
			border-radius: 5px;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 8px 16px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #45a049;
		}

		label {
			display: block;
			margin-bottom: 10px;
		}

		input[type="text"],
		input[type="tel"] {
			padding: 8px;
			width: 100%;
			border-radius: 4px;
			border: 1px solid #ccc;
			box-sizing: border-box;
			margin-bottom: 20px;
		}

		button[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 8px 16px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		button[type="submit"]:hover {
			background-color: #45a049;
		}

		.form-group {
			margin-bottom: 15px;
		}

		label {
			display: block;
			margin-bottom: 5px;
		}

		input[type="text"],
		input[type="tel"] {
			width: 100%;
			height: 35px;
			border: 1px solid #ccc;
			border-radius: 4px;
			padding: 5px;
			font-size: 16px;
		}

		.payment-method {
			border: 1px solid #ccc;
			border-radius: 4px;
			padding: 10px;
		}

		.form-check {
			margin-bottom: 10px;
		}

		.form-check-label {
			margin-left: 5px;
		}

		.btn {
			background-color: #dc3545;
			color: #fff;
			border: none;
			border-radius: 4px;
			padding: 10px 20px;
			font-size: 16px;
			cursor: pointer;
		}

		.btn:hover {
			background-color: #c82333;
		}

		form {
			width: 500px;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			border: 1px solid #ddd;
			border-radius: 5px;
			box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
			display: inline-block;
			margin-bottom: 20px;
		}

		.form-container {
			width: 100%;
			display: flex;
			justify-content: center;
			background-color: #f5f5f5;
			padding: 20px;
			margin-bottom: -40px;
		}
	</style>
</head>

<body>
	<div class="container-fluid px-md-4  pt-3 pt-md-4">
		<div class="row justify-content-between">
			<div class="col-md-8 order-md-last">
				<div class="row">
					<div class="col-md-6 text-center">
						<a class="navbar-brand" href="index.php" style="font-size: 40px; margin-left: 625px;">IT<span>BOOK</span> <small>Thế giớ sách công nghệ</small></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fa fa-bars"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav" style="margin-left: 260px;">
				<ul class="navbar-nav m-auto">
					<li class="nav-item"><a href="index.php" class="nav-link" style="font-size: 14px;">Trang chủ</a></li>
					<li class="nav-item"><a href="about.php" class="nav-link" style="font-size: 14px;">Giới thiệu</a></li>
					<li class="nav-item"><a href="sanpham.php" class="nav-link" style="font-size: 14px;">Sản phẩm</a></li>
					<li class="nav-item"><a href="lienhe.php" class="nav-link" style="font-size: 14px;">Liên hệ</a></li>
				</ul>
			</div>

			<?php
			if (isset($_SESSION['tendn'])) {
				$tendnkh = $_SESSION['tendn'];
				$query = "SELECT * FROM taikhoan tk JOIN khachhang kh ON tk.matk = kh.matk WHERE tendn = '$tendnkh'";
				$result = mysqli_query($con, $query);
				$row = mysqli_fetch_assoc($result);
			?>

				<?php
				if (isset($_SESSION['tendn'])) {
					$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
				?>
					<img src="Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()" style="height: 40px; margin-right: 230px;">

					<div class="submenudoc" id="subMenu">
						<div class="submenu">
							<div class="ttcn">
								<img src="Image/<?php echo $hinhanh; ?>">
							<?php } ?>

							<h4 style="margin-top: 10px;"><?php echo $_SESSION['tendn'] ?></h4>
							</div>

							<hr>

							<a href="thongtinchung.php" class="submenulink">
								<i class='bx bx-user'></i>
								<p style="font-size: 16px; margin-top: 15px;">Thông tin chung</p>
								<span> > </span>
							</a>

							<a href="xemlsdh.php" class="submenulink">
								<i class='bx bx-history'></i>
								<p style="font-size: 16px; margin-top: 15px;">Lịch sử đơn hàng</p>
								<span> > </span>
							</a>

							<a href="logout_kh.php" class="submenulink">
								<i class='bx bx-log-out'></i>
								<p style="font-size: 16px; margin-top: 15px;">Đăng xuất</p>
								<span> > </span>
							</a>
						</div>
					</div>
				<?php } else { ?>

					<ul class="navbar-nav m-auto">
						<li class="nav-item"><a href="login_kh.php" class="nav-link" style="font-size: 14px; margin-right: 150px;">Đăng nhập</a></li>
					</ul>
				<?php } ?>
		</div>
	</nav>

	<section class="hero-wrap hero-wrap-2" style="background-image: url('Image/bg_5.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate mb-0 text-center">
					<h1 class="mb-0 bread">Thanh toán</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<?php
		include_once(__DIR__ . "/Model/ketnoi.php");
		$p = new clsketnoi();
		$con = $p->ketnoiDB();

		if (!empty($_SESSION["cart"])) {
			$products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `masp` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
		?>

			<table style="border-collapse: collapse; margin-bottom: 40px; margin-top: -60px; width: 96%; margin-left: 30px;">
				<thead>
					<tr>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">STT</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">Tên sản phẩm</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">Tác giả</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">Hình ảnh</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">Số lượng</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; border-right: 1px solid black; vertical-align: middle;">Đơn giá</th>
						<th style="background-color: #f2f2f2; color: black; font-family: 'Lora', serif; text-align: center; padding: 8px; width: fit-content; vertical-align: middle;">Thành tiền</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$total = 0;
					$dem = 1;
					while ($row = mysqli_fetch_array($products)) {
						$quantity = $_SESSION["cart"][$row['masp']];
						$price = $row['giaban'];
						$hinhanh = $row['hinhanh'];
						$subtotal = $price * $quantity;
						$total += $subtotal;
					?>
						<tr>
							<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo $dem++; ?></td>
							<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo $row['tensp']; ?></td>
							<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo $row['tacgia']; ?></td>
							<td class="product-img" style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><img src="Image/<?php echo $row['hinhanh'] ?>" /></td>
							<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo $quantity; ?></td>
							<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo number_format($price, 0, ',', '.'); ?> VNĐ</td>
							<td style="text-align: center; padding: 8px; border-bottom: 1px solid black; color: black; vertical-align: middle;"><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
						</tr>
					<?php } ?>

					<tr style="background-color: #f2f2f2; height: 40px; text-align: right; font-family: 'Lora', serif; font-weight: 600; color: red;">
						<td colspan="6">Tổng tiền:</td>
						<td style="padding-right: 20px;"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</td>
					</tr>
				</tbody>
			</table>

			<?php
			if (isset($_SESSION['makh'])) {
				$user_id = $_SESSION['makh'];
				$query = "SELECT * FROM khachhang WHERE makh = $user_id";
				$result = mysqli_query($con, $query);
				$user = mysqli_fetch_array($result);
			}
			?>

			<div class="form-container">
				<form method="POST" onsubmit="return validateForm()">
					<div class="form-group">
						<label for="name">Họ tên:</label>
						<input type="text" name="name" value="<?php echo $user['tenkh']; ?>" required>
					</div>
					<div class="form-group">
						<label for="phone">Số điện thoại:</label>
						<input type="text" name="phone" id="sdthoai" value="<?php echo  $user['sodienthoai']; ?>" required>
					</div>
					<div class="form-group">
						<label for="address">Địa chỉ:</label>
						<input type="text" name="address" value="<?php echo $user['diachi']; ?>" required>
					</div>
					<input type="hidden" name="total" value="<?php echo $total = isset($total) ? $total : ""; ?>">
					<input type="hidden" name="order_id" value="<?php echo $orderId = isset($orderId) ? $orderId : ""; ?>">
					<div class="form-group payment-method">
						<label>Phương thức thanh toán:</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="payment_method" id="momo" value="momo" onclick="this.form.action='xulythanhtoanmomo.php?total=<?php echo $total ?>'" required>
							<label class="form-check-label" for="momo">Thanh toán MoMo ATM</label>
							<img src="Image/momo.jpg" alt="momo logo" width="50px">
						</div>

						<div class="form-check">
							<input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" onclick="this.form.action='xulythanhtoancod.php'" required>
							<label class="form-check-label" for="cod">Thanh toán khi nhận hàng</label>
							<img src="Image/cod.jpg" alt="COD logo" width="70px" height="50px">
						</div>

						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-danger">Thanh toán</button>
						</div>
					</div>
				</form>
			</div>

		<?php
		} else {
			echo '<script>
					alert("Giỏ hàng trống. Bạn nên mua hàng.");
					window.location.href="sanpham.php";
				</script>';
		}
		?>
	</section>

	<footer class="ftco-footer">
		<div class="container" style="margin-top: -70px;">
			<div class="row mb-5">
				<div class="col-sm-12 col-md">
					<div class="ftco-footer-widget mb-4" style="margin-left: -100px;">
						<h2 class="ftco-heading-2 logo blinking"><a href="#">Kết nối</a></h2>
						<p>Dù gần hay xa chỉ cần có đam mê ITBook luôn có thể đến với Bạn!</p>
						<ul class="ftco-footer-social list-unstyled mt-2">
							<li class="ftco-animate"><a href="#"><span class="fa fa-twitter" style="color:skyblue;"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="fa fa-facebook" style="color:blue;"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="fa fa-instagram " style="color:Brown;"></span></a></li>
						</ul>
					</div>
				</div>

				<div class="col-sm-12 col-md">
					<div class="ftco-footer-widget mb-4 ml-md-4" style="width:100%;">
						<h2 class="ftco-heading-2">Thành viên nhóm 660</h2>
						<ul class="list-unstyled">
							<li>Nguyễn Thanh Tân - 19454801</li>
							<li>Hà Thiên Phúc - 19437521</li>
						</ul>
					</div>
				</div>

				<div class="col-sm-12 col-md">
					<div class="ftco-footer-widget mb-4" style="margin-left: 50px;">
						<h2 class="ftco-heading-2">Liên kết nhanh</h2>
						<ul class="list-unstyled">
							<li><a href="index.php"><span class="fa fa-chevron-right mr-2"></span>Trang chủ</a></li>
							<li><a href="about.php"><span class="fa fa-chevron-right mr-2"></span>Giới thiệu</a></li>
							<li><a href="sanpham.php"><span class="fa fa-chevron-right mr-2"></span>Sản phẩm</a></li>
							<li><a href="lienhe.php"><span class="fa fa-chevron-right mr-2"></span>Liên hệ</a></li>
						</ul>
					</div>
				</div>

				<div class="col-sm-12 col-md">
					<div class="ftco-footer-widget mb-4 ml-md-4" style="width:100%;">
						<h2 class="ftco-heading-2">ITBOOK</h2>
						<ul class="list-unstyled" style="font-family: 'Poppins', sans-serif; font-size: 18px;">
							<li style="width: 150%;"><i class='bx bx-map'> 12 Nguyễn Văn Bảo, phường 4, quận Gò Vấp</i></li>
							<li><i class='bx bx-envelope'> itbook660@gmail.com</i></li>
							<li><i class='bx bx-phone'> 0835799064</i></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<div class="container-fluid px-0 py-3 bg-black" style="margin-top: -50px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p class="mb-0" style="color: rgba(255,255,255,.5); text-align: center;">
						Cảm ơn quý khách đã chọn sản phẩm của chúng tôi <i class="fa fa-heart color-danger" aria-hidden="true"></i> <a href="index.php">ITBOOK</a>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div id="ftco-loader" class="show fullscreen">
		<svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg>
	</div>

	<script src="JS/jquery.min.js"></script>
	<script src="JS/jquery-migrate-3.0.1.min.js"></script>
	<script src="JS/popper.min.js"></script>
	<script src="JS/bootstrap.min.js"></script>
	<script src="JS/jquery.easing.1.3.js"></script>
	<script src="JS/jquery.waypoints.min.js"></script>
	<script src="JS/jquery.stellar.min.js"></script>
	<script src="JS/owl.carousel.min.js"></script>
	<script src="JS/jquery.magnific-popup.min.js"></script>
	<script src="JS/jquery.animateNumber.min.js"></script>
	<script src="JS/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="JS/google-map.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
	<script src="JS/main.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="JS/jquery.validate.min.js"></script>

	<script>
		let subMenu = document.getElementById("subMenu");

		function toggleMenu() {
			subMenu.classList.toggle("open-menu");
		}

		function validateForm() {
			var sodienthoai = document.getElementById("sdthoai").value;
			var sodienthoaiRegex = /^0[0-9]{9}$/;
			if (!sodienthoaiRegex.test(sodienthoai)) {
				alert("Số điện thoại không đúng định dạng!");
				event.preventDefault();
			}
			return true;
		}
	</script>
</body>

</html>