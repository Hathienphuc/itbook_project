<?php
include_once(__DIR__ . "/ketnoi.php");

class modelNhacungcap
{
    function SelectAllNhacungcap()
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `nhacungcap` ORDER BY mancc ASC";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectNhacungcap($ncc)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `nhacungcap` WHERE `mancc` = '$ncc'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function InsertNhacungcap($tenncc, $diachi, $sodienthoai, $email)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "INSERT INTO `nhacungcap`( `tenncc`, `diachi`, `sodienthoai`, `email`) VALUES('$tenncc', '$diachi', '$sodienthoai', '$email')";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function UpdateNhacungcap($tenncc, $diachi, $sodienthoai, $email, $ncc)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "UPDATE `nhacungcap` SET `tenncc` = '$tenncc', `diachi`='$diachi', `sodienthoai`= '$sodienthoai', `email` = '$email' WHERE `mancc` = '$ncc'";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function DeleteNhacungcap($mancc)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "DELETE FROM `nhacungcap` WHERE `mancc` = '$mancc'";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function SearchNhacungcap($searchncc)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * from nhacungcap WHERE tenncc LIKE '%$searchncc%' OR diachi LIKE '%$searchncc%' OR sodienthoai LIKE '%$searchncc%' OR email LIKE '%$searchncc%' ORDER BY mancc ASC";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }
}
