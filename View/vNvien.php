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
    <div class="modal" id="xoamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="margin-left: 88px; margin-top: 5px;">Xóa thông tin nhân viên</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vDelNvien.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="manv" name="manv">
                        <h3 class="modal-title" style="margin-left: 80px; font-family: 'Lora', serif; color: red; font-weight:600;">Bạn có muốn xóa không ?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" name="delete">Đồng ý</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h1>Thông tin nhân viên</h1>

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
            id="searchnv"
            style="width: 220px; display: inline-block; margin-left: 10px; border: 1px solid black;">
    </div>

    <div class="data" style="padding: 0 30px;" id="resultnv">
        <table class="table table-hover w-100">
            <thead style="font-family: 'Lora', serif;">
                <tr>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">STT</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Tài khoản</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Tên nhân viên</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Địa chỉ</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Phone</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Email</th>
                    <th style="border-right: 3px solid #fff; vertical-align: middle;">Hình ảnh</th>
                    <th style="vertical-align: middle;">Xóa</th>
                </tr>
            </thead>

            <tbody>

                <?php
                include_once(__DIR__ . "/../Controller/cNvien.php");
                $p = new controlNhanvien();
                $tblstaff = $p->getAllNhanvien();

                if ($tblstaff) {
                    if (mysqli_num_rows($tblstaff) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($tblstaff)) {
                            echo "<tr>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $dem++ . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['tendn'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['tennv'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['diachi'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['sodienthoai'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'>" . $row['email'] . "</td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'><img width='80' height='90' src='Image/" . (($row['hinhanh'] != '') ? $row['hinhanh'] : 'chandung.jpg') . "'></td>";
                            echo "<td style='text-align: center; vertical-align: middle; border-bottom: 1px solid black;'><button type='button' class='btn btn-danger xoabtn'>Xóa</button></td>";
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
            $('.xoabtn').on('click', function() {
                $('#xoamodal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                console.log(data);
                $('#manv').val(data[0]);
            });
        });

        $(document).ready(function() {
            $('#searchnv').on('input', function() {
                var searchKeyword = $(this).val();
                if (searchKeyword.length >= 2) {
                    $.ajax({
                        url: 'View/vSearchNvien.php',
                        type: 'POST',
                        data: {
                            keyword: searchKeyword
                        },
                        success: function(data) {
                            $('#resultnv').html(data);
                        }
                    });
                } else {
                    $.ajax({
                        url: 'View/vSearchNvien.php',
                        type: 'POST',
                        data: {
                            keyword: ''
                        },
                        success: function(data) {
                            $('#resultnv').html(data);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>