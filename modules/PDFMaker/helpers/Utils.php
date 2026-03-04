<?php

class PDFMaker_Utils_Helper
{
    public static function count($value)
    {
        return !empty($value) ? count((array)$value) : 0;
    }
}