<?php
    class clsketnoi {
        // Hàm kết nối CSDL
        function ketnoiDB(& $con) {
        $cleardb_url = getenv("CLEARDB_DATABASE_URL");

        if ($cleardb_url) {
            // Nếu chạy trên Heroku (ClearDB)
            $url = parse_url($cleardb_url);

            $server = $url["host"];
            $user = $url["user"];
            $pass = $url["pass"];
            $db = ltrim($url["path"], '/');
        } else {
            // Chạy local (WAMP)
            $server = "localhost";
            $user = "root";
            $pass = "";
            $db = "itbook";
        }

        $con = mysqli_connect($server, $user, $pass);
        mysqli_set_charset($con, "utf8");

        if ($con) {
            return mysqli_select_db($con, $db);
        } else {
            return false;
        }
    }

    // Hàm đóng kết nối CSDL
    function dongketnoi($con) {
        mysqli_close($con);
    }
    }
?>