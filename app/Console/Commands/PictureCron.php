<?php

namespace App\Console\Commands;

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
        //$disk = Storage::disk('ftp');
        // lister toutes les repertoires
        //$files = $disk->allDirectories();

        $success = File::copyDirectory(base_path('../ftp'), base_path('/storage/app/public/ftp'));

        return 0;
    }
}
