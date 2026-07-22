<?php
session_start();
include_once(__DIR__ . "/Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();
?>

<div class="container">
	<div class="row justify-content-center mb-4">
		<div class="col-md-10">
			<div class="row mb-4">
				<div class="sort-buttons" style="margin-bottom: -10px; margin-left:-280px;">
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
		$items_per_page = 6;
		$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$start = ($current_page - 1) * $items_per_page;

		if (isset($_GET['sort'])) {
			$_SESSION['sort'] = $_GET['sort'];
		}

		if (isset($_POST["q"])) {
			$search = $con->real_escape_string(urldecode($_POST["q"]));
			$sort = isset($_POST['sort']) ? $_POST['sort'] : '';

			if ($sort == 'asc') {
				if ($search == '') {
					$timkiem = "SELECT * FROM sanpham WHERE giaban > 0 ORDER BY giaban ASC";
				} else {
					$timkiem = "SELECT * FROM sanpham WHERE (tensp LIKE '%$search%' OR maloai IN (SELECT maloai FROM loaisanpham WHERE tenloai LIKE '%$search%')) AND giaban > 0 ORDER BY giaban ASC";
				}
			} elseif ($sort == 'desc') {
				if ($search == '') {
					$timkiem = "SELECT * FROM sanpham WHERE giaban > 0 ORDER BY giaban DESC";
				} else {
					$timkiem = "SELECT * FROM sanpham WHERE (tensp LIKE '%$search%' OR maloai IN (SELECT maloai FROM loaisanpham WHERE tenloai LIKE '%$search%')) AND giaban > 0 ORDER BY giaban DESC";
				}
			} else {
				if ($search == '') {
					$timkiem = "SELECT * FROM sanpham WHERE giaban > 0";
				} else {
					$timkiem = "SELECT * FROM sanpham WHERE (tensp LIKE '%$search%' OR maloai IN (SELECT maloai FROM loaisanpham WHERE tenloai LIKE '%$search%')) AND giaban > 0";
				}
			}
			$result = mysqli_query($con, $timkiem);

			if (mysqli_num_rows($result) > 0) {
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
		<?php
				}
			} else {
				echo '<script>
						alert("Không tìm thấy sản phẩm");
						window.location.href = sessionStorage.getItem("currentPage");
					</script>';
			}
		}
		?>
	</div>
</div>

<script src="JS/cart.js"></script>