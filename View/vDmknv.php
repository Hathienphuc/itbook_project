<?php
include_once(__DIR__ . "/../Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (isset($_SESSION['user_name'])) {
	$tendn = $_SESSION['user_name'];
	$query = "SELECT * FROM taikhoan WHERE tendn = '$tendn'";
	$result = mysqli_query($con, $query);
}

if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
} else {
	echo '<script>alert("Không tìm thấy thông tin mật khẩu.")</script>';
}

if (isset($_POST['changepass'])) {
	$matkhaucu = isset($_POST['matkhaucu']);
	$matkhau = md5($_POST['matkhau']);
	$matkhaunl = md5($_POST['matkhaunl']);
	$tendn = $_SESSION['user_name'];
	if ($matkhau == $row['matkhau']) {
		echo '<script type="text/javascript">';
		echo 'alert("Mật khẩu mới phải khác mật khẩu cũ.");';
		echo '</script>';
	} else {
		$query = "UPDATE taikhoan SET matkhau = '$matkhau' WHERE tendn = '$tendn'";
		$result = mysqli_query($con, $query);
		if ($result) {
			$query = "SELECT * FROM taikhoan WHERE tendn = '$tendn'";
			$result = mysqli_query($con, $query);
			if ($result && mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				echo '<script type="text/javascript">';
				echo 'alert("Đổi mật khẩu thành công.");';
				echo '</script>';
			} else {
				echo '<script type="text/javascript">';
				echo 'alert("Đổi mật khẩu thất bại.");';
				echo '</script>';
			}
		}
	}
}
?>

<h1 style="margin: 24px 0; text-align: center; font-size: 30px;">
	Đổi mật khẩu
</h1>

<div class="info-container" style="width: 50%; margin: 0 auto;">
	<h2>Thông tin mật khẩu</h2>

	<form method="post" onsubmit="return validateForm()">
		<label for="matkhaucu">Mật khẩu cũ:</label>
		<input type="password" id="matkhaucu" name="matkhaucu" value="<?php echo $row['matkhau']; ?>" required disabled>
		<label for="matkhau">Mật khẩu mới:</label>
		<input type="password" id="matkhau" name="matkhau" required>
		<label for="matkhaunl">Nhập lại mật khẩu mới:</label>
		<input type="password" id="matkhaunl" name="matkhaunl" required>
		<input type="submit" name="changepass" value="Cập nhật">
		<input type="reset" value="Reset">
	</form>
</div>

<script>
	function validateForm() {
		var matkhau = document.getElementById("matkhau").value;
		var matkhaunl = document.getElementById("matkhaunl").value;
		if (matkhau.length < 8) {
			alert("Mật khẩu mới phải ít nhất 8 ký tự.");
			event.preventDefault();
		}
		if (matkhau != matkhaunl) {
			alert("Mật khẩu mới và nhập lại mật khẩu mới không trùng khớp.");
			event.preventDefault();
		}
		return true;
	}
</script>