<?php
include_once(__DIR__ . "/../Model/mDhang.php");

class controlDonhang
{
    function getAllDonhang()
    {
        $p = new modelDonhang();
        $tblorder = $p->SelectAllDonhang();
        return $tblorder;
    }

    function getDonhang($hd)
    {
        $p = new modelDonhang();
        $tblorder = $p->SelectDonhang($hd);
        return $tblorder;
    }

    function getAllDonhangbyKhachhang($makh)
    {
        $p = new modelDonhang();
        $tblorder = $p->SelectAllDonhangbyKhachhang($makh);
        return $tblorder;
    }

    function getAllDonhangbyNhanvien($manv)
    {
        $p = new modelDonhang();
        $tblorder = $p->SelectAllDonhangbyNhanvien($manv);
        return $tblorder;
    }

    function SearchDonhang($searchhd)
    {
        $p = new modelDonhang();
        $tblorder = $p->SearchDonhang($searchhd);
        return $tblorder;
    }

    function XacnhanDonhang($mahd)
    {
        $p = new modelDonhang();
        $tblorder = $p->XacnhanDonhang($mahd);
        return $tblorder;
    }

    function getAllCTDonhang($mahd)
    {
        $p = new modelDonhang();
        $tblorder = $p->SelectAllCTDonhang($mahd);
        return $tblorder;
    }

    function GiaohangDonhang($mahd)
    {
        $p = new modelDonhang();
        $tblorder = $p->GiaohangDonhang($mahd);
        return $tblorder;
    }

    function HoanthanhDonhang($mahd)
    {
        $p = new modelDonhang();
        $tblorder = $p->HoanthanhDonhang($mahd);
        return $tblorder;
    }
}
