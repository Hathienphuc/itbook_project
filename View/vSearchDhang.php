<div class="data">
    <table class="table table-hover w-100">
        <thead style="font-family: 'Lora', serif;">
            <tr>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">STT</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Nhân viên</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Khách hàng</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Địa chỉ</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Phone</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Email</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Tổng tiền</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Hình thức</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Ngày lập</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Tình trạng</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Trạng thái</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Xem</th>
                <th style="vertical-align: middle;">In</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include_once(__DIR__ . "/../Controller/cDhang.php");

            if (isset($_REQUEST['keyword'])) {
                $searchhd  = $_REQUEST['keyword'];
                $p = new controlDonhang();
                $kq = $p->SearchDonhang($searchhd);

                if ($kq) {
                    if (mysqli_num_rows($kq) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($kq)) {
                            echo "<tr>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $dem++ . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['tennv'] . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['tenkhnew'] . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['diachinew'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['sodienthoainew'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['emailnew'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 10%;'>" . number_format($row['tongtien'], 0, ',', '.') . " VNĐ</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['phuongthuctt'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . date('d/m/Y', strtotime($row['ngaylap'])) . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content; color: red;'>" . $row['tinhtrangtt'] . "</td>";
            ?>
                            <td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 9%;'>
                                <?php
                                if ($row['trangthai'] == 0) {
                                    echo '<a class="btn btn-primary" href="View/vConfirmDhang.php?mahd=' . $row['mahd'] . '">Xác nhận</a>';
                                } else {
                                    echo 'Đã xem';
                                }
                                ?>
                            </td>

            <?php
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'><a class='btn btn-success' href='quanly.php?xemdhang&mahd=" . base64_encode($row['mahd']) . "'>Xem</a></td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'><a class='btn btn-danger' href='View/vInDhang.php?mahd=" . base64_encode($row['mahd']) . "'>In</a></td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?dhang";
                        </script>';
                    }
                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?dhang";
                    </script>';
                }
            }
            ?>
    </table>
</div>