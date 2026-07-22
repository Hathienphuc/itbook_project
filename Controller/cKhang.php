<?php
include_once(__DIR__ . "/../Model/mKhang.php");

class controlKhachhang
{
    function getAllKhachhang()
    {
        $p = new modelKhachhang();
        $tblcustomer = $p->SelectAllKhachhang();
        return $tblcustomer;
    }

    function getKhachhang($kh)
    {
        $p = new modelKhachhang();
        $tblcustomer = $p->SelectKhachhang($kh);
        return $tblcustomer;
    }

    function getAllKhachhangbyTaikhoan($matk)
    {
        $p = new modelKhachhang();
        $tblcustomer = $p->SelectAllKhachhangbyTaikhoan($matk);
        return $tblcustomer;
    }

    function DeleteKhachhang($makh)
    {
        $p = new modelKhachhang();
        $del = $p->DeleteKhachhang($makh);
        if ($del) {
            return 1;
        } else {
            return 0;
        }
    }

    function SearchKhachhang($searchkh)
    {
        $p = new modelKhachhang();
        $tblcustomer = $p->SearchKhachhang($searchkh);
        return $tblcustomer;
    }
}
