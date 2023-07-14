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
    public function getBalance()
    {
        return Responder::response(200,$this->service->getLatesBalance());
    }
    public function deposit(int $debit)
    {
        $this->dto->type = 'Deposit';
        $this->dto->debit = $debit;
        $save = $this->service->save($this->dto);
        $save->commit();
        return Responder::response(200,$save->getLatestData());
    }
    public function withdraw(int $credit)
    {
        if($this->service->getLatesBalance() < $credit)
            return Responder::response(400,'Your balance is insufficient'); 
        
        $this->dto->type = 'Withdraw';
        $this->dto->credit = $credit;
        $save = $this->service->save($this->dto);
        $save->commit();
        return Responder::response(200,$save->getLatestData());
    }
}
