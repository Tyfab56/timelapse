<?php

namespace App\Console\Commands;

use App\Models\Camera;
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



        return 1;
    }
}
