<?php

if (!function_exists('format_rupiah')) {
    function format_rupiah($angka)
    {
        $hasil = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil;
    }
}
