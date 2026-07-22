<?php
include_once(__DIR__ . "/Model/ketnoi.php");
session_start();
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (!isset($_SESSION['otp']) || !isset($_SESSION['email'])) {
  echo '<script>
      alert("Bạn chưa nhập email.");
      window.location.href="doimkotp.php";
    </script>';
} else {
  if (isset($_POST['resetmk'])) {
    $email = $_SESSION['email'];
    $password = mysqli_real_escape_string($con, md5($_POST['password']));
    if (strlen($_POST['password']) < 8) {
      echo '<script>
          alert("Mật khẩu phải có ít nhất 8 ký tự.");
          window.location.href="resetpassword.php";
        </script>';
      exit();
    }
    $oldpass = "SELECT matkhau FROM taikhoan tk JOIN khachhang kh ON kh.matk = tk.matk WHERE email = '$email'";
    $result = mysqli_query($con, $oldpass);
    $row = mysqli_fetch_assoc($result);
    $currentpass = $row['matkhau'];
    if ($password == $currentpass) {
      echo '<script>
          alert("Mật khẩu mới phải khác mật khẩu hiện tại.");
          window.location.href="resetpassword.php";
        </script>';
      exit();
    }
    $datmk = "UPDATE taikhoan tk JOIN khachhang kh ON kh.matk = tk.matk SET matkhau = '$password' WHERE email = '$email'";
    $result = mysqli_query($con, $datmk);
    unset($_SESSION['otp']);
    unset($_SESSION['email']);
    echo '<script>
        alert("Đổi mật khẩu thành công.");
        window.location.href="login_kh.php";
      </script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ITBOOK</title>

  <link rel="stylesheet" href="CSS/form.css">
</head>

<body>
  <div class="form-container">
    <form method="POST">
      <h3>Đặt lại mật khẩu</h3>
      <input type="password" name="password" required placeholder="Nhập mật khẩu mới">
      <input type="submit" name="resetmk" value="Đặt lại" class="form-btn">
    </form>
  </div>
</body>

</html>