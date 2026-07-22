<?php
include_once(__DIR__ . "/ketnoi.php");

class modelSanpham
{
    function SelectAllSanpham()
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM sanpham sp JOIN loaisanpham lsp ON sp.maloai = lsp.maloai JOIN nhacungcap ncc ON sp.mancc = ncc.mancc ORDER BY masp ASC";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectSanpham($sp)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `sanpham` WHERE `masp` = '$sp'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectAllSanphambyNhacungcap($mancc)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `sanpham` WHERE `mancc` = '$mancc'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function SelectAllSanphambyDanhmuc($maloai)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM `sanpham` WHERE `maloai` = '$maloai'";
            $table = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function InsertSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "INSERT INTO `sanpham` (`mancc`, `maloai`,`tensp` , `tacgia` , `soluong`, `giaban`, `ngayxuatban`, `hinhanh`) VALUES ('$mancc', '$maloai', '$tensp', '$tacgia', '$soluong', '$giaban', '$ngayxuatban', '$hinhanh')";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function UpdateSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh, $sp)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "UPDATE `sanpham` SET `mancc` = '$mancc', `maloai` = '$maloai',  `tensp` = '$tensp', `tacgia` = '$tacgia', `soluong` = '$soluong', `giaban` = '$giaban',  `ngayxuatban` = '$ngayxuatban', `hinhanh` = '$hinhanh' WHERE `masp` = '$sp'";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function DeleteSanpham($masp)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "DELETE FROM `sanpham` WHERE `masp` = '$masp'";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }

    function SearchSanpham($searchsp)
    {
        $p = new clsketnoi();
        if ($con = $p->ketnoiDB()) {
            $string = "SELECT * FROM sanpham sp JOIN loaisanpham lsp ON sp.maloai = lsp.maloai JOIN nhacungcap ncc ON sp.mancc = ncc.mancc WHERE tensp LIKE '%$searchsp%' OR tacgia LIKE '%$searchsp%' OR tenncc LIKE '%$searchsp%' OR tenloai LIKE '%$searchsp%' ORDER BY masp ASC";
            $kq = mysqli_query($con, $string);
            $p->dongketnoi($con);
            return $kq;
        } else {
            return false;
        }
    }
}
