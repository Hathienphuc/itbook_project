<?php
session_start();
include_once(__DIR__ . "/Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();
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
	<link rel="stylesheet" href="CSS/jquery.fancybox.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<style>
		#micro:hover {
			border-radius: 20%;
			background-color: rgba(0, 0, 0, 0.2);
			width: 70%;
			padding-top: 7px;
			padding-bottom: 5px;
			margin-bottom: 35px;
			color: whitesmoke;
		}

		#cart-icon {
			position: fixed;
			top: 30%;
			right: 0;
			margin-right: 20px;
			border-radius: 100%;
			overflow: hidden;
		}

		#cart-icon span {
			display: block;
			color: black;
			position: absolute;
			top: 18px;
			right: 14px;
			background: whitesmoke;
			padding: 5px;
			border-radius: 100%;
			font-size: 13px;
			font-family: 'Lora', serif;
			margin-top: -5px;
			font-weight: bold;
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

					<div class="col-md-6 d-md-flex justify-content-end mb-md-0 mb-3">
						<form action="#" class="searchform order-lg-last" style="margin-right: -420px; margin-top:15px; width: 55%;" method="POST">
							<div class="form-group d-flex" style="width: 106%;">
								<input type="text" class="form-control pl-3" placeholder="Nhập từ khóa..." id="spoken-text" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
								<button type="button" class="form-control" style="width:fit-content;" id="voice"><span class="fa fa-microphone" id="micro" style="font-size: 18px; margin-top:3px; margin-right: 30px;"></span></button>
							</div>
						</form>
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
					<h1 class="mb-0 bread">Sản phẩm</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section" id="search-results">
		<div class="container">
			<div class="row justify-content-center mb-4">
				<div class="col-md-10">
					<div class="row mb-4">
						<div class="col-md-12 d-flex justify-content-between align-items-center">
							<?php if (!isset($_GET['keyword'])) { ?>
								<h4 class="product-select" style="margin-left: -200px;">
									Chọn loại sản phẩm
								</h4>
							<?php } ?>

							<?php if (!isset($_GET['keyword'])) { ?>
								<form method="GET" id="category_form" style="margin-right: 700px;">
									<select class="selectpicker" name="category" onchange="document.getElementById('category_form').submit();">
										<option value="<?php echo base64_encode('all'); ?>"
											<?php
											if (!isset($_GET['category']))
												echo "selected";
											?>>Tất cả</option>

										<?php
										$category = "SELECT * FROM loaisanpham ORDER BY maloai ASC";
										$result_cate = mysqli_query($con, $category);
										while ($row = mysqli_fetch_array($result_cate)) {
											$selected = '';
											if (isset($_GET['category']) && base64_decode($_GET['category']) == $row['maloai']) {
												$selected = 'selected';
											}
										?>

											<option
												value="<?php echo base64_encode($row['maloai']); ?>"
												<?php echo $selected; ?>>
												<?php echo $row['tenloai']; ?>
											</option>
										<?php } ?>
									</select>
								</form>
							<?php } ?>
						</div>

						<div class="sort-buttons <?php echo isset($_GET['keyword']) ? 'search-mode' : ''; ?>">
							<h4>Lọc sản phẩm theo giá</h4>
							<button onclick="sortAsc()">Giá từ thấp đến cao</button>
							<button onclick="sortDesc()">Giá từ cao đến thấp</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid px-md-5">
			<div class="row">
				<?php
				if (isset($_GET['sort']) && $_GET['sort'] != "") {
					$_SESSION['sort'] = $_GET['sort'];
				} else {
					unset($_SESSION['sort']);
				}

				if (isset($_GET['keyword']) && $_GET['keyword'] != "") {
					$keyword = mysqli_real_escape_string($con, $_GET['keyword']);
					$sql = "SELECT * FROM sanpham WHERE tensp LIKE '%$keyword%' OR maloai IN (SELECT maloai FROM loaisanpham WHERE tenloai LIKE '%$keyword%')";

					if (isset($_SESSION['sort'])) {
						if ($_SESSION['sort'] == "asc") {
							$sql .= " ORDER BY giaban ASC";
						} elseif ($_SESSION['sort'] == "desc") {
							$sql .= " ORDER BY giaban DESC";
						}
					}
					$result = mysqli_query($con, $sql);

					if (mysqli_num_rows($result) == 0) {
						echo '<script>
								alert("Không tìm thấy sản phẩm");
								window.location.href = "sanpham.php";
							</script>';
						exit();
					}
				} else {
					$items_per_page = 6;
					$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
					$start = ($current_page - 1) * $items_per_page;
					if (!empty($_SESSION['sort'])) {
						if ($_SESSION['sort'] == 'asc') {
							$product = "SELECT * FROM sanpham ORDER BY giaban ASC LIMIT $start, $items_per_page";
						} elseif ($_SESSION['sort'] == 'desc') {
							$product = "SELECT * FROM sanpham ORDER BY giaban DESC LIMIT $start, $items_per_page";
						}
					} else {
						$product = "SELECT * FROM sanpham LIMIT $start, $items_per_page";
					}

					if (isset($_GET['category'])) {
						$category = base64_decode($_GET['category']);

						if ($category == 'all') {
							$sql = "SELECT * FROM sanpham";

							if (isset($_SESSION['sort'])) {
								if ($_SESSION['sort'] == "asc")
									$sql .= " ORDER BY giaban ASC";
								elseif ($_SESSION['sort'] == "desc")
									$sql .= " ORDER BY giaban DESC";
							}
							$sql .= " LIMIT $start,$items_per_page";
						} else {
							$sql = "SELECT * FROM sanpham WHERE maloai='$category'";

							if (isset($_SESSION['sort'])) {
								if ($_SESSION['sort'] == "asc")
									$sql .= " ORDER BY giaban ASC";
								elseif ($_SESSION['sort'] == "desc")
									$sql .= " ORDER BY giaban DESC";
							}
						}
						$result = mysqli_query($con, $sql);
					} else {
						$result = mysqli_query($con, $product);
					}
				}
				while ($row = mysqli_fetch_array($result)) {
				?>

					<div class="col-md-6 col-lg-4 d-flex">
						<div class="book-wrap d-lg-flex">
							<div class="img d-flex justify-content-end" style="background-image: url(Image/<?php echo $row['hinhanh']; ?>);">
								<div class="in-text">
									<?php
									if (isset($_SESSION['tendn'])) {
									?>
										<form class="giohang" action="processcart.php?action=add" method="POST" data-available="<?php echo ($row['soluong'] > 0 ? '1' : '0'); ?>">
											<input type="hidden" style="width: 10%; height: 10%;" value="1" name="soluong[<?php echo $row['masp'] ?>]" />
											<a class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Thêm vào giỏ hàng">
												<span class="flaticon-shopping-cart"></span>
											</a>
										</form>
									<?php } ?>

									<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Xem chi tiết" onclick="viewDetail(<?php echo $row['masp']; ?>)">
										<span class="flaticon-visibility"></span>
									</a>
								</div>
							</div>

							<div class="text p-4">
								<p class="mb-2"><span class="price" style="font-size: 20px;"><?php echo number_format($row['giaban'], 0, ',', '.'); ?> VNĐ</span></p>
								<h2><a href="#"><?php echo $row['tensp']; ?></a></h2>
								<span class="position">Tác giả: <?php echo $row['tacgia']; ?></span>

								<span>
									<?php
									if ($row['soluong'] > 0) {
									?>
										<strong style="color: #ff7a5c; font-size: 20px; font-family: 'Lora', serif;">Còn hàng</strong>
									<?php } else { ?>
										<strong style="color: #ff7a5c; font-size: 20px; font-family: 'Lora', serif;">Hết hàng</strong>
									<?php } ?>
								</span>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

			<?php
			if (!isset($_GET['keyword']) && (!isset($_GET['category']) || base64_decode($_GET['category']) == 'all')) {
			?>
				<div class="row mt-5">
					<div class="col text-center">
						<div class="block-27">
							<ul>
								<?php
								$items_per_page = 6;
								$product_count = "SELECT COUNT(*) as total FROM sanpham";
								$result_count = mysqli_query($con, $product_count);
								$row_count = mysqli_fetch_assoc($result_count);
								$total_pages = ceil($row_count['total'] / $items_per_page);
								$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

								if ($current_page > 1) {
									echo '<li><a href="?page=' . ($current_page - 1) . '">&lt;</a></li>';
								}

								for ($i = 1; $i <= $total_pages; $i++) {
									if ($i == $current_page) {
										echo '<li class="active"><span>' . $i . '</span></li>';
									} else {
										echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
									}
								}

								if ($current_page < $total_pages) {
									echo '<li><a href="?page=' . ($current_page + 1) . '">&gt;</a></li>';
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</section>

	<?php
	include_once(__DIR__ . "/functioncart.php");
	$totalQuantity = getTotalQuantity();

	if (isset($_SESSION['tendn'])) {
	?>
		<div id="cart-icon">
			<span><?php echo $totalQuantity ?></span>
			<a data-fancybox data-type="ajax" data-src="cart.php" href="javascript:;">
				<img width="90" src="Image/cart-icon.png" />
			</a>
		</div>
	<?php } ?>

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
	<script src="JS/jquery.validate.min.js"></script>
	<script src="JS/jquery.fancybox.min.js"></script>
	<script src="JS/search.js"></script>
	<script src="JS/cart.js"></script>

	<script>
		let subMenu = document.getElementById("subMenu");

		function toggleMenu() {
			subMenu.classList.toggle("open-menu");
		}

		function viewDetail(productId) {
			const encodedProductId = btoa(productId);
			window.location.href = `detail.php?masp=${encodedProductId}`;
		}

		function sortAsc() {
			currentSort = "asc";
			const params = new URLSearchParams(window.location.search);
			var keyword = $("#spoken-text").val().trim();
			var category = params.get("category");

			if (keyword != "") {
				window.location.href = "sanpham.php?keyword=" + encodeURIComponent(keyword) + "&sort=" + currentSort;
			} else if (category != null) {
				window.location.href = "sanpham.php?category=" + category + "&sort=" + currentSort;
			} else {
				window.location.href = "sanpham.php?sort=" + currentSort;
			}
		}

		function sortDesc() {
			currentSort = "desc";
			const params = new URLSearchParams(window.location.search);
			var keyword = $("#spoken-text").val().trim();
			var category = params.get("category");

			if (keyword != "") {
				window.location.href = "sanpham.php?keyword=" + encodeURIComponent(keyword) + "&sort=" + currentSort;
			} else if (category != null) {
				window.location.href = "sanpham.php?category=" + category + "&sort=" + currentSort;
			} else {
				window.location.href = "sanpham.php?sort=" + currentSort;
			}
		}

		sessionStorage.setItem("currentPage", window.location.pathname + window.location.search);
	</script>
</body>

</html>