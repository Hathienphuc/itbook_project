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
                    <h4 class="modal-title" style="margin-left: 90px; margin-top: 5px;">Sửa thông tin tài khoản</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vEditTkhoan.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3" style="margin-top: -16px;">
                            <input type="hidden" class="form-control" id="matk" name="matk">
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label class="form-label" style=" font-weight:600;">Tài khoản:</label>
                            <input type="text" class="form-control" id="tendn" placeholder="Nhập tài khoản" name="tendn">
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
                    <h4 class="modal-title" style="margin-left: 90px; margin-top: 5px;">Xóa thông tin tài khoản</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vDelTkhoan.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="idtk" name="idtk">
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

    <div class="modal" id="khoiphucmodal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="margin-left: 115px; margin-top: 5px;">Khôi phục mật khẩu</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vResMkhau.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="mtk" name="mtk">
                        <h3 class="modal-title" style="margin-left: 50px; font-family: 'Lora', serif; color: red; font-weight:600;">Bạn có muốn khôi phục không ?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" name="restore">Đồng ý</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h1>Thông tin tài khoản</h1>

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
            id="searchtk"
            style="width: 220px; display: inline-block; margin-left: 10px; border: 1px solid black;">
    </div>

    <div class="data" style="padding: 0 30px;" id="resulttk">
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
                $p = new controlTaikhoan();
                $tblaccount = $p->getAllTaikhoan();

                if ($tblaccount) {
                    if (mysqli_num_rows($tblaccount) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($tblaccount)) {
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
                $('#matk').val(data[0]);
                $('#tendn').val(data[1]);
                $('#suamodal form').submit(function(event) {
                    var tendn = $('#tendn').val().trim();
                    if (!tendn) {
                        alert('Chưa nhập tài khoản.');
                        event.preventDefault();

                    } else if (tendn.length < 5) {
                        alert('Tài khoản phải có ít nhất 5 ký tự.');
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

        $(document).ready(function() {
            $('#searchtk').on('input', function() {
                var searchKeyword = $(this).val();
                if (searchKeyword.length >= 2) {
                    $.ajax({
                        url: 'View/vSearchTkhoan.php',
                        type: 'POST',
                        data: {
                            keyword: searchKeyword
                        },
                        success: function(data) {
                            $('#resulttk').html(data);
                        }
                    });
                } else {
                    $.ajax({
                        url: 'View/vSearchTkhoan.php',
                        type: 'POST',
                        data: {
                            keyword: ''
                        },
                        success: function(data) {
                            $('#resulttk').html(data);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>