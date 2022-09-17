<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeBladeFileCommand extends Command
{
    protected $signature = 'make:blade {path}';

    protected $description = 'Make Blade File Command';

    public function handle()
    {
        $ds = DIRECTORY_SEPARATOR;

        $folders = explode('.', Str::lower($this->argument('path')));

        $file_index = array_key_last($folders);

        $_folders = Arr::except($folders, $file_index);

        $_path = resource_path('views') . $ds . implode($ds, $_folders);

        $_file_path = $_path . $ds . $folders[$file_index] . '.blade.php';

        File::ensureDirectoryExists($_path,0777);

        if(File::exists($_file_path))
        {
            $this->error('File Already Exists !!');
            return;
        }

        File::put($_file_path,"");

        $this->info('Blade File Created Successfully');
    }
}
