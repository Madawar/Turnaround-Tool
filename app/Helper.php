<?php
/**
 * Created by PhpStorm.
 * User: dwanyoike
 * Date: 5/31/2018
 * Time: 9:11 PM
 */

namespace App;

use Illuminate\Http\Request;
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
}