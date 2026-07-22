<div class="data">
    <table class="table table-hover w-100">
        <thead style="font-family: 'Lora', serif;">
            <tr>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">STT</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Tên sản phẩm</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle; width: 12%;">Nhà cung cấp</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Danh mục</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Tác giả</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle; width: 8%">Số lượng</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Giá bán</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle; width: 12%;">Ngày xuất bản</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle; width: 8%;">Hình ảnh</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Sửa</th>
                <th style="vertical-align: middle;">Xóa</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include_once(__DIR__ . "/../Controller/cSpham.php");

            if (isset($_REQUEST['keyword'])) {
                $searchsp  = $_REQUEST['keyword'];
                $p = new controlSanpham();
                $kq = $p->SearchSanpham($searchsp);

                if ($kq) {
                    if (mysqli_num_rows($kq) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($kq)) {
                            echo "<tr>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $dem++ . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['tensp'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['tenncc'] . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['tenloai'] . "</td>";
                            echo "<td style='text-align: left; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['tacgia'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . $row['soluong'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 11%;'>" . number_format($row['giaban'], 0, ',', '.') . " VNĐ</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'>" . date('d/m/Y', strtotime($row['ngayxuatban'])) . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: fit-content;'><img width=80px height=90px src='Image/" . $row['hinhanh'] . "'></td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 1%;'><button type='button' class='btn btn-primary suabtn'>Sửa</button></td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black; width: 1%;'><button type='button' class='btn btn-danger xoabtn'>Xóa</button></td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?spham";
                        </script>';
                    }
                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?spham";
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
            console.log(data);
            $('#masp').val(data[0]);
            $('#tensp').val(data[1]);
            var nhacc = data[2];
            var danhmuc = data[3];
            $("#nhacungcap option").filter(function() {
                return $(this).text() === nhacc;
            }).prop("selected", true);
            $("#loaisp option").filter(function() {
                return $(this).text() === danhmuc;
            }).prop("selected", true);
            $('#tacgia').val(data[4]);
            $('#soluong').val(data[5]);
            var giaBan = parseFloat(data[6].replace(/[^0-9.-]+/g, ""));
            var giaBanVND = giaBan * 1000;
            $('#giaban').val(giaBanVND);
            var date_str = data[7];
            var date_parts = date_str.split('/');
            var iso_date = date_parts[2] + '-' + date_parts[1] + '-' + date_parts[0];
            $('#ngayxuatban').val(iso_date);
            $('#suamodal form').submit(function(event) {
                var tensp = $('#tensp').val().trim();
                var tacgia = $('#tacgia').val().trim();
                var soluong = $('#soluong').val().trim();
                var giaban = $('#giaban').val().trim();
                var ngayxuatban = $('#ngayxuatban').val().trim();
                if (!tensp) {
                    alert('Chưa nhập tên sản phẩm.');
                    event.preventDefault();
                }
                if (!tacgia) {
                    alert('Chưa nhập tên tác giả.');
                    event.preventDefault();
                }
                if (!soluong) {
                    alert('Chưa nhập số lượng.');
                    event.preventDefault();
                } else if (soluong < 0) {
                    alert('Không nhập số lượng âm.');
                    event.preventDefault();
                }
                if (!giaban) {
                    alert('Chưa nhập giá bán.');
                    event.preventDefault();
                } else if (giaban <= 0 || !/^\d+$/.test(giaban)) {
                    alert('Không nhập số âm, số 0, số thập phân và ký tự đặc biệt.');
                    event.preventDefault();
                } else if (!/^\d+000$/.test(giaban)) {
                    alert('Giá bán phải kết thúc bằng 3 số 0.');
                    event.preventDefault();
                }
                if (!ngayxuatban) {
                    alert('Chưa nhập ngày xuất bản.');
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
            $('#msp').val(data[0]);
        });
    });
</script>