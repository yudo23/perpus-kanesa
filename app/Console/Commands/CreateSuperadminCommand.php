<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Enums\UserEnum;
use App\Helpers\CodeHelper;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Throwable;

class CreateSuperadminCommand extends Command
{
    protected $signature = 'superadmin:create';

    protected $description = 'Create a superadmin user';

    /**
     * @throws Throwable
     */
    public function handle(): int
    {
        DB::beginTransaction();
        try {
            $name = $this->ask('What is the name of the superadmin?');
            if (empty($name)) {
                $this->error('Name is required');

                return CommandAlias::INVALID;
            }

            $username = $this->ask('What is the username of the superadmin?');
            if (empty($username)) {
                $this->error('Username is required');

                return CommandAlias::INVALID;
            }

            $password = $this->secret('What is the password of the superadmin?');
            if (empty($password)) {
                $this->error('Password is required');

                return CommandAlias::INVALID;
            }
            if (strlen($password) < 8) {
                $this->error('Password is too short. It must be at least 8 characters');

                return CommandAlias::INVALID;
            }

            $checkExistUsername = new User();
            $checkExistUsername = $checkExistUsername->where("username",$username);
            $checkExistUsername = $checkExistUsername->first();

            if($checkExistUsername){
                $this->error('Username has been taken');

                return CommandAlias::INVALID;
            }

            $this->info('Creating a owner user with the following credentials:');
            $this->info("Name: $name");
            $this->info("Username: $username");

            if ($this->confirm('Do you wish to create the user?')) {
                $this->info('Creating the user...');
                $user = User::create([
                    'name' => $name,
                    'username' => $username,
                    'password' => Hash::make($password),
                    'status' => UserEnum::STATUS_ACTIVE_TRUE,
                ]);
                $user->assignRole(RoleEnum::SUPERADMIN);
                DB::commit();
                $this->info('Superadmin user created successfully.');
            } else {
                $this->error('Superadmin creation cancelled!');
            }

            return CommandAlias::SUCCESS;
        } catch (Exception $e) {
            DB::rollBack();
            $this->error('Could not create the user.');
            $this->error($e->getMessage());

            return CommandAlias::FAILURE;
        }
    }
}
