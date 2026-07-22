<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITBOOK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #order-detail-wrapper {
            width: 470px;
            margin: 50px auto;
            border: 4px solid #000;
            padding: 5px;
        }

        #order-detail {
            border: 1px solid #000;
            padding: 20px;
            line-height: 20px;
        }

        #order-detail ul {
            margin: 0;
            padding: 0;
        }

        #order-detail ul li {
            list-style: none;
        }

        #order-detail label {
            font-weight: bold;
        }
    </style>
</head>

<body style="font-family: 'Lora', serif;">
    <div id="order-detail-wrapper">
        <div id="order-detail">
            <h1 style="text-align: center;">Thông tin hóa đơn</h1>

            <?php
            include_once(__DIR__ . "/../Controller/cDhang.php");
            $p = new controlDonhang();
            if (isset($_GET['mahd'])) {
                $hd  = base64_decode($_GET['mahd']);
                $tblorder = $p->getDonhang($hd);
                $row = mysqli_fetch_assoc($tblorder);
            ?>
                <label>Người nhận:</label><span> <?php echo $row['tenkhnew']; ?></span><br>
                <label>Địa chỉ:</label><span> <?php echo $row['diachinew']; ?></span><br>
                <label>Điện thoại:</label><span> <?php echo $row['sodienthoainew']; ?></span><br>
                <label>Email:</label><span> <?php echo $row['emailnew']; ?></span><br>
                <label>Phương thức thanh toán: </label><span> <?php echo $row['phuongthuctt']; ?></span><br>
                <label>Nhân viên:</label><span> <?php echo $row['tennv']; ?></span><br>
                <label>Ngày lập:</label><span> <?php echo date('d/m/Y', strtotime($row['ngaylap'])); ?></span><br>
            <?php } ?>
            <hr>

            <h3>Danh sách sản phẩm</h3>
            <ul>
                <?php
                if (isset($_GET['mahd'])) {
                    $mahd  = base64_decode($_GET['mahd']);
                    $tblorder = $p->getAllCTDonhang($mahd);
                    $tongsl = 0;
                    $tongtien = 0;
                    while ($row = mysqli_fetch_assoc($tblorder)) {
                ?>
                        <li>
                            <span><?php echo $row['tensp']; ?></span>
                            <span> - SL: <?php echo $row['soluongban']; ?> sản phẩm</span>
                        </li>
                    <?php
                        $tongtien += ($row['giaban'] * $row['soluongban']);
                        $tongsl += $row['soluongban'];
                    }
                    ?>
            </ul>
            <hr>
            <label>Tổng SL:</label> <?php echo $tongsl; ?> - <label>Tổng tiền:</label> <?php echo number_format($tongtien, 0, ',', '.'); ?> VNĐ
        <?php } ?>
        </div>
    </div>

    <a href="../quanly.php?dhang" class="btn btn-warning" style="margin-left: 720px; margin-top: -40px; font-size: 20px;">Quay về</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>