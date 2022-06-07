<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MovedirController extends Controller
{
    protected function todb()
    {
        $cameras = Camera::all();
        foreach ($cameras as $cam) {
            $camera = $cam->camera_id;

            // Verification des repertoires de stockage
            if (!File::isDirectory(base_path('/storage/app/public/ftp/' . $camera . '/medias'))) {
                File::makeDirectory(base_path('/storage/app/public/ftp/' . $camera . '/medias'));
            };
            if (!File::isDirectory(base_path('/storage/app/public/ftp/' . $camera . '/display'))) {
                File::makeDirectory(base_path('/storage/app/public/ftp/' . $camera . '/display'));
            };

            // recuperation des fichiers en attente
            $images = File::allFiles(base_path('/storage/app/public/ftp/' . $camera));

            foreach ($images as $image) {

                $repertoire = $image->getRelativePath();
                // exclure les repertoires de travail
                $exclude = array("medias", "display");
                if (!in_array($repertoire, $exclude)) {
                    $dateimg = $image->getCTime();
                    $fichier = $image->getFilename();
                    $success = File::move('/storage/app/public/ftp/' . $camera . '/' . $repertoire . '/' . $fichier, '/storage/app/public/ftp/' . $camera . '/medias/' . $fichier);
                    dd($success);

                    // Stockage de l'information    
                    $imagedb = new Images;
                    $imagedb->fichier = $fichier;
                    $imagedb->camera_id = $camera;
                    $imagedb->datetl = $dateimg;
                    $imagedb->save();
                    dd('pas dedans', $image);
                } else {
                    dd('dedans');
                };



                // deplacer ce fichier dans medias

            }
        }

        return 1;
    }
}
