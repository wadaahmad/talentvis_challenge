<?php
spl_autoload_register(function ($class_name) {
    include str_replace('\\', '/', $class_name) . '.php';
});

session_start();

$challenge = isset($_GET['challenge']) ? $_GET['challenge'] : 'index';
$case = isset($_GET['case']) ? $_GET['case'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

if ($challenge == 1) {
    if ($case == 'balance') {
        if ($act == 'view')
            include 'views/BalanceView.php';
        if ($act == 'deposit')
            include 'views/BalanceDeposit.php';
        if ($act == 'withdraw')
            include 'views/BalanceWithdraw.php';
    }
}

