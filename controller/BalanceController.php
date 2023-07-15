<?php

namespace controller;

use dto\BalanceDto;
use responder\Responder;
use services\BalanceService;
use services\UserService;

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
    public function Transfer(int $amountTransfer, $fromUserId, $toUserId)
    {
        $userService = new UserService;
        $fromUser = $userService->findUser($fromUserId);
        $toUser = $userService->findUser($toUserId);

        $fromUserBalance = $this->service->getLatesBalance($fromUserId);
        $toUserBalance = $this->service->getLatesBalance($toUserId);
        if ($fromUserBalance < $amountTransfer)
            return Responder::response(400, 'Your balance is insufficient');
        // save as credit in "from user"
        $dto = new BalanceDto;
        $dto->type = 'Transfer';
        $dto->credit = $amountTransfer;
        $dto->userId = $fromUserId;
        $dto->balance = $fromUserBalance - $amountTransfer;
        $dto->description = "Transfer to $toUser->name";
        $save = $this->service->save($dto);
        $save->commit();

        // save as debit in "to user"
        $dto = new BalanceDto;
        $dto->type = 'Transfer';
        $dto->debit = $amountTransfer;
        $dto->userId = $toUserId;
        $dto->balance = $toUserBalance + $amountTransfer;
        $dto->description = "Transfer from $fromUser->name";
        $save = $this->service->save($dto);
        $save->commit();
        return Responder::response(200, $save->getLatestData($fromUserId));
    }
    public function getHistory($userId = null)
    {
        return Responder::response(200, $this->service->get($userId));
    }
}
