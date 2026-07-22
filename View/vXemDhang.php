<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITBOOK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hidden-element {
            display: none;
        }
    </style>
</head>

<body>
    <h1>Thông tin đơn hàng</h1>

    <div class="left">
        <hr>
    </div>
    <div class="right">
        <hr>
    </div>

    <div class="icon" style="text-align: center; margin-top: -31px; font-size: 25px;">
        <i class='bx bxs-book-reader'></i>
    </div>

    <div class="data" style="padding: 0 30px;">
        <table class="table table-hover w-100">
            <thead style="font-family: 'Lora', serif;">
                <tr>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">STT</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Tên sản phẩm</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Số lượng</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Giá bán</th>
                    <th style="vertical-align: middle;">Thành tiền</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include_once(__DIR__ . "/../Controller/cDhang.php");

                if (isset($_GET['mahd'])) {
                    $mahd  = base64_decode($_GET['mahd']);
                    $p = new controlDonhang();
                    $tblorder = $p->getAllCTDonhang($mahd);

                    if ($tblorder) {
                        if (mysqli_num_rows($tblorder) > 0) {
                            $dem = 1;
                            $tongtien = 0;
                            while ($row = mysqli_fetch_assoc($tblorder)) {
                                $thanhtien = $row['giaban'] * $row['soluongban'];
                                $tongtien += $thanhtien;
                                echo "<tr>";
                                echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $dem++ . "</td>";
                                echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['tensp'] . "</td>";
                                echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['soluongban'] . "</td>";
                                echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . number_format($row['giaban'], 0, ',', '.') . " VNĐ</td>";
                                echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . number_format($thanhtien, 0, ',', '.') . " VNĐ</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "<td colspan='5' style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>";
                            echo "<p style='color: red; font-weight: 600; margin-bottom: 5px; text-align: center;'>Tổng tiền: " . number_format($tongtien, 0, ',', '.') . " VNĐ</p>";
                            echo "</td>";
                        } else {
                            echo '<script>alert("Không có dữ liệu.")</script>';
                        }
                    } else {
                        echo '<script>alert("Lỗi.")</script>';
                    }
                }
                ?>
        </table>

        <?php
        if ($_SESSION['nguoidung'] == 'Quản lý' || $_SESSION['nguoidung'] == 'Nhân viên bán hàng') {
        ?>
            <a href="quanly.php?dhang" class="btn btn-warning" style="display: block; font-size: 18px; width: 10%; margin: 0 auto;">Quay về</a>
        <?php } else { ?>
            <a href="quanly.php?dhangnvgh" class="btn btn-warning" style="display: block; margin: 0 auto; font-size: 18px; width: 10%;">Quay về</a>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>