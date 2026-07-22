<?php
include_once(__DIR__ . "/ketnoi.php");

class modelKhachhang
{
    function SelectAllKhachhang()
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM khachhang kh JOIN taikhoan tk ON kh.matk = tk.matk ORDER BY makh ASC";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectKhachhang($kh)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `khachhang` WHERE `makh` = '$kh'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectAllKhachhangbyTaikhoan($matk)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `khachhang` WHERE `matk` = '$matk'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function DeleteKhachhang($makh)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "DELETE FROM `khachhang` WHERE `makh` = '$makh'";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function SearchKhachhang($searchkh)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM khachhang kh JOIN taikhoan tk ON kh.matk = tk.matk WHERE tenkh LIKE '%$searchkh%' OR diachi LIKE '%$searchkh%' OR email LIKE '%$searchkh%' OR tendn LIKE '%$searchkh%' ORDER BY makh ASC";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }
}
