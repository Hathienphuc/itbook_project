<?php
include_once(__DIR__ . "/Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (isset($_SESSION['makh'])) {
	$makh = $_SESSION['makh'];
	$query = "SELECT * FROM khachhang WHERE makh = '$makh'";
	$result = mysqli_query($con, $query);
}

if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
} else {
	echo '<script>alert("Không tìm thấy thông tin khách hàng.")</script>';
}

if (isset($_POST['update_info'])) {
	$tenkh = $_POST['tenkh'];
	$diachi = $_POST['diachi'];
	$sodienthoai = $_POST['sodienthoai'];
	$email = $_POST['email'];
	$hinhanh = $_FILES['hinhanh']['name'];
	$tmp = $_FILES['hinhanh']['tmp_name'];
	move_uploaded_file($tmp, "Image/" . $hinhanh);
	$makh = $_SESSION['makh'];
	$query = "UPDATE khachhang SET tenkh = '$tenkh', diachi = '$diachi', sodienthoai = '$sodienthoai', email = '$email', hinhanh = '$hinhanh' WHERE makh = '$makh'";
	$result = mysqli_query($con, $query);

	if ($result) {
		$query = "SELECT * FROM khachhang WHERE makh = '$makh'";
		$result = mysqli_query($con, $query);

		if ($result && mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			echo '<script type="text/javascript">';
			echo 'alert("Cập nhật thông tin thành công.");';
			echo 'window.location="thongtinchung.php";';
			echo '</script>';
		} else {
			echo '<script type="text/javascript">';
			echo 'alert("Cập nhật thông tin thất bại.");';
			echo '</script>';
		}
	}
}

mysqli_close($con);
?>

<h1 style="margin-top: -5px; text-align: center; margin-left: -300px;">Cập nhật thông tin cá nhân</h1>

<div class="info-container" style="margin-left: -10px;">
	<h2>Thông tin tài khoản</h2>

	<form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
		<label for="tenkh">Tên khách hàng:</label>
		<input type="text" id="tenkh" name="tenkh" value="<?php echo $row['tenkh']; ?>" required>
		<label for="diachi">Địa chỉ:</label>
		<input type="text" id="diachi" name="diachi" value="<?php echo $row['diachi']; ?>" required>
		<label for="sodienthoai">Số điện thoại:</label>
		<input type="text" id="sodienthoai" name="sodienthoai" value="<?php echo $row['sodienthoai']; ?>" required>
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
		<label for="hinhanh">Hình ảnh:</label>
		<input type="file" id="hinhanh" name="hinhanh" required>
		<input type="submit" name="update_info" value="Cập nhật">
		<input type="reset" value="Reset">
	</form>
</div>

<script>
	function validateForm() {
		var email = document.getElementById("email").value;
		var sodienthoai = document.getElementById("sodienthoai").value;
		var hinhanh = document.getElementById("hinhanh").value;
		var emailRegex = /\S+@\S+\.\S+/;
		if (!emailRegex.test(email)) {
			alert("Email không đúng định dạng!");
			return false;
		}
		var sodienthoaiRegex = /^0[0-9]{9}$/;
		if (!sodienthoaiRegex.test(sodienthoai)) {
			alert("Số điện thoại không đúng định dạng!");
			return false;
		}
		var hinhanhRegex = /\.(jpeg|jpg|png)$/;
		if (!hinhanhRegex.test(hinhanh)) {
			alert("Chỉ cho upload hình ảnh có định dạng JPEG, PNG, JPG!");
			return false;
		}
		return true;
	}
</script>