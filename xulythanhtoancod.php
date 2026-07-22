<?php
session_start();
include_once(__DIR__ . "/Model/ketnoi.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $total = $_POST['total'];
    $paymentMethod = $_POST['payment_method'];

    if (isset($_SESSION['makh'])) {
        $user_id = $_SESSION['makh'];
        $query = "SELECT * FROM khachhang WHERE makh = $user_id";
        $result = mysqli_query($con, $query);
        $user = mysqli_fetch_array($result);
    }

    $query = "SELECT manv FROM nhanvien ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($con, $query);
    $nv = mysqli_fetch_array($result);
    $manv = $nv['manv'];
    $invoice = new stdClass();
    $invoice->makh = $user_id;
    $invoice->manv = $manv;
    $invoice->tenkhnew = $name;
    $invoice->emailnew = $user['email'];
    $invoice->diachinew = $address;
    $invoice->sodienthoainew = $phone;
    $invoice->tongtien = $total;
    $invoice->phuongthuctt = $paymentMethod;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $invoice->ngaylap = date('Y-m-d H:i:s', time());
    $invoice->tinhtrangtt = 'Chưa thanh toán';
    $invoice->trangthai = 0;
    $query = "INSERT INTO hoadon (makh, manv, tenkhnew, emailnew, diachinew, sodienthoainew, tongtien, phuongthuctt, ngaylap, tinhtrangtt, trangthai) VALUES ('$invoice->makh', '$invoice->manv', '$invoice->tenkhnew', '$invoice->emailnew', '$invoice->diachinew', '$invoice->sodienthoainew', '$invoice->tongtien', '$invoice->phuongthuctt', '$invoice->ngaylap', '$invoice->tinhtrangtt', '$invoice->trangthai')";

    if (mysqli_query($con, $query)) {
        $invoice_id = mysqli_insert_id($con);

        foreach ($_SESSION["cart"] as $product_id => $quantity) {
            $product = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `masp` = '$product_id'");
            $row = mysqli_fetch_assoc($product);
            $product_price = $row['giaban'];
            $query = "INSERT INTO chitiethoadon (mahd, masp, soluongban, giaban) VALUES ('$invoice_id', '$product_id', '$quantity', '$product_price')";
            mysqli_query($con, $query);
            $quantity_sold = $row['soluong'] - $quantity;
            $query = "UPDATE sanpham SET soluong = $quantity_sold WHERE masp = '$product_id'";
            mysqli_query($con, $query);
        }
        
        echo '<script>alert("Chúng tôi sẽ sớm liên hệ với bạn để xác nhận đơn hàng. Xin cảm ơn.");</script>';
        unset($_SESSION['cart']);
        echo '<script>window.location.href="sanpham.php";</script>';
    }
}

mysqli_close($con);
