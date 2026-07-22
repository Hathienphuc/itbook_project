<?php
include_once(__DIR__ . "/Model/ketnoi.php");
session_start();
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($con, $_POST['tendn']);
   $pass = mysqli_real_escape_string($con, md5($_POST['password']));
   $select = "SELECT tk.matk, kh.makh, tk.nguoidung FROM taikhoan tk JOIN khachhang kh ON tk.matk = kh.matk WHERE tk.tendn ='$name' AND tk.matkhau = '$pass'";
   $result = mysqli_query($con, $select);

   if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);
      if ($row['nguoidung'] == 'Khách hàng') {
         $_SESSION['tendn'] = $name;
         $_SESSION['nguoidungkh'] = $row['nguoidung'];
         $_SESSION['matk'] = $row['matk'];
         $_SESSION['makh'] = $row['makh'];
         echo '<script>
                  alert("Đăng nhập thành công");
                  window.location.href="index.php";
                  </script>';
      } else {
         $error[] = "Thông tin đăng nhập không đúng";
      }
   } else {
      $error[] = "Thông tin đăng nhập không đúng";
   }
}

mysqli_close($con);
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
      <form action="#" method="post">
         <h3>Đăng nhập</h3>

         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            };
         };
         ?>

         <input type="text" name="tendn" required placeholder="Nhập tên đăng nhập">
         <input type="password" name="password" required placeholder="Nhập mật khẩu">
         <input type="submit" name="submit" value="Đăng nhập" class="form-btn">
         <p>Bạn chưa có tài khoản<a href="dangky.php"> Đăng ký</a></p>
         <p><a href="login_nvql.php">Bạn là nhân viên</a></p>
         <p><a href="doimkotp.php">Quên mật khẩu</a></p>
      </form>
   </div>
</body>

</html>