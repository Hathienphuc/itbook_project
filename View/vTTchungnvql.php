<?php
session_start();
include_once(__DIR__ . "/../Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (!isset($_SESSION['user_name'])) {
	echo '<script>
            alert("Bạn vui lòng đăng nhập.");
            window.location.href="../login_nvql.php";
        </script>';
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ITBOOK</title>

	<link rel="stylesheet" href="../CSS/quanly.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<style>
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
			font-size: 18px;
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
			font-size: 18px;
		}

		.info-container input[type=submit] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			margin-left: 340px;
			font-size: 18px;
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
			font-size: 18px;
		}

		.info-container input[type=reset]:hover {
			background-color: transparent;
			border: 2px solid #fac564;
		}
	</style>
</head>

<body>
	<?php
	if (isset($_SESSION['user_name'])) {
		if ($_SESSION['nguoidung'] == 'Quản lý') {
			$tendnql = $_SESSION['user_name'];
			$query = "SELECT * FROM taikhoan tk JOIN quanly ql ON tk.matk = ql.matk WHERE tendn = '$tendnql'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($result);
	?>

			<div class="sidebar" style="background-color: #27ae60;">
				<div class="logo-ct">
					<i class='bx bxs-book'></i>
					<span class="logo_name">ITBOOK</span>
				</div>

				<ul class="nav-links">
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="../quanly.php">
							<i class='bx bx-home'></i>
							<span class="link_name">Trang chủ</span>
						</a>
					</li>
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="vTTchungnvql.php?ttcn">
							<i class='bx bx-user'></i>
							<span class="link_name">Thông tin cá nhân</span>
						</a>
					</li>
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="vTTchungnvql.php?dmk">
							<i class='bx bx-reset'></i>
							<span class="link_name">Đổi mật khẩu</span>
						</a>
					</li>
				</ul>

				<p style="margin-top: -170px; color: #fff; text-align: center; margin-right: 10px;">
					Nhóm 660 <br>
					Hà Thiên Phúc - 19437521 <br>
					Nguyễn Thanh Tân - 19454801
				</p>
			</div>

			<section class="home-section">
				<nav class="hero" style="background-color: #27ae60;">
					<div class="home-content">
						<i class='bx bx-menu'></i>
						<i class='bx bxs-book'></i>
						<span class="text">ITBOOK</span>
					</div>

					<ul style="margin-bottom: -5px;">
						<li>
							<i class='bx bx-home'></i>
							<a href="../quanly.php">Trang chủ</a>
						</li>
					</ul>

					<?php
					if (isset($_SESSION['user_name'])) {
						$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
					?>
						<img src="../Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

						<div class="submenu-system" id="subMenu">
							<div class="submenu">
								<div class="ttcn">
									<img src="../Image/<?php echo $hinhanh; ?>">
								<?php }  ?>

								<h3><?php echo $_SESSION['user_name']; ?></h3>
								</div>

								<hr>

								<a href="vTTchungnvql.php" class="submenulink" style="margin-top: 15px;">
									<i class='bx bx-user'></i>
									<p style="margin: 0;">Thông tin cá nhân</p>
									<span> > </span>
								</a>

								<a href="../logout_nvql.php" class="submenulink" style="margin-top: 15px; margin-bottom: 10px;">
									<i class='bx bx-log-out'></i>
									<p style="margin: 0;">Đăng xuất</p>
									<span> > </span>
								</a>
							</div>
						</div>
				</nav>

				<div class="ncc" style="background-color: #E4E9F7; height: 750px;">
					<?php
					if (isset($_REQUEST["ttcn"])) {
						include_once("vTTcanhanql.php");
					}

					if (isset($_REQUEST["dmk"])) {
						include_once("vDmkql.php");
					}

					if (!isset($_REQUEST["ttcn"]) && !isset($_REQUEST["dmk"])) {
						include_once("vTTcanhanql.php");
					}
					?>
				</div>
			</section>

		<?php
		} elseif ($_SESSION['nguoidung'] == 'Nhân viên bán hàng') {
			$tendnnv = $_SESSION['user_name'];
			$query = "SELECT * FROM taikhoan tk JOIN nhanvien nv ON tk.matk = nv.matk WHERE tendn = '$tendnnv'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($result);
		?>

			<div class="sidebar" style="background-color: #27ae60;">
				<div class="logo-ct">
					<i class='bx bxs-book'></i>
					<span class="logo_name">ITBOOK</span>
				</div>

				<ul class="nav-links">
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="../quanly.php">
							<i class='bx bx-home'></i>
							<span class="link_name">Trang chủ</span>
						</a>
					</li>
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="vTTchungnvql.php?ttcnnv">
							<i class='bx bx-user'></i>
							<span class="link_name">Thông tin cá nhân</span>
						</a>
					</li>
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="vTTchungnvql.php?dmknv">
							<i class='bx bx-reset'></i>
							<span class="link_name">Đổi mật khẩu</span>
						</a>
					</li>
				</ul>

				<p style="margin-top: -170px; color: #fff; text-align: center; margin-right: 10px;">
					Nhóm 660 <br>
					Hà Thiên Phúc - 19437521 <br>
					Nguyễn Thanh Tân - 19454801
				</p>
			</div>

			<section class="home-section">
				<nav class="hero" style="background-color: #27ae60;">
					<div class="home-content">
						<i class='bx bx-menu'></i>
						<i class='bx bxs-book'></i>
						<span class="text">ITBOOK</span>
					</div>

					<ul style="margin-bottom: -5px;">
						<li>
							<i class='bx bx-home'></i>
							<a href="../quanly.php">Trang chủ</a>
						</li>
					</ul>

					<?php
					if (isset($_SESSION['user_name'])) {
						$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
					?>
						<img src="../Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

						<div class="submenu-system" id="subMenu">
							<div class="submenu">
								<div class="ttcn">
									<img src="../Image/<?php echo $hinhanh; ?>">
								<?php } ?>

								<h3><?php echo $_SESSION['user_name']; ?></h3>
								</div>

								<hr>

								<a href="vTTchungnvql.php" class="submenulink" style="margin-top: 15px;">
									<i class='bx bx-user'></i>
									<p style="margin: 0;">Thông tin cá nhân</p>
									<span> > </span>
								</a>

								<a href="../logout_nvql.php" class="submenulink" style="margin-top: 15px; margin-bottom: 10px;">
									<i class='bx bx-log-out'></i>
									<p style="margin: 0;">Đăng xuất</p>
									<span> > </span>
								</a>
							</div>
						</div>
				</nav>

				<div class="ncc" style="background-color: #E4E9F7; height: 750px;">
					<?php
					if (isset($_REQUEST["ttcnnv"])) {
						include_once("vTTcanhannv.php");
					}

					if (isset($_REQUEST["dmknv"])) {
						include_once("vDmknv.php");
					}

					if (!isset($_REQUEST["ttcnnv"]) && !isset($_REQUEST["dmknv"])) {
						include_once("vTTcanhannv.php");
					}
					?>
				</div>
			</section>

		<?php
		} elseif ($_SESSION['nguoidung'] == 'Nhân viên giao hàng') {
			$tendnnv = $_SESSION['user_name'];
			$query = "SELECT * FROM taikhoan tk JOIN nhanvien nv ON tk.matk = nv.matk WHERE tendn = '$tendnnv'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($result);
		?>

			<div class="sidebar" style="background-color: #27ae60;">
				<div class="logo-ct">
					<i class='bx bxs-book'></i>
					<span class="logo_name">ITBOOK</span>
				</div>

				<ul class="nav-links">
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="../quanly.php">
							<i class='bx bx-home'></i>
							<span class="link_name">Trang chủ</span>
						</a>
					</li>
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="vTTchungnvql.php?ttcnnvgh">
							<i class='bx bx-user'></i>
							<span class="link_name">Thông tin cá nhân</span>
						</a>
					</li>
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="vTTchungnvql.php?dmknvgh">
							<i class='bx bx-reset'></i>
							<span class="link_name">Đổi mật khẩu</span>
						</a>
					</li>
				</ul>

				<p style="margin-top: -170px; color: #fff; text-align: center; margin-right: 10px;">
					Nhóm 660 <br>
					Hà Thiên Phúc - 19437521 <br>
					Nguyễn Thanh Tân - 19454801
				</p>
			</div>

			<section class="home-section">
				<nav class="hero" style="background-color: #27ae60;">
					<div class="home-content">
						<i class='bx bx-menu'></i>
						<i class='bx bxs-book'></i>
						<span class="text">ITBOOK</span>
					</div>

					<ul style="margin-bottom: -5px;">
						<li>
							<i class='bx bx-home'></i>
							<a href="../quanly.php">Trang chủ</a>
						</li>
					</ul>

					<?php
					if (isset($_SESSION['user_name'])) {
						$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
					?>
						<img src="../Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

						<div class="submenu-system" id="subMenu">
							<div class="submenu">
								<div class="ttcn">
									<img src="../Image/<?php echo $hinhanh; ?>">
								<?php } ?>

								<h3><?php echo $_SESSION['user_name']; ?></h3>
								</div>

								<hr>

								<a href="vTTchungnvql.php" class="submenulink" style="margin-top: 15px;">
									<i class='bx bx-user'></i>
									<p style="margin: 0;">Thông tin cá nhân</p>
									<span> > </span>
								</a>

								<a href="../logout_nvql.php" class="submenulink" style="margin-top: 15px; margin-bottom: 10px;">
									<i class='bx bx-log-out'></i>
									<p style="margin: 0;">Đăng xuất</p>
									<span> > </span>
								</a>
							</div>
						</div>
				</nav>

				<div class="ncc" style="background-color: #E4E9F7; height: 750px;">
					<?php
					if (isset($_REQUEST["ttcnnvgh"])) {
						include_once("vTTcanhannv.php");
					}

					if (isset($_REQUEST["dmknvgh"])) {
						include_once("vDmknv.php");
					}

					if (!isset($_REQUEST["ttcnnvgh"]) && !isset($_REQUEST["dmknvgh"])) {
						include_once("vTTcanhannv.php");
					}
					?>
				</div>
			</section>
	<?php
		}
	} else {
		echo '<script>
                    alert("Bạn vui lòng đăng nhập");
                    window.location.href="login_nvql.php";
                </script>';
	}
	?>

	<script>
		let arrow = document.querySelectorAll(".arrow");
		for (var i = 0; i < arrow.length; i++) {
			arrow[i].addEventListener("click", (e) => {
				let arrowParent = e.target.parentElement.parentElement;
				arrowParent.classList.toggle("showMenu");
			});
		}

		let sidebar = document.querySelector(".sidebar");
		let sidebarBtn = document.querySelector(".bx-menu");
		console.log(sidebarBtn);
		sidebarBtn.addEventListener("click", () => {
			sidebar.classList.toggle("close");
		});

		let subMenu = document.getElementById("subMenu");

		function toggleMenu() {
			subMenu.classList.toggle("open-menu");
		}
	</script>
</body>

</html>