<div class="data">
    <table class="table table-hover w-100">
        <thead style="font-family: 'Lora', serif;">
            <tr>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">STT</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Tài khoản</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Người dùng</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Khóa tài khoản</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Khôi phục mật khẩu</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Sửa</th>
                <th style="vertical-align: middle;">Xóa</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include_once(__DIR__ . "/../Controller/cTkhoan.php");

            if (isset($_REQUEST['keyword'])) {
                $searchtk  = $_REQUEST['keyword'];
                $p = new controlTaikhoan();
                $kq = $p->SearchTaikhoan($searchtk);

                if ($kq) {
                    if (mysqli_num_rows($kq) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($kq)) {
                            echo "<tr>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $dem++ . "</td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $row['tendn'] . "</td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $row['nguoidung'] . "</td>";

                            if ($row['nguoidung'] == 'Nhân viên giao hàng' || $row['nguoidung'] == 'Nhân viên bán hàng') {
                                if ($row['khoatk'] == 0) {
                                    echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><a class='btn btn-warning' href='View/vLocTkhoan.php?matk=" . $row['matk'] . "'>Mở khóa</a></td>";
                                } else {
                                    echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><a class='btn btn-warning' href='View/vMoTkhoan.php?matk=" . $row['matk'] . "'>Khóa</a></td>";
                                }
                                echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><button type='button' class='btn btn-success khoiphucbtn'>Khôi phục</button></td>";
                                echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><button type='button' class='btn btn-primary suabtn'>Sửa</button></td>";
                            } elseif ($row['nguoidung'] == 'Quản lý' || $row['nguoidung'] == 'Khách hàng') {
                                echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><p style='margin-top: 15px; color: red;'><b>Không</b></p></td>";
                                echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><p style='margin-top: 15px; color: red;'><b>Không</b></p></td>";
                            }

                            if ($row['nguoidung'] == 'Quản lý') {
                                echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><button type='button' class='btn btn-primary suabtn'>Sửa</button></td>";
                            } elseif ($row['nguoidung'] == 'Khách hàng') {
                                echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><p style='margin-top: 15px; color: red;'><b>Không</b></p></td>";
                            }

                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><button type='button' class='btn btn-danger xoabtn'>Xóa</button></td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?tkhoan";
                        </script>';
                    }
                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?tkhoan";
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
            $('#matk').val(data[0]);
            $('#tendn').val(data[1]);
            $('#suamodal form').submit(function(event) {
                var tendn = $('#tendn').val().trim();
                if (!tendn) {
                    alert('Chưa nhập tài khoản.');
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
            $('#idtk').val(data[0]);
        });
    });

    $(document).ready(function() {
        $('.khoiphucbtn').on('click', function() {
            $('#khoiphucmodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#mtk').val(data[0]);
        });
    });
</script>