<?php
include_once(__DIR__ . "/../Model/mDmuc.php");

class controlDanhmuc
{
    function getAllDanhmuc()
    {
        $p = new modelDanhmuc();
        $tblloai = $p->SelectAllDanhmuc();
        return $tblloai;
    }

    function getDanhmuc($dm)
    {
        $p = new modelDanhmuc();
        $tblloai = $p->SelectDanhmuc($dm);
        return $tblloai;
    }

    function AddDanhmuc($tenloai)
    {
        $p = new modelDanhmuc();
        $add = $p->InsertDanhmuc($tenloai);
        if ($add) {
            return 1;
        } else {
            return 0;
        }
    }

    function EditDanhmuc($tenloai, $dm)
    {
        $p = new modelDanhmuc();
        $edit = $p->UpdateDanhmuc($tenloai, $dm);
        if ($edit) {
            return 1;
        } else {
            return 0;
        }
    }

    function DeleteDanhmuc($maloai)
    {
        $p = new modelDanhmuc();
        $del = $p->DeleteDanhmuc($maloai);
        if ($del) {
            return 1;
        } else {
            return 0;
        }
    }

    function SearchDanhmuc($searchdm)
    {
        $p = new modelDanhmuc();
        $tblloai = $p->SearchDanhmuc($searchdm);
        return $tblloai;
    }
}
