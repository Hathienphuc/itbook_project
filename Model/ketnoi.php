<?php
    class clsketnoi {
        // Hàm kết nối CSDL
        // function ketnoiDB(& $con) {
        //     $con = mysqli_connect("localhost", "root", "");
        //     mysqli_set_charset($con, "utf8");
        //     if($con){
        //         return mysqli_select_db($con, "itbook");
        //     }else{
        //         return false;
        //     }
        // }

        // // Hàm đóng kết nối CSDL
        // function dongketnoi($con) {
        //     mysqli_close($con);
        // }

        // Hàm kết nối CSDL – GIỮ NGUYÊN TÊN HÀM VÀ THAM SỐ
        function ketnoiDB(& $con) {

        // Lấy thông tin từ biến môi trường Railway
        $host = getenv("MYSQLHOST");
        $user = getenv("MYSQLUSER");
        $pass = getenv("MYSQLPASSWORD");
        $db   = getenv("MYSQLDATABASE");
        $port = getenv("MYSQLPORT");

        // Nếu chạy local thì tự động dùng localhost
        if (!$host) {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db   = "itbook";
            $port = 3306;
        }

        // Kết nối
        $con = mysqli_connect($host, $user, $pass, $db, $port);

        if($con){
            mysqli_set_charset($con, "utf8");
            return true;
        } else {
            return false;
        }
    }

    // Hàm đóng kết nối – GIỮ NGUYÊN
    function dongketnoi($con) {
        mysqli_close($con);
    }
    }

   

?>