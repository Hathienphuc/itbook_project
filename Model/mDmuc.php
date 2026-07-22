<?php
include_once(__DIR__ . "/ketnoi.php");

class modelDanhmuc
{
    function SelectAllDanhmuc()
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `loaisanpham` ORDER BY maloai ASC";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectDanhmuc($dm)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `loaisanpham` WHERE `maloai` = '$dm'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function InsertDanhmuc($tenloai)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "INSERT INTO `loaisanpham` (`tenloai`) VALUES ('$tenloai')";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function UpdateDanhmuc($tenloai, $dm)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "UPDATE `loaisanpham` SET `tenloai` = '$tenloai' WHERE `maloai` = '$dm'";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function DeleteDanhmuc($maloai)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "DELETE FROM `loaisanpham` WHERE `maloai` = '$maloai'";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function SearchDanhmuc($searchdm)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * from loaisanpham WHERE tenloai LIKE '%$searchdm%' ORDER BY maloai ASC";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }
}
