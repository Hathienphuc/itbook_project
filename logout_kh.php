<?php
session_start();

if (isset($_SESSION['tendn'])) {
    if (isset($_SESSION['nguoidungkh']) == 'Khách hàng') {
        unset($_SESSION['tendn']);
        unset($_SESSION['nguoidungkh']);
        echo '<script>window.location.href="login_kh.php";</script>';
    }
}
