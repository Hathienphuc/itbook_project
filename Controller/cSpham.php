<?php
include_once(__DIR__ . "/../Model/mSpham.php");

class controlSanpham
{
    function getAllSanpham()
    {
        $p = new modelSanpham();
        $tblproduct = $p->SelectAllSanpham();
        return $tblproduct;
    }

    function getSanpham($sp)
    {
        $p = new modelSanpham();
        $tblproduct = $p->SelectSanpham($sp);
        return $tblproduct;
    }

    function getAllSanphambyNhacungcap($mancc)
    {
        $p = new modelSanpham();
        $tblproduct = $p->SelectAllSanphambyNhacungcap($mancc);
        return $tblproduct;
    }

    function getAllSanphambyDanhmuc($maloai)
    {
        $p = new modelSanpham();
        $tblproduct = $p->SelectAllSanphambyDanhmuc($maloai);
        return $tblproduct;
    }

    function AddSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh, $type, $file)
    {
        if (empty($hinhanh)) {
            echo '<script>alert("Không upload hình ảnh.")</script>';
            header("refresh: 0; url='../quanly.php?spham'");
            return;
        }
        $type = array('png', 'jpg', 'jpeg');
        $file = strtolower(pathinfo($hinhanh, PATHINFO_EXTENSION));
        if (!in_array($file, $type)) {
            echo '<script>alert("Upload hình ảnh không đúng định dạng.")</script>';
            header("refresh: 0; url='../quanly.php?spham'");
            return;
        }
        $p = new modelSanpham();
        $add = $p->InsertSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh);

        if ($add) {
            return 1;
        } else {
            return 0;
        }
    }

    function EditSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh, $type, $file, $sp)
    {
        // Kiểm tra hình ảnh
        if (empty($hinhanh)) {
            echo '<script>alert("Không upload hình ảnh.")</script>';
            header("refresh: 0; url='../quanly.php?spham'");
            return;
        }
        $type = array('png', 'jpg', 'jpeg');
        $file = strtolower(pathinfo($hinhanh, PATHINFO_EXTENSION));
        if (!in_array($file, $type)) {
            echo '<script>alert("Upload hình ảnh không đúng định dạng.")</script>';
            header("refresh: 0; url='../quanly.php?spham'");
            return;
        }
        $p = new modelSanpham();
        $edit = $p->UpdateSanpham($mancc, $maloai, $tensp, $tacgia, $soluong, $giaban, $ngayxuatban, $hinhanh, $sp);
        if ($edit) {
            return 1;
        } else {
            return 0;
        }
    }

    function DeleteSanpham($masp)
    {
        $p = new modelSanpham();
        $del = $p->DeleteSanpham($masp);
        if ($del) {
            return 1;
        } else {
            return 0;
        }
    }

    function SearchSanpham($searchsp)
    {
        $p = new modelSanpham();
        $tblproduct = $p->SearchSanpham($searchsp);
        return $tblproduct;
    }
}
