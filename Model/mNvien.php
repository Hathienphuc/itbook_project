<?php
include_once(__DIR__ . "/ketnoi.php");

class modelNhanvien
{
    function SelectAllNhanvien()
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM nhanvien nv JOIN taikhoan tk ON nv.matk = tk.matk ORDER BY manv ASC";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectNhanvien($nv)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `nhanvien` WHERE `manv` = '$nv'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectAllNhanvienbyTaikhoan($matk)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `nhanvien` WHERE `matk` = '$matk'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function DeleteNhanvien($manv)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "DELETE FROM `nhanvien` WHERE `manv` = '$manv'";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function SearchNhanvien($searchnv)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM nhanvien nv JOIN taikhoan tk ON nv.matk = tk.matk WHERE tennv LIKE '%$searchnv%' OR diachi LIKE '%$searchnv%' OR email LIKE '%$searchnv%' OR tendn LIKE '%$searchnv%' ORDER BY manv ASC";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }
}
