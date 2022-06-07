<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MovedirController extends Controller
{
    protected function todb()
    {
        $cameras = Camera::all();
        foreach ($cameras as $cam) {
            $camera = $cam->camera_id;
            $success = File::allFiles(base_path('/storage/app/public/ftp/' . $camera));

            dd($success);
        }


        return 1;
    }
}
