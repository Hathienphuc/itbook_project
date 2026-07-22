<div class="data">
    <table class="table table-hover w-100">
        <thead style="font-family: 'Lora', serif;">
            <tr>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">STT</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Tên loại sản phẩm</th>
                <th style="border-right: 3px solid #fff; vertical-align: middle;">Sửa</th>
                <th style="vertical-align: middle;">Xóa</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include_once(__DIR__ . "/../Controller/cDmuc.php");

            if (isset($_REQUEST['keyword'])) {
                $searchdm  = $_REQUEST['keyword'];
                $p = new controlDanhmuc();
                $kq = $p->SearchDanhmuc($searchdm);

                if ($kq) {
                    if (mysqli_num_rows($kq) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($kq)) {
                            echo "<tr>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $dem++ . "</td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $row['tenloai'] . "</td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><button type='button' class='btn btn-primary suabtn'>Sửa</button></td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'><button type='button' class='btn btn-danger xoabtn'>Xóa</button></td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        echo '<script>
                            alert("Không tìm thấy dữ liệu.");
                            window.location.href="quanly.php?dmuc";
                        </script>';
                    }
                } else {
                    echo '<script>
                        alert("Lỗi.");
                        window.location.href="quanly.php?dmuc";
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
            $('#maloai').val(data[0]);
            $('#tenloai').val(data[1]);
            $('#suamodal form').submit(function(event) {
                var tenloai = $('#tenloai').val().trim();
                if (!tenloai) {
                    alert('Chưa nhập tên loại sản phẩm.');
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
            $('#iddm').val(data[0]);
        });
    });
</script>