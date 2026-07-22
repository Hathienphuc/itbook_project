<?php
header('Content-type: text/html; charset=utf-8');
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
    $invoice->trangthai = -1;
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
    }
}

function execPostRequest($url, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        )
    );

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        print curl_error($ch);
    }

    curl_close($ch);
    return $result;
}

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$order_id = time() . "";
$orderInfo = "Thanh toán qua ATM";
$amount = strval($_POST['total']);
$redirectUrl = "http://localhost/KLTN_ITBOOK_660/camon.php";
$ipnUrl = "http://localhost/KLTN_ITBOOK_660/camon.php";
$extraData = $invoice_id;
$requestId = time() . "";
$requestType = "payWithATM";
$now = (new DateTime())->format('YmdHis');
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $order_id . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);

$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "ITBOOK",
    "storeId" => "ITBOOK",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $order_id,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

$result1 = execPostRequest($endpoint, json_encode($data));
echo json_encode($data);
$jsonResult = json_decode($result1, true);
header('Location: ' . $jsonResult['payUrl']);
