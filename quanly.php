<?php
session_start();
include_once(__DIR__ . "/Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ITBOOK</title>

	<link rel="stylesheet" href="CSS/quanly.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

			<div class="sidebar">
				<div class="logo-ct">
					<i class='bx bxs-book'></i>
					<span class="logo_name">ITBOOK</span>
				</div>

				<ul class="nav-links">
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="quanly.php">
							<i class='bx bx-home'></i>
							<span class="link_name">Trang chủ</span>
						</a>
					</li>

					<li style="margin-left:-4px;">
						<div class="icon-link">
							<a href="#">
								<i class='bx bx-collection'></i>
								<span class="link_name">Quản lý</span>
							</a>

							<i class='bx bxs-chevron-down arrow'></i>
						</div>

						<ul class="menucon">
							<li><a class="link_name">Quản lý</a></li>
							<li style="margin-top: 5px;"><a href="quanly.php?tkhoan">Tài khoản</a></li>
							<li style="margin-top: 5px;"><a href="quanly.php?nvien">Nhân viên</a></li>
							<li style="margin-top: 5px;"><a href="quanly.php?spham">Sản phẩm</a></li>
							<li style="margin-top: 5px;"><a href="quanly.php?dmuc">Danh mục</a></li>
							<li style="margin-top: 5px;"><a href="quanly.php?nccap">Nhà cung cấp</a></li>
							<li style="margin-top: 5px;"><a href="quanly.php?dhang">Đơn hàng</a></li>
							<li style="margin-top: 5px; margin-bottom: -5px;"><a href="quanly.php?khang">Khách hàng</a></li>
						</ul>
					</li>
				</ul>

				<p style="margin-top: -170px; color: #fff; text-align: center; margin-right: 10px;">
					Nhóm 660 <br>
					Hà Thiên Phúc - 19437521 <br>
					Nguyễn Thanh Tân - 19454801
				</p>
			</div>

			<section class="home-section">
				<nav class="hero">
					<div class="home-content">
						<i class='bx bx-menu'></i>
						<i class='bx bxs-book'></i>
						<span class="text">ITBOOK</span>
					</div>

					<ul style="margin-bottom: -5px;">
						<li>
							<i class='bx bx-home'></i>
							<a href="quanly.php">Trang chủ</a>
						</li>
					</ul>

					<?php
					if (isset($_SESSION['user_name'])) {
						$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
					?>
						<img src="Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

						<div class="submenu-system" id="subMenu">
							<div class="submenu">
								<div class="ttcn">
									<img src="Image/<?php echo $hinhanh; ?>">
								<?php } ?>

								<h3><?php echo $_SESSION['user_name']; ?></h3>
								</div>

								<hr>

								<a href="View/vTTchungnvql.php" class="submenulink" style="margin-top: 15px;">
									<i class='bx bx-user'></i>
									<p style="margin: 0;">Thông tin cá nhân</p>
									<span> > </span>
								</a>

								<a href="logout_nvql.php" class="submenulink" style="margin-top: 15px; margin-bottom: 10px;">
									<i class='bx bx-log-out'></i>
									<p style="margin: 0;">Đăng xuất</p>
									<span> > </span>
								</a>
							</div>
						</div>
				</nav>

				<div class="ncc" style="background-color: #E4E9F7;">
					<?php
					if (isset($_REQUEST["nccap"])) {
						include_once("View/vNhacc.php");
					}

					if (isset($_REQUEST["dmuc"])) {
						include_once("View/vDmuc.php");
					}

					if (isset($_REQUEST["spham"])) {
						include_once("View/vSpham.php");
					}

					if (isset($_REQUEST["tkhoan"])) {
						include_once("View/vTkhoan.php");
					}

					if (isset($_REQUEST["nvien"])) {
						include_once("View/vNvien.php");
					}

					if (isset($_REQUEST["khang"])) {
						include_once("View/vKhang.php");
					}

					if (isset($_REQUEST["dhang"])) {
						include_once("View/vDhang.php");
					}

					if (isset($_REQUEST["xemdhang"])) {
						include_once("View/vXemDhang.php");
					}

					if (!isset($_REQUEST["nccap"]) && !isset($_REQUEST["dmuc"]) && !isset($_REQUEST["spham"]) && !isset($_REQUEST["tkhoan"]) && !isset($_REQUEST["nvien"]) && !isset($_REQUEST["khang"]) && !isset($_REQUEST["dhang"]) && !isset($_REQUEST["xemdhang"])) {
						echo '<b style="font-size: 30px; margin-left: 35%; ">TRANG DÀNH CHO QUẢN LÝ</b>';
					}
					?>
				</div>

				<div class="hidden-element">
					<div class="container">
						<div class="card bg-primary text-white ">
							<div class="card-body">Tài khoản
								<?php
								$query_tk = "SELECT * FROM taikhoan";
								$result_tk = mysqli_query($con, $query_tk);

								if ($result_tk) {
									$tong_tk = mysqli_num_rows($result_tk);
									if ($tong_tk > 0) {
										echo '<h4 class="mb-0">' . $tong_tk . '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có tài khoản</h4>';
									}
								}
								?>
							</div>

							<div class="card-footer d-flex align-items-center justify-content-between">
								<a class="small text-white" href="quanly.php?tkhoan">Xem chi tiết</a>
								<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
							</div>
						</div>

						<div class="card bg-success text-white">
							<div class="card-body">Nhân viên
								<?php
								$query_nv = "SELECT * FROM nhanvien";
								$result_nv = mysqli_query($con, $query_nv);

								if ($result_nv) {
									$tong_nv = mysqli_num_rows($result_nv);
									if ($tong_nv > 0) {
										echo '<h4 class="mb-0">' . $tong_nv . '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có nhân viên</h4>';
									}
								}
								?>
							</div>

							<div class="card-footer d-flex align-items-center justify-content-between">
								<a class="small text-white" href="quanly.php?nvien">Xem chi tiết</a>
								<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
							</div>
						</div>

						<div class="card bg-sp text-white">
							<div class="card-body">Sản phẩm
								<?php
								$query_sp = "SELECT * FROM sanpham";
								$result_sp = mysqli_query($con, $query_sp);

								if ($result_sp) {
									$tong_sp = mysqli_num_rows($result_sp);
									if ($tong_sp > 0) {
										echo '<h4 class="mb-0">' . $tong_sp . '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có nhân viên</h4>';
									}
								}
								?>
							</div>

							<div class="card-footer d-flex align-items-center justify-content-between">
								<a class="small text-white" href="quanly.php?spham">Xem chi tiết</a>
								<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
							</div>
						</div>

						<div class="card bg-dm text-white">
							<div class="card-body">Danh mục
								<?php
								$query_dm = "SELECT * FROM loaisanpham";
								$result_dm = mysqli_query($con, $query_dm);

								if ($result_dm) {
									$tong_dm = mysqli_num_rows($result_dm);
									if ($tong_dm > 0) {
										echo '<h4 class="mb-0">' . $tong_dm . '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có nhân viên</h4>';
									}
								}
								?>
							</div>

							<div class="card-footer d-flex align-items-center justify-content-between">
								<a class="small text-white" href="quanly.php?dmuc">Xem chi tiết</a>
								<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
							</div>
						</div>

						<div class="card bg-ncc text-white">
							<div class="card-body">Nhà cung cấp
								<?php
								$query_ncc = "SELECT * FROM nhacungcap";
								$result_ncc = mysqli_query($con, $query_ncc);

								if ($result_ncc) {
									$tong_ncc = mysqli_num_rows($result_ncc);
									if ($tong_ncc > 0) {
										echo '<h4 class="mb-0">' . $tong_ncc . '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có nhân viên</h4>';
									}
								}
								?>
							</div>

							<div class="card-footer d-flex align-items-center justify-content-between">
								<a class="small text-white" href="quanly.php?nccap">Xem chi tiết</a>
								<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
							</div>
						</div>

						<div class="card bg-danger text-white">
							<div class="card-body">Đơn hàng
								<?php
								$query_hd = "SELECT * FROM hoadon";
								$result_hd = mysqli_query($con, $query_hd);

								if ($result_hd) {
									$tong_hd = mysqli_num_rows($result_hd);
									if ($tong_hd > 0) {
										echo '<h4 class="mb-0">' . $tong_hd . '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có đơn hàng</h4>';
									}
								}
								?>
							</div>

							<div class="card-footer d-flex align-items-center justify-content-between">
								<a class="small text-white" href="quanly.php?dhang">Xem chi tiết</a>
								<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
							</div>
						</div>

						<div class="card bg-warning text-white">
							<div class="card-body">Khách hàng
								<?php
								$query_kh = "SELECT * FROM khachhang";
								$result_kh = mysqli_query($con, $query_kh);

								if ($result_kh) {
									$tong_kh = mysqli_num_rows($result_kh);
									if ($tong_kh > 0) {
										echo '<h4 class="mb-0">' . $tong_kh . '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có khách hàng</h4>';
									}
								}
								?>
							</div>

							<div class="card-footer d-flex align-items-center justify-content-between">
								<a class="small text-white" href="quanly.php?khang">Xem chi tiết</a>
								<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php
		} elseif ($_SESSION['nguoidung'] == 'Nhân viên bán hàng') {
			$tendnnv = $_SESSION['user_name'];
			$query = "SELECT * FROM taikhoan tk JOIN nhanvien nv ON tk.matk = nv.matk WHERE tendn = '$tendnnv'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($result);
		?>

			<div class="sidebar">
				<div class="logo-ct">
					<i class='bx bxs-book'></i>
					<span class="logo_name">ITBOOK</span>
				</div>

				<ul class="nav-links">
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="quanly.php">
							<i class='bx bx-home'></i>
							<span class="link_name">Trang chủ</span>
						</a>
					</li>

					<li style="margin-left:-4px;">
						<div class="icon-link">
							<a href="#">
								<i class='bx bx-collection'></i>
								<span class="link_name">Quản lý</span>
							</a>

							<i class='bx bxs-chevron-down arrow'></i>
						</div>

						<ul class="menucon">
							<li><a class="link_name">Quản lý</a></li>
							<li style="margin-top: 5px;"><a href="quanly.php?dhang">Đơn hàng</a></li>
							<li style="margin-top: 5px; margin-bottom: -5px;"><a href="quanly.php?khang">Khách hàng</a></li>
						</ul>
					</li>
				</ul>

				<p style="margin-top: -170px; color: #fff; text-align: center; margin-right: 10px;">
					Nhóm 660 <br>
					Hà Thiên Phúc - 19437521 <br>
					Nguyễn Thanh Tân - 19454801
				</p>
			</div>

			<section class="home-section">
				<nav class="hero">
					<div class="home-content">
						<i class='bx bx-menu'></i>
						<i class='bx bxs-book'></i>
						<span class="text">ITBOOK</span>
					</div>

					<ul style="margin-bottom: -5px;">
						<li>
							<i class='bx bx-home'></i>
							<a href="quanly.php">Trang chủ</a>
						</li>
					</ul>

					<?php
					if (isset($_SESSION['user_name'])) {
						$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
					?>
						<img src="Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

						<div class="submenu-system" id="subMenu">
							<div class="submenu">
								<div class="ttcn">
									<img src="Image/<?php echo $hinhanh; ?>">
								<?php } ?>

								<h3><?php echo $_SESSION['user_name']; ?></h3>
								</div>

								<hr>

								<a href="View/vTTchungnvql.php" class="submenulink" style="margin-top: 15px;">
									<i class='bx bx-user'></i>
									<p style="margin: 0;">Thông tin cá nhân</p>
									<span> > </span>
								</a>

								<a href="logout_nvql.php" class="submenulink" style="margin-top: 15px; margin-bottom: 10px;">
									<i class='bx bx-log-out'></i>
									<p style="margin: 0;">Đăng xuất</p>
									<span> > </span>
								</a>
							</div>
						</div>
				</nav>

				<div class="ncc" style="background-color: #E4E9F7;">
					<?php
					if (isset($_REQUEST["khang"])) {
						include_once("View/vKhang.php");
					}

					if (isset($_REQUEST["dhang"])) {
						include_once("View/vDhang.php");
					}

					if (isset($_REQUEST["xemdhang"])) {
						include_once("View/vXemDhang.php");
					}

					if (!isset($_REQUEST["khang"]) && !isset($_REQUEST["dhang"]) && !isset($_REQUEST["xemdhang"])) {
						echo '<b style="font-size: 30px; margin-left: 29%; ">TRANG DÀNH CHO NHÂN VIÊN BÁN HÀNG</b>';
					}
					?>
				</div>

				<div class="hidden-element">
					<div class="container">
						<div class="card bg-warning text-white" style="width: 60%; margin-left: 280px;">
							<div class="card-body">Khách hàng
								<?php
								$query_kh = "SELECT * FROM khachhang";
								$result_kh = mysqli_query($con, $query_kh);
								if ($result_kh) {
									$tong_kh = mysqli_num_rows($result_kh);
									if ($tong_kh > 0) {
										echo '<h4 class="mb-0">' . $tong_kh . '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có khách hàng</h4>';
									}
								}
								?>
							</div>

							<div class="card-footer d-flex align-items-center justify-content-between">
								<a class="small text-white" href="quanly.php?khang">Xem chi tiết</a>
								<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
							</div>
						</div>

						<div class="card bg-danger text-white" style="width: 60%;">
							<div class="card-body">Đơn hàng
								<?php
								$query_hd = "SELECT * FROM hoadon";
								$result_hd = mysqli_query($con, $query_hd);

								if ($result_hd) {
									$tong_hd = mysqli_num_rows($result_hd);
									if ($tong_hd > 0) {
										echo '<h4 class="mb-0">' . $tong_hd . '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có đơn hàng</h4>';
									}
								}
								?>
							</div>

							<div class="card-footer d-flex align-items-center justify-content-between">
								<a class="small text-white" href="quanly.php?dhang">Xem chi tiết</a>
								<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php
		} elseif ($_SESSION['nguoidung'] == 'Nhân viên giao hàng') {
			$tendnnv = $_SESSION['user_name'];
			$query = "SELECT * FROM taikhoan tk JOIN nhanvien nv ON tk.matk = nv.matk WHERE tendn = '$tendnnv'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($result);
		?>

			<div class="sidebar">
				<div class="logo-ct">
					<i class='bx bxs-book'></i>
					<span class="logo_name">ITBOOK</span>
				</div>

				<ul class="nav-links">
					<li style="margin-bottom: 25px; margin-left:-4px;">
						<a href="quanly.php">
							<i class='bx bx-home'></i>
							<span class="link_name">Trang chủ</span>
						</a>
					</li>

					<li style="margin-left:-4px;">
						<div class="icon-link">
							<a href="quanly.php?dhangnvgh">
								<i class='bx bx-collection'></i>
								<span class="link_name">Đơn hàng</span>
							</a>
						</div>
					</li>
				</ul>

				<p style="margin-top: -170px; color: #fff; text-align: center; margin-right: 10px;">
					Nhóm 660 <br>
					Hà Thiên Phúc - 19437521 <br>
					Nguyễn Thanh Tân - 19454801
				</p>
			</div>

			<section class="home-section">
				<nav class="hero">
					<div class="home-content">
						<i class='bx bx-menu'></i>
						<i class='bx bxs-book'></i>
						<span class="text">ITBOOK</span>
					</div>

					<ul style="margin-bottom: -5px;">
						<li>
							<i class='bx bx-home'></i>
							<a href="quanly.php">Trang chủ</a>
						</li>
					</ul>

					<?php
					if (isset($_SESSION['user_name'])) {
						$hinhanh = ($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg';
					?>
						<img src="Image/<?php echo $hinhanh; ?>" class="user" onclick="toggleMenu()">

						<div class="submenu-system" id="subMenu">
							<div class="submenu">
								<div class="ttcn">
									<img src="Image/<?php echo $hinhanh; ?>">
								<?php } ?>

								<h3><?php echo $_SESSION['user_name']; ?></h3>
								</div>

								<hr>

								<a href="View/vTTchungnvql.php" class="submenulink" style="margin-top: 15px;">
									<i class='bx bx-user'></i>
									<p style="margin: 0;">Thông tin cá nhân</p>
									<span> > </span>
								</a>

								<a href="logout_nvql.php" class="submenulink" style="margin-top: 15px; margin-bottom: 10px;">
									<i class='bx bx-log-out'></i>
									<p style="margin: 0;">Đăng xuất</p>
									<span> > </span>
								</a>
							</div>
						</div>
				</nav>

				<div class="ncc" style="background-color: #E4E9F7;">
					<?php
					if (isset($_REQUEST["dhangnvgh"])) {
						include_once("View/vDhangnvgh.php");
					}

					if (isset($_REQUEST["xemdhang"])) {
						include_once("View/vXemDhang.php");
					}

					if (!isset($_REQUEST["dhangnvgh"]) && !isset($_REQUEST["xemdhang"])) {
						echo '<b style="font-size: 30px; margin-left: 28%; ">TRANG DÀNH CHO NHÂN VIÊN GIAO HÀNG</b>';
					}
					?>
				</div>

				<div class="hidden-element">
					<div class="container">
						<div class="card bg-danger text-white" style="width: 30%; margin-left: 510px;">
							<div class="card-body">Đơn hàng
								<?php
								$query_hd = "SELECT * FROM hoadon";
								$result_hd = mysqli_query($con, $query_hd);

								if ($result_hd) {
									$tong_hd = mysqli_num_rows($result_hd);
									if ($tong_hd > 0) {
										echo '<h4 class="mb-0">' . $tong_hd . '</h4>';
									} else {
										echo '<h4 class="mb-0">Không có đơn hàng</h4>';
									}
								}
								?>
							</div>

							<div class="card-footer d-flex align-items-center justify-content-between">
								<a class="small text-white" href="quanly.php?dhangnvgh">Xem chi tiết</a>
								<div class="small text-white"> <i class="fas fa-angle-right"></i></div>
							</div>
						</div>
					</div>
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