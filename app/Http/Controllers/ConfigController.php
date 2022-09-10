<?php

namespace App\Http\Controllers;

use App\Models\Config;

class ConfigController extends Controller
{
    function index() {
        $config = new Config();
    }
}
