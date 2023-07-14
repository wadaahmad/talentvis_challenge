<?php

namespace services;

use dto\BalanceDto;

class BalanceService
{
    const session_key = 'balance';
    private $storage;
    public function __construct()
    {
        if (!$_SESSION[self::session_key])
            $_SESSION[self::session_key] = array();
        $this->storage = $_SESSION[self::session_key];
    }
    public function get($userId = null)
    {
        return array_values(array_filter($_SESSION[self::session_key], function ($data) use ($userId) {
            if ($userId)
                return ($data->userId == $userId);
            else
                return (!$data->userId);
        }));
    }
    public function getLatestData($userId = null): ?BalanceDto
    {
        $data = $this->get($userId);
        $sizeData = sizeof($data);
        return $data[$sizeData - 1];
    }
    public function getLatesBalance($userId = null)
    {
        $latestBalance = $this->getLatestData($userId);
        return  $latestBalance ? $latestBalance->balance : 0;
    }
    public function calculateBalance(BalanceDto $dto)
    {
        $balance = $this->getLatesBalance($dto->userId);
        if ($dto->type == 'Deposit')
            $dto->balance = $balance + $dto->debit;
        if ($dto->type == 'Withdraw')
            $dto->balance = $balance - $dto->credit;
        return $dto;
    }
    public function save(BalanceDto $dto)
    {
        if (!$dto->id)
            $dto->id =  $this->getLatestData()->id + 1;
        if (!$dto->datetime)
            $dto->datetime = date("Y-m-d H:i");
        $dto = $this->calculateBalance($dto);
        array_push($this->storage, $dto);
        return $this;
    }
    public function commit()
    {
        $_SESSION[self::session_key] = $this->storage;
    }
}
