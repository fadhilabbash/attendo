<?php

namespace App\Http\Controllers;

use App\Models\ZKTecoUser;
use App\Services\ZKTecoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AttendanceController extends Controller
{
    protected $zkService;

    public function __construct(ZKTecoService $zkService)
    {
        $this->zkService = $zkService;
    }

    public function connect()
    {
        if ($this->zkService->connect()) {
            return response()->json(['message' => 'Connected to ZKTeco device']);
        }
        return response()->json(['message' => 'Failed to connect to ZKTeco device'], 500);
    }

    public function getAttendance()
    {
        $this->zkService->connect();
        $attendance = $this->zkService->getAttendance();
        $this->zkService->disconnect();

        return response()->json($attendance);
    }

    public function clearAttendance()
    {
        $this->zkService->connect();
        $result = $this->zkService->clearAttendance();
        $this->zkService->disconnect();

        return response()->json(['message' => 'Attendance data cleared', 'result' => $result]);
    }

    public function getUsers()
    {
        $this->zkService->connect();
        $users = $this->zkService->getUsers();
        $this->zkService->disconnect();

        return response()->json($users);
    }

    public function addUser(Request $request)
    {
        $this->zkService->connect();
        $result = $this->zkService->setUser(
            $request->uid,
            $request->userid,
            $request->name,
            $request->password ?? '',
            $request->role ?? 0
        );
        $this->zkService->disconnect();

        return response()->json(['message' => 'User added', 'result' => $result]);
    }

    public function deleteUser($uid)
    {
        $this->zkService->connect();
        $result = $this->zkService->deleteUser($uid);
        $this->zkService->disconnect();

        return response()->json(['message' => 'User deleted', 'result' => $result]);
    }

    public function getDeviceInfo()
    {
        $this->zkService->connect();
        $info = [
            'firmware_version' => $this->zkService->getFirmwareVersion(),
            'serial_number' => $this->zkService->getSerialNumber(),
            'device_time' => $this->zkService->getDeviceTime(),
        ];
        $this->zkService->disconnect();

        return response()->json($info);
    }
    public function syncDeviceUsers()
    {
        // Run the Artisan command to sync device users
        Artisan::call('sync:device-users');

        // Return a response
        return response()->json(['message' => 'Device users sync started']);
    }
    public function usersDb()
    {
        // Run the Artisan command to sync device users
        $users = ZKTecoUser::all();
        // Return a response
        return response()->json(['data' => $users, 'message' => 'Device users sync started']);
    }
}
