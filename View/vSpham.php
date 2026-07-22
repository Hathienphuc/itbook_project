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
    <div class="modal" id="suamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="margin-left: 85px; margin-top: 5px;">Sửa thông tin sản phẩm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vEditSpham.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3" style="margin-top: -16px;">
                            <input type="hidden" class="form-control" id="masp" name="masp">
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label class="form-label" style=" font-weight:600;">Tên sản phẩm:</label>
                            <input type="text" class="form-control" id="tensp" placeholder="Nhập tên sản phẩm" name="tensp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Nhà cung cấp:</label>
                            <select class="form-select" id="nhacungcap" name="nhacungcap">
                                <?php
                                include_once(__DIR__ . "/../Controller/cNhacc.php");
                                $nhacungcap = new controlNhacungcap();
                                $tblcomp = $nhacungcap->getAllNhacungcap();
                                while ($rows = mysqli_fetch_assoc($tblcomp)) {
                                    echo '<option value="' . $rows['mancc'] . '">' . $rows['tenncc'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Danh mục:</label>
                            <select class="form-select" id="loaisp" name="loaisp">
                                <?php
                                include_once(__DIR__ . "/../Controller/cDmuc.php");
                                $danhmuc = new controlDanhmuc();
                                $tblloai = $danhmuc->getAllDanhmuc();
                                while ($rows = mysqli_fetch_assoc($tblloai)) {
                                    echo '<option value="' . $rows['maloai'] . '">' . $rows['tenloai'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Tác giả:</label>
                            <input type="text" class="form-control" id="tacgia" placeholder="Nhập tên tác giả" name="tacgia">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Số lượng:</label>
                            <input type="number" class="form-control" id="soluong" placeholder="Nhập số lượng" name="soluong">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Giá bán:</label>
                            <input type="text" class="form-control" id="giaban" placeholder="Nhập giá bán" name="giaban">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Ngày xuất bản:</label>
                            <input type="date" class="form-control" id="ngayxuatban" name="ngayxuatban">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Hình ảnh:</label>
                            <input type="file" class="form-control" id="hinhanh" name="hinhanh">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" name="edit">Xác nhận</button>
                        <input type="reset" class="btn btn-success" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="xoamodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="margin-left: 88px; margin-top: 5px;">Xóa thông tin sản phẩm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vDelSpham.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="msp" name="msp">
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

    <div class="modal" id="themmodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="margin-left: 80px; margin-top: 5px;">Thêm thông tin sản phẩm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vAddSpham.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3" style="margin-top: -16px;">
                            <input type="hidden" class="form-control" id="idsp" name="idsp">
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label class="form-label" style=" font-weight:600;">Tên sản phẩm:</label>
                            <input type="text" class="form-control" id="tsp" placeholder="Nhập tên sản phẩm" name="tsp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Nhà cung cấp:</label>
                            <select class="form-select" id="idncc" name="idncc">
                                <?php
                                include_once(__DIR__ . "/../Controller/cNhacc.php");
                                $nhacungcap = new controlNhacungcap();
                                $tblcomp = $nhacungcap->getAllNhacungcap();
                                while ($rows = mysqli_fetch_assoc($tblcomp)) {
                                    echo '<option value="' . $rows['mancc'] . '">' . $rows['tenncc'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Danh mục:</label>
                            <select class="form-select" id="iddm" name="iddm">
                                <?php
                                include_once(__DIR__ . "/../Controller/cDmuc.php");
                                $danhmuc = new controlDanhmuc();
                                $tblloai = $danhmuc->getAllDanhmuc();
                                while ($rows = mysqli_fetch_assoc($tblloai)) {
                                    echo '<option value="' . $rows['maloai'] . '">' . $rows['tenloai'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Tác giả:</label>
                            <input type="text" class="form-control" id="tg" placeholder="Nhập tên tác giả" name="tg">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Số lượng:</label>
                            <input type="number" class="form-control" id="sl" placeholder="Nhập số lượng" name="sl">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Giá bán:</label>
                            <input type="text" class="form-control" id="gb" placeholder="Nhập giá bán" name="gb">

                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Ngày xuất bản:</label>
                            <input type="date" class="form-control" id="nxb" name="nxb">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Hình ảnh:</label>
                            <input type="file" class="form-control" id="hinh" name="hinh">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" name="add">Xác nhận</button>
                        <input type="reset" class="btn btn-success" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h1>Thông tin sản phẩm</h1>

    <div class="left">
        <hr>
    </div>
    <div class="right">
        <hr>
    </div>

    <div class="icon" style="text-align: center; margin-top: -31px; font-size: 25px;">
        <i class='bx bxs-book-reader'></i>
    </div>

    <div class="d-flex justify-content-between align-items-center" style="margin: 20px 30px;">
        <div class="search">
            <label class="form-label" style="font-weight: 600; font-size: 18px;">Tìm kiếm:</label>
            <input type="text" class="form-control"
                placeholder="Nhập từ khóa..."
                id="searchsp"
                style="width: 220px; display: inline-block; margin-left: 10px; border: 1px solid black;">
        </div>

        <div class="adddata">
            <button type="button"
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#themmodal"
                style="font-size: 18px;">
                Thêm sản phẩm
            </button>
        </div>
    </div>

    <div class="data" style="padding: 0 30px;" id="resultsp">
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
                $p = new controlSanpham();
                $tblproduct = $p->getAllSanpham();

                if ($tblproduct) {
                    if (mysqli_num_rows($tblproduct) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($tblproduct)) {
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

        $('#themmodal form').submit(function(event) {
            var tensp = $('#tsp').val().trim();
            var tacgia = $('#tg').val().trim();
            var soluong = $('#sl').val().trim();
            var giaban = $('#gb').val().trim();
            var ngayxuatban = $('#nxb').val().trim();
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

        $(document).ready(function() {
            $('#searchsp').on('input', function() {
                var searchKeyword = $(this).val();
                if (searchKeyword.length >= 2) {
                    $.ajax({
                        url: 'View/vSearchSpham.php',
                        type: 'POST',
                        data: {
                            keyword: searchKeyword
                        },
                        success: function(data) {
                            $('#resultsp').html(data);
                        }
                    });
                } else {
                    $.ajax({
                        url: 'View/vSearchSpham.php',
                        type: 'POST',
                        data: {
                            keyword: ''
                        },
                        success: function(data) {
                            $('#resultsp').html(data);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>