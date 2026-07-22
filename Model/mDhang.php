<?php
include_once(__DIR__ . "/ketnoi.php");

class modelDonhang
{
    function SelectAllDonhang()
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM hoadon hd JOIN khachhang kh ON hd.makh = kh.makh JOIN nhanvien nv ON hd.manv = nv.manv ORDER BY mahd ASC";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectDonhang($hd)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM hoadon hd JOIN nhanvien nv ON hd.manv = nv.manv WHERE `mahd` = '$hd'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectAllDonhangbyKhachhang($makh)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `hoadon` WHERE `makh` = '$makh'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectAllDonhangbyNhanvien($manv)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `hoadon` WHERE `manv` = '$manv'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SearchDonhang($searchhd)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM hoadon hd JOIN khachhang kh ON hd.makh = kh.makh JOIN nhanvien nv ON hd.manv = nv.manv WHERE tennv LIKE '%$searchhd%' OR tenkhnew LIKE '%$searchhd%' OR diachinew LIKE '%$searchhd%' OR emailnew LIKE '%$searchhd%' OR phuongthuctt LIKE '%$searchhd%' ORDER BY mahd ASC";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function XacnhanDonhang($mahd)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "UPDATE `hoadon` SET trangthai = '1' WHERE `mahd` = '$mahd'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectAllCTDonhang($mahd)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM chitiethoadon cthd JOIN sanpham sp ON cthd.masp = sp.masp JOIN hoadon hd ON cthd.mahd = hd.mahd WHERE cthd.masp AND cthd.mahd = '$mahd' ORDER BY macthd ASC";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function GiaohangDonhang($mahd)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "UPDATE `hoadon` SET trangthai = '2' WHERE `mahd` = '$mahd'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function HoanthanhDonhang($mahd)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "UPDATE `hoadon` SET trangthai = '3', tinhtrangtt = 'Đã thanh toán' WHERE `mahd` = '$mahd'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }
}
