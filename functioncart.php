<?php
function getTotalQuantity()
{
    $totalQuantity = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $masp => $soluong) {
            $totalQuantity += $soluong;
        }
    }
    return $totalQuantity;
}
