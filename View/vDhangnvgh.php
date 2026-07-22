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
    <h1>Thông tin giao hàng</h1>

    <div class="left">
        <hr>
    </div>
    <div class="right">
        <hr>
    </div>

    <div class="icon" style="text-align: center; margin-top: -31px; font-size: 25px;">
        <i class='bx bxs-book-reader'></i>
    </div>

    <div class="search" style="margin: 20px 30px;">
        <label class="form-label" style="font-weight: 600; font-size: 18px;">Tìm kiếm:</label>
        <input type="text" class="form-control"
            placeholder="Nhập từ khóa..."
            id="searchhd"
            style="width: 220px; display: inline-block; margin-left: 10px; border: 1px solid black;">
    </div>

    <div class="data" style="padding: 0 30px;" id="resulthd">
        <table class="table table-hover w-100">
            <thead style="font-family: 'Lora', serif;">
                <tr>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">STT</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Khách hàng</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Địa chỉ</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Phone</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Email</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Tổng tiền</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Hình thức</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Tình trạng</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Trạng thái</th>
                    <th style="vertical-align: middle;">Xem</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include_once(__DIR__ . "/../Controller/cDhang.php");
                $p = new controlDonhang();
                $tblorder = $p->getAllDonhang();

                if ($tblorder) {
                    if (mysqli_num_rows($tblorder) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($tblorder)) {
                            echo "<tr>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $dem++ . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 10%;'>" . $row['tenkhnew'] . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['diachinew'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['sodienthoainew'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['emailnew'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 10%;'>" . number_format($row['tongtien'], 0, ',', '.') . " VNĐ</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 8%;'>" . $row['phuongthuctt'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 9%; color: red; class='tinhtrangtt'>" . $row['tinhtrangtt'] . "</td>";
                ?>

                            <td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 10%;' class="trangthai">
                                <?php
                                if ($row['tinhtrangtt'] == 'Chưa thanh toán') {
                                    echo 'Không';
                                } elseif ($row['trangthai'] == 0) {
                                    echo 'Chờ xác nhận';
                                } elseif ($row['trangthai'] == 1) {
                                    echo '<a class="btn btn-primary" href="View/vDeliDhang.php?mahd=' . $row['mahd'] . '">Giao hàng</a>';
                                } elseif ($row['trangthai'] == 2) {
                                    echo '<a class="btn btn-warning" href="View/vFinishDhang.php?mahd=' . $row['mahd'] . '">Hoàn thành</a>';
                                } elseif ($row['trangthai'] == 4) {
                                    echo 'Đã hủy';
                                } else {
                                    echo 'Giao hàng thành công';
                                }
                                ?>
                            </td>

                <?php
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'><a class='btn btn-success' href='quanly.php?xemdhang&mahd=" . base64_encode($row['mahd']) . "'>Xem</a></td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        echo '<script>alert("Không có dữ liệu.")</script>';
                    }
                } else {
                    echo '<script>alert("Lỗi.")</script>';
                }
                ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#searchhd').on('input', function() {
                var searchKeyword = $(this).val();
                if (searchKeyword.length >= 2) {
                    $.ajax({
                        url: 'View/vSearchDhang.php',
                        type: 'POST',
                        data: {
                            keyword: searchKeyword
                        },
                        success: function(data) {
                            $('#resulthd').html(data);
                        }
                    });
                } else {
                    $.ajax({
                        url: 'View/vSearchDhang.php',
                        type: 'POST',
                        data: {
                            keyword: ''
                        },
                        success: function(data) {
                            $('#resulthd').html(data);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>