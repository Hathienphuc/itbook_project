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
                    <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Sửa thông tin loại sản phẩm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vEditDmuc.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3" style="margin-top: -16px;">
                            <input type="hidden" class="form-control" id="maloai" name="maloai">
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label class="form-label" style=" font-weight:600;">Tên loại sản phẩm:</label>
                            <input type="text" class="form-control" id="tenloai" placeholder="Nhập tên loại sản phẩm" name="tenloai">
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
                    <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Xóa thông tin loại sản phẩm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vDelDmuc.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="iddm" name="iddm">
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
                    <h4 class="modal-title" style="margin-left: 65px; margin-top: 5px;">Thêm thông tin loại sản phẩm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 13px; margin-top: -35px; border: 1px solid red; background-color: red;"></button>
                </div>

                <form action="View/vAddDmuc.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3" style="margin-top: 5px;">
                            <label class="form-label" style=" font-weight:600;">Tên loại sản phẩm:</label>
                            <input type="text" class="form-control" id="loaisp" placeholder="Nhập tên loại sản phẩm" name="loaisp">
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

    <h1>Thông tin loại sản phẩm</h1>

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
                id="searchdm"
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

    <div class="data" style="padding: 0 30px;" id="resultdm">
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
                $p = new controlDanhmuc();
                $tblloai = $p->getAllDanhmuc();

                if ($tblloai) {
                    if (mysqli_num_rows($tblloai) > 0) {
                        $dem = 1;
                        while ($row = mysqli_fetch_assoc($tblloai)) {
                            echo "<tr>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $dem++ . "</td>";
                            echo "<td style='text-align: center; border-bottom: 1px solid black; vertical-align: middle;'>" . $row['tenloai'] . "</td>";
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
                $('#maloai').val(data[0]);
                $('#tenloai').val(data[1]);
            });
            $('#suamodal form').submit(function(event) {
                var tenloai = $('#tenloai').val().trim();
                if (!tenloai) {
                    alert('Chưa nhập tên loại sản phẩm.');
                    event.preventDefault();
                }
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

        $('#themmodal form').submit(function(event) {
            var tenloai = $('#loaisp').val().trim();
            if (!tenloai) {
                alert('Chưa nhập tên loại sản phẩm.');
                event.preventDefault();
            }
        });

        $(document).ready(function() {
            $('#searchdm').on('input', function() {
                var searchKeyword = $(this).val();
                if (searchKeyword.length >= 2) {
                    $.ajax({
                        url: 'View/vSearchDmuc.php',
                        type: 'POST',
                        data: {
                            keyword: searchKeyword
                        },
                        success: function(data) {
                            $('#resultdm').html(data);
                        }
                    });
                } else {
                    $.ajax({
                        url: 'View/vSearchDmuc.php',
                        type: 'POST',
                        data: {
                            keyword: ''
                        },
                        success: function(data) {
                            $('#resultdm').html(data);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>