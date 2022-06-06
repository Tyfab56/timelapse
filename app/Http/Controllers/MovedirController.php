<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MovedirController extends Controller
{
    protected function copy()
    {
        dd(base_path('../ftp'));
        $success = File::copyDirectory(base_path('../ftp'), base_path('/storage/app/public/ftp'));

        return 1;
    }
}
