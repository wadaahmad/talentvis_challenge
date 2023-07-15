<?php

namespace services;

use dto\UserDto;

class UserService
{
    const session_key = 'user';
    const session_auth_key = 'auth';
    private $storage;
    public function __construct()
    {
        if (!$_SESSION[self::session_key])
            $_SESSION[self::session_key] = array();
        $this->storage = $_SESSION[self::session_key];

        $this->save($this->dummyFeon());
        $this->save($this->dummyVira());
        $this->commit();
    }
    public function dummyFeon()
    {
        $dto = new UserDto;
        $dto->id = 1;
        $dto->name = 'Feon';
        $dto->username = 'feon';
        $dto->password = 'feon';
        return $dto;
    }
    public function dummyVira()
    {
        $dto = new UserDto;
        $dto->id = 2;
        $dto->name = 'Vira';
        $dto->username = 'vira';
        $dto->password = 'vira';
        return $dto;
    }
    public function get()
    {
        return $_SESSION[self::session_key];
    }
    public function findUser($userId): ?UserDto
    {
        $exist = array_values(array_filter($this->get(), function ($data) use ($userId) {
            return ($data->id == $userId);
        }));
        return $exist ?  $exist[0] : null;
    }
    public function getOtherUser($userId)
    {
        return array_values(array_filter($this->get(), function ($data) use ($userId) {
            return ($data->id != $userId);
        }));
    }
    public function getLatestData(): ?UserDto
    {
        $data = $this->get();
        $sizeData = sizeof($data);
        return $data[$sizeData - 1];
    }

    public function save(UserDto $dto)
    {
        if (!$dto->id)
            $dto->id =  $this->getLatestData()->id + 1;
        $exist = array_filter($this->get(), function ($data) use ($dto) {
            return ($data->id == $dto->id);
        });
        if (!$exist)
            array_push($this->storage, $dto);
        return $this;
    }
    public function login(UserDto $dto)
    {
        $exist = array_values(array_filter($this->get(), function ($data) use ($dto) {
            return ($data->username == $dto->username && $data->password == $dto->password);
        }));
        if ($exist)
            $_SESSION[self::session_auth_key] = $exist[0];
    }
    public static function isAuth(): bool
    {
        return isset($_SESSION[self::session_auth_key]) && $_SESSION[self::session_auth_key];
    }
    public static function authUser(): UserDto
    {
        return $_SESSION[self::session_auth_key];
    }
    public static function authUserId(): ?int
    {
        return self::isAuth() ? self::authUser()->id : null;
    }
    public static function logout()
    {
        unset($_SESSION[self::session_auth_key]);
    }
    public function commit()
    {
        $_SESSION[self::session_key] = $this->storage;
    }
}
