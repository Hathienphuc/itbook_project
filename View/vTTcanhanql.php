<?php
include_once(__DIR__ . "/../Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (isset($_SESSION['maql'])) {
	$maql = $_SESSION['maql'];
	$query = "SELECT * FROM quanly WHERE maql = '$maql'";
	$result = mysqli_query($con, $query);
}

if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
} else {
	echo '<script>alert("Không tìm thấy thông tin quản lý.")</script>';
}

if (isset($_POST['update_info'])) {
	$tenql = $_POST['tenql'];
	$diachi = $_POST['diachi'];
	$sodienthoai = $_POST['sodienthoai'];
	$email = $_POST['email'];
	$hinhanh = $_FILES['hinhanh']['name'];
	$tmp = $_FILES['hinhanh']['tmp_name'];
	move_uploaded_file($tmp, "../Image/" . $hinhanh);
	$maql = $_SESSION['maql'];
	$query = "UPDATE quanly SET tenql = '$tenql', diachi = '$diachi', sodienthoai = '$sodienthoai', email = '$email', hinhanh = '$hinhanh' WHERE maql = '$maql'";
	$result = mysqli_query($con, $query);
	if ($result) {
		$query = "SELECT * FROM quanly WHERE maql = '$maql'";
		$result = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			echo '<script type="text/javascript">';
			echo 'alert("Cập nhật thông tin thành công.");';
			echo 'window.location="vTTchungnvql.php";';
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

<h1 style="margin: 24px 0; text-align: center; font-size: 30px;">Cập nhật thông tin cá nhân</h1>

<div class="info-container" style="width: 50%; margin: 0 auto;">
	<h2>Thông tin tài khoản</h2>

	<form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
		<label for="tenql">Tên quản lý:</label>
		<input type="text" id="tenql" name="tenql" value="<?php echo $row['tenql']; ?>" required>
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