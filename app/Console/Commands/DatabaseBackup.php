<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;
use  App\Models\DbBackup\DbBackup ;
use Illuminate\Support\Facades\File;
// use File;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creat Backup for existing data base';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = "backup-" . time().".sql";
        DbBackup::create(['db_backup_files'=>$filename]);

  if(!file_exists(storage_path()."/app/back/".$filename)){
    $command = "mysqldump -u"." ".env('DB_USERNAME')."-p"." ".env('DB_PASSWORD')."zaratica >".storage_path()."/app/backup/".$filename;
    $returnVar = NULL;
    $output  = NULL;
    exec($command, $output, $returnVar);

  }
//   else{}
      
        // $this->callSilent('backup:run');
    }
}
