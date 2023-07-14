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
        else if ($act == 'deposit')
            include 'views/BalanceDeposit.php';
        else if ($act == 'withdraw')
            include 'views/BalanceWithdraw.php';
    }
} else if ($challenge == 2) {
    if ($case == 'balance') {
        if ($act == 'view') {
            include 'views/BalanceView.php';
            include 'views/BalanceHistory.php';
        } else if ($act == 'deposit')
            include 'views/BalanceDeposit.php';
        else if ($act == 'withdraw')
            include 'views/BalanceWithdraw.php';
    }
} else if ($challenge == 3) {
    if ($case == 'user') {
        if ($act == 'login')
            include 'views/Login.php';
    }
    if ($case == 'balance') {
        if ($act == 'view') {
            include 'views/BalanceView.php';
            include 'views/BalanceHistory.php';
        } else if ($act == 'deposit')
            include 'views/BalanceDeposit.php';
        else if ($act == 'withdraw')
            include 'views/BalanceWithdraw.php';
    }
} else
    include "views/Dashbord.php";
