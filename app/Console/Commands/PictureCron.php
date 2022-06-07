<?php

namespace App\Console\Commands;

use App\Models\Camera;
use App\Models\Images;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class PictureCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'picture:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cameras = Camera::all();
        foreach ($cameras as $cam) {
            $camera = $cam->camera_id;
            $success = File::copyDirectory(base_path('../ftp/' . $camera), base_path('/storage/app/public/ftp/' . $camera), true);
            File::cleanDirectory(base_path('../ftp/' . $camera));
        }
        // Préparation des médias

        $cameras = Camera::all();


        foreach ($cameras as $cam) {
            $camera = $cam->camera_id;
            $cameraid = $cam->id;

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
                    // fairele transfert uniquement si la taille ne varie pas
                    $success = File::move(base_path('/storage/app/public/ftp/' . $camera . '/' . $repertoire . '/' . $fichier),  base_path('/storage/app/public/ftp/' . $camera . '/medias/' . $fichier));
                    sleep(2);
                    // Stockage de l'information    
                    $imagedb = new Images;
                    $imagedb->fichier = $fichier;
                    $imagedb->camera_id = $cameraid;
                    $imagedb->datetl = date("Y-m-d H:i:s", $dateimg);
                    $imagedb->save();

                    // copier la derniere image dans display

                    File::copy(base_path('/storage/app/public/ftp/' . $camera . '/medias/' . $fichier),  base_path('/storage/app/public/ftp/' . $camera . '/display/last.jpg'));
                };
            }
        }


        return 1;
    }
}
