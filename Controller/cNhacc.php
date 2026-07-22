<?php
include_once(__DIR__ . "/../Model/mNhacc.php");

class controlNhacungcap
{
    function getAllNhacungcap()
    {
        $p = new modelNhacungcap();
        $tblcomp = $p->SelectAllNhacungcap();
        return $tblcomp;
    }

    function getNhacungcap($ncc)
    {
        $p = new modelNhacungcap();
        $tblcomp = $p->SelectNhacungcap($ncc);
        return $tblcomp;
    }

    function AddNhacungcap($tenncc, $diachi, $sodienthoai, $email)
    {
        $p = new modelNhacungcap();
        $add = $p->InsertNhacungcap($tenncc, $diachi, $sodienthoai, $email);
        if ($add) {
            return 1;
        } else {
            return 0;
        }
    }

    function EditNhacungcap($tenncc, $diachi, $sodienthoai, $email, $ncc)
    {
        $p = new modelNhacungcap();
        $edit = $p->UpdateNhacungcap($tenncc, $diachi, $sodienthoai, $email, $ncc);
        if ($edit) {
            return 1;
        } else {
            return 0;
        }
    }

    function DeleteNhacungcap($mancc)
    {
        $p = new modelNhacungcap();
        $del = $p->DeleteNhacungcap($mancc);
        if ($del) {
            return 1;
        } else {
            return 0;
        }
    }

    function SearchNhacungcap($searchncc)
    {
        $p = new modelNhacungcap();
        $tblcomp = $p->SearchNhacungcap($searchncc);
        return $tblcomp;
    }
}
