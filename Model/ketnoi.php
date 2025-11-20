<?php
    class clsketnoi {
        // Hàm kết nối CSDL
        function ketnoiDB(& $con) {
            $con = mysqli_connect("localhost", "root", "");
            mysqli_set_charset($con, "utf8");
            if($con){
                return mysqli_select_db($con, "itbook");
            }else{
                return false;
            }
        }

        // Hàm đóng kết nối CSDL
        function dongketnoi($con) {
            mysqli_close($con);
        }
    }
?>