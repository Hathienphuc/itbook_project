<div class="data">
    <table class="table table-hover w-100">
        <thead style="font-family: 'Lora', serif;">
            <tr>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">STT</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Tên nhà cung cấp</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Địa chỉ</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Phone</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Email</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Sửa</th>
                <th style="vertical-align: middle;">Xóa</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include_once(__DIR__ . "/../Controller/cNhacc.php");

            if (isset($_REQUEST['keyword'])) {
                $searchncc  = $_REQUEST['keyword'];
                $p = new controlNhacungcap();
                $kq = $p->SearchNhacungcap($searchncc);

                if ($kq) {
                    if (mysqli_num_rows($kq) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($kq)) {
                            echo "<tr>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $dem++ . "</td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $row['tenncc'] . "</td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $row['diachi'] . "</td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $row['sodienthoai'] . "</td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $row['email'] . "</td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><button type='button' class='btn btn-primary suabtn'>Sửa</button></td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><button type='button' class='btn btn-danger xoabtn'>Xóa</button></td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?nccap";
                        </script>';
                    }
                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?nccap";
                    </script>';
                }
            }
            ?>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('.suabtn').on('click', function() {
            $('#suamodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data)
            $('#mancc').val(data[0]);
            $('#tenncc').val(data[1]);
            $('#diachi').val(data[2]);
            $('#sodienthoai').val(data[3]);
            $('#email').val(data[4]);
            $('#suamodal form').submit(function(event) {
                var tenncc = $('#tenncc').val().trim();
                var diachi = $('#diachi').val().trim();
                var sodienthoai = $('#sodienthoai').val().trim();
                var email = $('#email').val().trim();
                if (!tenncc) {
                    alert('Chưa nhập tên nhà cung cấp.');
                    event.preventDefault();
                }
                if (!diachi) {
                    alert('Chưa nhập địa chỉ.');
                    event.preventDefault();
                }
                if (!sodienthoai) {
                    alert('Chưa nhập số điện thoại');
                    event.preventDefault();
                } else if (sodienthoai.length != 10 || !/^\d+$/.test(sodienthoai)) {
                    alert('Số điện thoại không đúng định dạng.');
                    event.preventDefault();
                }
                if (!email) {
                    alert('Chưa nhập email.');
                    event.preventDefault();
                } else if (!/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                    alert('Email không đúng định dạng.');
                    event.preventDefault();
                }
            });
        });
    });

    $(document).ready(function() {
        $('.xoabtn').on('click', function() {
            $('#xoamodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#idsp').val(data[0]);
        });
    });
</script>