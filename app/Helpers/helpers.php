<?php
function changeCurency($amont, $baseCurncy)
{
    $array = ['USD' => 1, 'EGY' => 1 / 48.25, 'SAR' => 1 / 3.75];
    //  $amont = 1000;
    $base = 'egy';
    return $amont / $array[$baseCurncy];
}
