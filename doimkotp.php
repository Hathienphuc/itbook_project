<?php
include_once(__DIR__ . "/Model/ketnoi.php");
include_once(__DIR__ . "/mail/src/Exception.php");
include_once(__DIR__ . "/mail/src/PHPMailer.php");
include_once(__DIR__ . "/mail/src/SMTP.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (isset($_POST['submitotp'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("Định dạng email không hợp lệ.")</script>';
  } else {
    $doimk = "SELECT * FROM khachhang kh JOIN taikhoan tk ON kh.matk = tk.matk WHERE `email` = '$email'";
    $result = mysqli_query($con, $doimk);
    if (mysqli_num_rows($result) > 0) {
      $otp = rand(100000, 999999);
      $_SESSION['otp'] = $otp;
      $_SESSION['email'] = $email;
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'hathienphuc12a8@gmail.com';
      $mail->Password = 'wzyyfqzbkzpobvyf';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->setFrom('hathienphuc12a8@gmail.com', 'ITBOOK');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = '=?UTF-8?B?' . base64_encode('Mã OTP đặt lại mật khẩu') . '?=';
      $mail->Body = 'Mã OTP của bạn là: ' . $otp;
      $mail->CharSet = 'UTF-8';
      if ($mail->send()) {
        header("Location: xacthucotp.php");
      } else {
        echo '<script>alert("Gửi mã OTP thất bại.")</script>';
      }
    } else {
      echo '<script>alert("Email chưa được đăng ký.")</script>';
    }
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
      <h3>Đổi mật khẩu OTP</h3>
      <input type="email" name="email" required placeholder="Nhập email">
      <input type="submit" name="submitotp" value="Gửi mã OTP" class="form-btn">
    </form>
  </div>
</body>

</html>