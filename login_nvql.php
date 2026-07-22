<?php
include_once(__DIR__ . "/Model/ketnoi.php");
session_start();
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($con, $_POST['tendn']);
   $pass = mysqli_real_escape_string($con, md5($_POST['password']));
   $select = "SELECT * FROM taikhoan LEFT JOIN nhanvien ON taikhoan.matk = nhanvien.matk LEFT JOIN quanly ON taikhoan.matk = quanly.matk WHERE taikhoan.tendn = '$name' AND taikhoan.matkhau = '$pass'";
   $result = mysqli_query($con, $select);

   if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);
      if ($row['khoatk'] == 1) {
         echo '<script>alert("Tài khoản bị khóa.")</script>';
      } else {
         if ($row['nguoidung'] == 'Quản lý') {
            $_SESSION['user_name'] = $name;
            $_SESSION['nguoidung'] = $row['nguoidung'];
            $_SESSION['matk'] = $row['matk'];
            $_SESSION['maql'] = $row['maql'];
            echo '<script>
                  alert("Đăng nhập thành công tài khoản quản lý");
                  window.location.href="quanly.php";
                  </script>';
         } elseif ($row['nguoidung'] == 'Nhân viên bán hàng') {
            $_SESSION['user_name'] = $name;
            $_SESSION['nguoidung'] = $row['nguoidung'];
            $_SESSION['matk'] = $row['matk'];
            $_SESSION['manv'] = $row['manv'];
            echo '<script>
                  alert("Đăng nhập thành công tài khoản nhân viên bán hàng");
                  window.location.href="quanly.php";
                  </script>';
         } elseif ($row['nguoidung'] == 'Nhân viên giao hàng') {
            $_SESSION['user_name'] = $name;
            $_SESSION['nguoidung'] = $row['nguoidung'];
            $_SESSION['matk'] = $row['matk'];
            $_SESSION['manv'] = $row['manv'];
            echo '<script>
                  alert("Đăng nhập thành công tài khoản nhân viên giao hàng");
                  window.location.href="quanly.php";
                  </script>';
         } else {
            $error[] = "Thông tin đăng nhập không đúng";
         }
      }
   } else {
      $error[] = "Thông tin đăng nhập không đúng.";
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
      <form action="#" method="POST">
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
         <p><a href="login_kh.php">Bạn là khách hàng</a></p>
      </form>
   </div>
</body>

</html>