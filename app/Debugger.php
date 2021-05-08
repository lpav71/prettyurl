<?php

namespace app;

class Debugger
{
    static function debug($var)
    {
        echo '<pre>' . print_r($var, true) . '</pre>';
        die();
    }

    static function dump($var)
    {
        echo '<pre>' . print_r($var, true) . '</pre>';
    }
}