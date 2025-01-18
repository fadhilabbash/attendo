<?php

namespace App\Console\Commands;

use App\Models\ZKTecoUser;
use App\Services\ZKTecoService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncDeviceUsers extends Command
{
    protected $signature = 'sync:device-users';
    protected $description = 'Sync users between ZKTeco device and MySQL database';

    public function __construct(private readonly ZKTecoService $zkService)
    {
        parent::__construct();
    }


    public function handle()
    {
        try {
            $this->zkService->connect();
            $this->info('Connected to ZKTeco device.');

            // Fetch users from the device
            $deviceUsers = $this->zkService->getUsers();
            $this->info('Fetched users from the device.');

            foreach ($deviceUsers as $deviceUser) {
                // Sync each user with the database
                ZKTecoUser::updateOrCreate(
                    ['uid' => $deviceUser['uid']],
                    [
                        'userid' => $deviceUser['userid'],
                        'name' => $deviceUser['name'],
                        'password' => $deviceUser['password'] ?? null,
                        'role' => $deviceUser['role'] ?? 1,
                        'cardno' => $deviceUser['cardno'] ?? null,
                    ]
                );
            }

            $this->info('Users synchronized successfully!');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        } finally {
            $this->zkService->disconnect();
            $this->info('Disconnected from ZKTeco device.');
        }
    }
}
