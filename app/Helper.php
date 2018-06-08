<?php
/**
 * Created by PhpStorm.
 * User: dwanyoike
 * Date: 5/31/2018
 * Time: 9:11 PM
 */

namespace App;

use Route;

class Helper
{
    public function isCurrent($path)
    {


        $route = Route::current();


        if ($route->uri == $path) {
            return 'active';
        }
    }

    public function FormatTime($time)
    {
        if (is_numeric($time)) {
            if (strlen($time) == 1) {
                return '0' . $time . ':' . '00';
            }
            if (strlen($time) == 2) {
                return $time . ':' . '00';
            }
            if (strlen($time) == 3) {
                return '0' . substr($time, 0, 1) . ':' . substr($time, 1, 2);
            }
            if (strlen($time) == 4) {
                $arr = str_split($time, strlen($time) / 2);
                return $arr[0] . ':' . $arr[1];
            }
        } else if (strpos($time, ':') !== false) {
            if (strlen($time) == 5) {
                return $time;
            }
            if (strlen($time) == 4) {
                $arr = explode(":", $time);
                if (strlen($arr[0]) == 1) {
                    $arr[0] = '0' . $arr[0];
                }
                return $arr[0] . ':' . $arr[1];
            }
        }
    }
}