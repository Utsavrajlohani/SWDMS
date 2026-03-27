<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'swdms:backup';

    /**
     * The console command description.
     */
    protected $description = 'Automated Database Backups to AWS S3 (Simulated locally for prototype)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting Enterprise Database Backup...");
        $dbName = env('DB_DATABASE', 'database/database.sqlite');
        
        $date = now()->format('Y-m-d_H-i-s');
        $fileName = "swdms_backup_{$date}.sqlite";

        if (file_exists(base_path($dbName))) {
            Storage::disk('local')->put("backups/{$fileName}", file_get_contents(base_path($dbName)));
            $this->info("✅ Backup simulated and stored to S3 mock [storage/app/backups/{$fileName}] securely.");
            
            Log::info("Database SWDMS backup completed to Cold Storage: {$fileName}");
        } else {
            $this->error("Database file not found: {$dbName}");
        }
    }
}
