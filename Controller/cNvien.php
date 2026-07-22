<?php
include_once(__DIR__ . "/../Model/mNvien.php");

class controlNhanvien
{
    function getAllNhanvien()
    {
        $p = new modelNhanvien();
        $tblstaff = $p->SelectAllNhanvien();
        return $tblstaff;
    }

    function getNhanvien($nv)
    {
        $p = new modelNhanvien();
        $tblstaff = $p->SelectNhanvien($nv);
        return $tblstaff;
    }

    function getAllNhanvienbyTaikhoan($matk)
    {
        $p = new modelNhanvien();
        $tblstaff = $p->SelectAllNhanvienbyTaikhoan($matk);
        return $tblstaff;
    }

    function DeleteNhanvien($manv)
    {
        $p = new modelNhanvien();
        $del = $p->DeleteNhanvien($manv);
        if ($del) {
            return 1;
        } else {
            return 0;
        }
    }

    function SearchNhanvien($searchnv)
    {
        $p = new modelNhanvien();
        $tblstaff = $p->SearchNhanvien($searchnv);
        return $tblstaff;
    }
}
