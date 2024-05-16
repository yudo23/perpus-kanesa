<?php

namespace App\Imports;

use App\Enums\RoleEnum;
use App\Enums\UserEnum;
use App\Models\User;
use App\Notifications\Failed\StudentImportFailedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use DB;
use Error;
use Log;

HeadingRowFormatter::default('none');

class StudentImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithCustomCsvSettings
{

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @param  Collection  $collection
     * @return void
     */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            if (count($collection) <= 0) {
                throw new Error('Data pada excel todal boleh kosong');
            }

            foreach ($collection as $index => $value) {
                $name = $value["Nama Lengkap"] ?? null;
                $username = $value["NISN"] ?? null;
                $study_program = $value["Jurusan"] ?? null;
                $offering = $value["Offering"] ?? null;

                if (empty($name)) {
                    throw new Error('Kolom Nama Lengkap pada excel tidak boleh kosong');
                }

                if (empty($username)) {
                    throw new Error('Kolom NISN pada excel tidak boleh kosong');
                }

                if (empty($study_program)) {
                    throw new Error('Kolom Jurusan pada excel tidak boleh kosong');
                }

                if (empty($offering)) {
                    throw new Error('Kolom Offering pada excel tidak boleh kosong');
                }

                $user = User::firstOrCreate([
                    'username' => $username,
                ],[
                    'name' => $name,
                    'username' => $username,
                    'study_program' => $study_program,
                    'offering' => $offering,
                    'password' => bcrypt($username),
                    'status' => UserEnum::STATUS_ACTIVE_TRUE,
                ]);

                $user->syncRoles([RoleEnum::STUDENT]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::emergency($th->getMessage());
            $this->user->notify(new StudentImportFailedNotification($th->getMessage()));
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => "\t",
        ];
    }
}
