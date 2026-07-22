<?php
session_start();
include_once(__DIR__ . "/Model/ketnoi.php");
include_once(__DIR__ . "/functioncart.php");
$p = new clsketnoi();
$con = $p->ketnoiDB();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add":
            $result = update_cart($con, true);
            $totalQuantity = getTotalQuantity();
            $result['total_quantity'] = $totalQuantity;
            echo json_encode($result);
            break;

        case "update":
            $result = update_cart($con);
            $totalQuantity = getTotalQuantity();
            $result['total_quantity'] = $totalQuantity;
            echo json_encode($result);
            break;

        case "delete":
            if (isset($_POST['masp'])) {
                unset($_SESSION["cart"][$_POST['masp']]);
            }
            echo json_encode(array(
                'status' => 1,
                'message' => 'Xóa sản phẩm thành công.',
                'total_quantity' => getTotalQuantity()
            ));
            break;
        default:
            break;
    }
}

function update_cart($con, $add = false)
{
    foreach ($_POST['soluong'] as $masp => $soluong) {
        if ($soluong === '') {
            return array(
                'status' => 1,
                'message' => "Vui lòng nhập số lượng mua."
            );
        }
    }

    $changeQuantity = false;
    foreach ($_POST['soluong'] as $masp => $soluong) {
        if (!ctype_digit($soluong) || $soluong == 0) {
            return array(
                'status' => 1,
                'message' => "Không nhập số lượng bằng 0, số âm, kí tự đặc biệt."
            );
        } else {
            if (!isset($_SESSION["cart"][$masp])) {
                $_SESSION["cart"][$masp] = 0;
            }

            if ($add) {
                $_SESSION["cart"][$masp] += $soluong;
            } else {
                $_SESSION["cart"][$masp] = $soluong;
            }
            $addProduct = mysqli_query($con, "SELECT `soluong` FROM `sanpham` WHERE `masp` = " . $masp);
            $addProduct = mysqli_fetch_assoc($addProduct);

            if ($_SESSION["cart"][$masp] > $addProduct['soluong']) {
                $_SESSION["cart"][$masp] = $addProduct['soluong'];
                if ($add) {
                    return array(
                        'status' => 0,
                        'message' => "Số lượng sản phẩm chỉ còn: " . $addProduct['soluong'] . " sản phẩm. Vui lòng kiểm tra lại giỏ hàng."
                    );
                } else {
                    $changeQuantity = true;
                }
            }

            if ($add) {
                return array(
                    'status' => 1,
                    'message' => "Thêm giỏ hàng thành công."
                );
            }
        }
    }

    if ($changeQuantity) {
        return array(
            'status' => 1,
            'message' => "Số lượng sản phẩm trong giỏ hàng đã thay đổi do số lượng tồn kho không đủ. Vui lòng kiểm tra lại giỏ hàng."
        );
    } else {
        return array(
            'status' => 1,
            'message' => "Cập nhật giỏ hàng thành công."
        );
    }
}
