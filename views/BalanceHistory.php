<?php

use controller\BalanceController;
use services\UserService;

$controller = new BalanceController;
$balances = $controller->getHistory(UserService::authUserId());
$challenge = isset($_GET['challenge']) ? $_GET['challenge'] : '';

?>

<div style="margin-top: 20px;">
    <b>History</b>
    <table>
        <thead>
            <tr>
                <th>Time</th>
                <th>Type</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
                <?php
                if ($challenge == 3)
                    echo "<th>Description</th>";
                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($balances->data as $balance) {
                $description = '';
                if ($challenge == 3)
                    $description = "<td>$balance->description</td>";
                echo "
                    <tr>
                        <td>$balance->datetime</td>
                        <td>$balance->type</td>
                        <td>$balance->debit</td>
                        <td>$balance->credit</td>
                        <td>$balance->balance</td>
                        $description
                    </tr>
                    ";
            } ?>
        </tbody>
    </table>
</div>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 3px;
    }
</style>