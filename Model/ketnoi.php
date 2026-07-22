<?php
class clsketnoi
{
    function ketnoiDB()
    {
        $con = mysqli_connect("localhost", "root", "", "itbook");
        if (!$con) {
            return false;
        }
        mysqli_set_charset($con, "utf8");
        return $con;
    }

    function dongketnoi($con)
    {
        mysqli_close($con);
    }
}
