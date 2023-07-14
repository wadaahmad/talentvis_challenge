<?php

namespace controller;

use dto\BalanceDto;
use responder\Responder;
use services\BalanceService;

class BalanceController
{
    private BalanceDto $dto;
    private BalanceService $service;
    public function __construct()
    {
        $this->dto = new BalanceDto;
        $this->service = new BalanceService;
    }
    public function getBalance($userId = null)
    {
        return Responder::response(200, $this->service->getLatesBalance($userId));
    }
    public function deposit(int $debit, $userId = null)
    {
        $this->dto->type = 'Deposit';
        $this->dto->debit = $debit;
        $this->dto->userId = $userId;
        $save = $this->service->save($this->dto);
        $save->commit();
        return Responder::response(200, $save->getLatestData($userId));
    }
    public function withdraw(int $credit, $userId = null)
    {
        if ($this->service->getLatesBalance($userId) < $credit)
            return Responder::response(400, 'Your balance is insufficient');

        $this->dto->type = 'Withdraw';
        $this->dto->credit = $credit;
        $this->dto->userId = $userId;
        $save = $this->service->save($this->dto);
        $save->commit();
        return Responder::response(200, $save->getLatestData($userId));
    }
    public function getHistory($userId = null)
    {
        return Responder::response(200, $this->service->get($userId));
    }
}
