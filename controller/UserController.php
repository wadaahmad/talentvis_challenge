<?php

namespace controller;

use dto\UserDto;
use responder\Responder;
use services\UserService;

class UserController
{

    private UserDto $dto;
    private UserService $service;
    public function __construct()
    {
        $this->dto = new UserDto;
        $this->service = new UserService;
    }
    public function get()
    {
        return Responder::response(200, $this->service->get());
    }
    public function getOtherUser($userId)
    {
        return Responder::response(200, $this->service->getOtherUser($userId));
    }
    public function login($username, $password)
    {
        $this->dto->username = $username;
        $this->dto->password = $password;
        $this->service->login($this->dto);
        if ($this->service->isAuth())
            return Responder::response(200, $this->service->authUser());
        return Responder::response(401, 'Unauthorized');
    }
    public function logout()
    {
        $this->service->logout();
        return Responder::response(200, null);
    }
}
