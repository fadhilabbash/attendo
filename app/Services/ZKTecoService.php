<?php

namespace App\Services;

use Rats\Zkteco\Lib\ZKTeco;

class ZKTecoService
{
    protected $zk;

    public function __construct()
    {
        $ip = env('ZK_DEVICE_IP', '192.168.1.201'); // Set default IP in .env
        $this->zk = new ZKTeco($ip);
    }

    public function connect()
    {
        return $this->zk->connect();
    }

    public function disconnect()
    {
        return $this->zk->disconnect();
    }

    public function getAttendance()
    {
        return $this->zk->getAttendance();
    }

    public function clearAttendance()
    {
        return $this->zk->clearAttendance();
    }

    public function getUsers()
    {
        return $this->zk->getUser();
    }

    public function setUser($uid, $userid, $name, $password, $role)
    {
        return $this->zk->setUser($uid, $userid, $name, $password, $role);
    }

    public function deleteUser($uid)
    {
        return $this->zk->removeUser($uid);
    }

    public function getDeviceTime()
    {
        return $this->zk->getTime();
    }

    public function setDeviceTime($time = null)
    {
        $time = $time ?? date('Y-m-d H:i:s');
        return $this->zk->setTime($time);
    }

    public function enableDevice()
    {
        return $this->zk->enableDevice();
    }

    public function disableDevice()
    {
        return $this->zk->disableDevice();
    }

    public function restartDevice()
    {
        return $this->zk->restart();
    }

    public function getFirmwareVersion()
    {
        return $this->zk->version();
    }

    public function getSerialNumber()
    {
        return $this->zk->serialNumber();
    }
}
