<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MovedirController extends Controller
{
    protected function copy()
    {
        $cameras = Camera::all();
        foreach ($cameras as $cam) {
            $camera = $cam->camera_id;
            $success = File::copyDirectory(base_path('../ftp/' . $camera), base_path('/storage/app/public/ftp/' . $camera), true);
            File::cleanDirectory(base_path('../ftp/' . $camera));
        }


        return 1;
    }
}
