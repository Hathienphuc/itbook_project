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
                    <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Sửa thông tin nhà cung cấp</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vEditNhacc.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3" style="margin-top: -16px;">
                            <input type="hidden" class="form-control" id="mancc" name="mancc">
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label class="form-label" style=" font-weight:600;">Tên nhà cung cấp:</label>
                            <input type="text" class="form-control" id="tenncc" placeholder="Nhập tên nhà cung cấp" name="tenncc">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Địa chỉ:</label>
                            <input type="text" class="form-control" id="diachi" placeholder="Nhập địa chỉ" name="diachi">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Phone:</label>
                            <input type="text" class="form-control" id="sodienthoai" placeholder="Nhập số điện thoại" name="sodienthoai">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email">
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
                    <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Xóa thông tin nhà cung cấp</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vDelNhacc.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="idsp" name="idsp">
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
                    <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Thêm thông tin nhà cung cấp</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vAddNhacc.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3" style="margin-top: 5px;">
                            <label class="form-label" style=" font-weight:600;">Tên nhà cung cấp:</label>
                            <input type="text" class="form-control" id="tncc" placeholder="Nhập tên nhà cung cấp" name="tncc">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Địa chỉ:</label>
                            <input type="text" class="form-control" id="dc" placeholder="Nhập địa chỉ" name="dc">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Phone:</label>
                            <input type="text" class="form-control" id="sdt" placeholder="Nhập số điện thoại" name="sdt">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style=" font-weight:600;">Email:</label>
                            <input type="email" class="form-control" id="mail" placeholder="Nhập email" name="mail">
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

    <h1>Thông tin nhà cung cấp</h1>

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
                id="searchncc"
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

    <div class="data" style="padding: 0 30px;" id="resultncc">
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
                $p = new controlNhacungcap();
                $tblcomp = $p->getAllNhacungcap();

                if ($tblcomp) {
                    if (mysqli_num_rows($tblcomp) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($tblcomp)) {
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

        $('#themmodal form').submit(function(event) {
            var tenncc = $('#tncc').val().trim();
            var diachi = $('#dc').val().trim();
            var sodienthoai = $('#sdt').val().trim();
            var email = $('#mail').val().trim();
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

        $(document).ready(function() {
            $('#searchncc').on('input', function() {
                var searchKeyword = $(this).val();
                if (searchKeyword.length >= 2) {
                    $.ajax({
                        url: 'View/vSearchNhacc.php',
                        type: 'POST',
                        data: {
                            keyword: searchKeyword
                        },
                        success: function(data) {
                            $('#resultncc').html(data);
                        }
                    });
                } else {
                    $.ajax({
                        url: 'View/vSearchNhacc.php',
                        type: 'POST',
                        data: {
                            keyword: ''
                        },
                        success: function(data) {
                            $('#resultncc').html(data);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>