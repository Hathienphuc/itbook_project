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
	<link rel="stylesheet" href="CSS/quanly.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<style>
		#content-wrapper .container {
			padding: 15px 0;
		}

		.menu-items ul {
			margin: 0;
			padding: 0;
		}

		.menu-items ul li {
			list-style: none;
			line-height: 30px;
			border-bottom: 1px dashed #ccc;
			padding-left: 15px;
		}

		.menu-items ul li a {
			color: #000;
		}

		.menu-items ul li:first-child {
			border-top: 0;
		}

		.menu-items {
			padding: 0 0px 15px 0px;
			border: 1px solid #ccc;
			border-radius: 0 0 10px 10px;
		}

		.menu-heading {
			background: #525151;
			line-height: 20px;
			padding: 10px;
			color: #fff;
			border-radius: 10px 10px 0 0;
			font-size: 18px;
			text-align: center;
		}

		.main-content {
			float: right;
			width: 900px;
			margin-top: -140px;
		}

		.info-container {
			margin: 20px auto;
			max-width: 600px;
			padding: 20px;
			border: 1px solid #ccc;
			margin-left: -13px;
		}

		.info-container h2 {
			font-size: 28px;
			margin-bottom: 20px;
			text-align: center;
			font-weight: 600;
		}

		.info-container label {
			display: block;
			font-weight: 600;
			margin-bottom: 5px;
		}

		.info-container input[type=text],
		.info-container input[type=email],
		.info-container input[type=file],
		.info-container input[type=password] {
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 5px;
			border: 1px solid #ccc;
		}

		.info-container input[type=submit] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			margin-left: 340px;
		}

		.info-container input[type=submit]:hover {
			background-color: #3e8e41;
		}

		.info-container input[type=reset] {
			background-color: #fac564;
			color: black;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		.info-container input[type=reset]:hover {
			background-color: transparent;
			border: 2px solid #fac564;
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
					<h1 class="mb-0 bread" style="margin-left: 110px;">Thông tin chung<h1>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section" style="height: 830px; font-family: 'Lora', serif;">
		<div id="content-wrapper" style="margin-left: -1150px; margin-top: -90px;">
			<div class="container" style="width: 10%;">
				<div class="left-menu">
					<div class="menu-heading">MENU</div>
					<div class="menu-items">
						<ul>
							<li><a style="text-decoration:none;" href="thongtinchung.php?ttcn">Thông tin cá nhân</a></li>
							<li><a style="text-decoration:none;" href="thongtinchung.php?mk">Đổi mật khẩu</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="main-content">
			<?php
			if (isset($_REQUEST["ttcn"])) {
				include_once("quanlyttcn.php");
			}

			if (isset($_REQUEST["mk"])) {
				include_once("changepass.php");
			}

			if (!isset($_REQUEST["ttcn"]) && !isset($_REQUEST["mk"])) {
				include_once("quanlyttcn.php");
			}
			?>
		</div>
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

	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg></div>

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

	<script>
		let subMenu = document.getElementById("subMenu");

		function toggleMenu() {
			subMenu.classList.toggle("open-menu");
		}
	</script>
</body>

</html>