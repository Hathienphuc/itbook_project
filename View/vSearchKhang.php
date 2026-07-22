<div class="data">
    <table class="table table-hover w-100">
        <thead style="font-family: 'Lora', serif;">
            <tr>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">STT</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Tài khoản</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Tên khách hàng</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Địa chỉ</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Phone</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Email</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Hình ảnh</th>
                <th style="vertical-align: middle;">Xóa</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include_once(__DIR__ . "/../Controller/cKhang.php");

            if (isset($_REQUEST['keyword'])) {
                $searchkh  = $_REQUEST['keyword'];
                $p = new controlKhachhang();
                $kq = $p->SearchKhachhang($searchkh);

                if ($kq) {
                    if (mysqli_num_rows($kq) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($kq)) {
                            echo "<tr>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $dem++ . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['tendn'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['tenkh'] . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['diachi'] . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['sodienthoai'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['email'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'><img width='80' height='90' src='Image/" . (($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg') . "'></td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'><button type='button' class='btn btn-danger xoabtn'>Xóa</button></td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?khang";
                        </script>';
                    }
                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?khang";
                    </script>';
                }
            }
            ?>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('.xoabtn').on('click', function() {
            $('#xoamodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#makh').val(data[0]);
        });
    });
</script>