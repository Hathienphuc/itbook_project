<?php
include_once(__DIR__ . "/../Model/mTkhoan.php");

class controlTaikhoan
{
    function getAllTaikhoan()
    {
        $p = new modelTaikhoan();
        $tblaccount = $p->SelectAllTaikhoan();
        return $tblaccount;
    }

    function getNhacungcap($tk)
    {
        $p = new modelTaikhoan();
        $tblaccount = $p->SelectTaikhoan($tk);
        return $tblaccount;
    }

    function EditTaikhoan($tendn, $tk)
    {
        $p = new modelTaikhoan();
        $edit = $p->UpdateTaikhoan($tendn, $tk);
        if ($edit) {
            return 1;
        } else {
            return 0;
        }
    }

    function DeleteTaikhoan($matk)
    {
        $p = new modelTaikhoan();
        $del = $p->DeleteTaikhoan($matk);
        if ($del) {
            return 1;
        } else {
            return 0;
        }
    }

    function SearchTaikhoan($searchtk)
    {
        $p = new modelTaikhoan();
        $tblaccount = $p->SearchTaikhoan($searchtk);
        return $tblaccount;
    }

    function KhoiphucTaikhoan($matk)
    {
        $p = new modelTaikhoan();
        $reset = $p->KhoiphucTaikhoan($matk);
        if ($reset) {
            return 1;
        } else {
            return 0;
        }
    }

    function KhoaTaikhoan($matk)
    {
        $p = new modelTaikhoan();
        $tblaccount = $p->KhoaTaikhoan($matk);
        return $tblaccount;
    }

    function MokhoaTaikhoan($matk)
    {
        $p = new modelTaikhoan();
        $tblaccount = $p->MokhoaTaikhoan($matk);
        return $tblaccount;
    }
}
