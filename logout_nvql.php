<?php
session_start();

if (isset($_SESSION['user_name'])) {
    if (isset($_SESSION['nguoidung']) == 'Nhân viên giao hàng' || isset($_SESSION['nguoidung']) == 'Nhân viên bán hàng' || isset($_SESSION['nguoidung']) == 'Quản lý') {
        unset($_SESSION['user_name']);
        unset($_SESSION['nguoidung']);
        echo '<script>window.location.href="login_nvql.php";</script>';
    }
}
