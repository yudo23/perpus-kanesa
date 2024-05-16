<?php

namespace App\Jobs;

use App\Imports\StudentImport;
use App\Jobs\Notify\NotifyStudentImportJob;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file,$user)
    {
        $this->file = $file;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::queueImport(new StudentImport($this->user), storage_path('app/public/import/students/'.$this->file))->chain([
            new NotifyStudentImportJob($this->user),
        ]); //MENJALANKAN PROSES IMPORT
        unlink(storage_path('app/public/import/students/'.$this->file));
    }
}
