<?php
include_once(__DIR__ . "/ketnoi.php");

class modelTaikhoan
{
    function SelectAllTaikhoan()
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `taikhoan` ORDER BY matk ASC";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectTaikhoan($tk)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `taikhoan` WHERE `matk` = '$tk'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function UpdateTaikhoan($tendn, $tk)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "UPDATE `taikhoan` SET `tendn` = '$tendn' WHERE `matk` = '$tk'";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function DeleteTaikhoan($matk)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "DELETE FROM `taikhoan` WHERE `matk` = '$matk'";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function SearchTaikhoan($searchtk)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * from taikhoan WHERE tendn LIKE '%$searchtk%' OR nguoidung LIKE '%$searchtk%' ORDER BY matk ASC";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function KhoiphucTaikhoan($matk)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "UPDATE `taikhoan` SET matkhau = '306ce8aa58eadd5a9a87e0f348907b59' WHERE `matk` = '$matk'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function KhoaTaikhoan($matk)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "UPDATE `taikhoan` SET khoatk = '1' WHERE `matk` = '$matk'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function MokhoaTaikhoan($matk)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "UPDATE `taikhoan` SET khoatk = '0' WHERE `matk` = '$matk'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }
}
