<?php

use controller\BalanceController;
use services\UserService;

$controller = new BalanceController;
$balance = $controller->getBalance();
$challenge = isset($_GET['challenge']) ? $_GET['challenge'] : '';

 
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div>
        <a href="/"><< Dashboard</a> &nbsp; 
        <?php
        if($challenge == 3)
            include 'UserPanel.php';
        ?>
        <hr />
        <b>Your balance</b>
        <h2><?php echo $balance->data; ?></h2>
        <div>
            <a href="?challenge=<?php echo $challenge; ?>&case=balance&act=deposit"><button>Deposit</button></a>
            <a href="?challenge=<?php echo $challenge; ?>&case=balance&act=withdraw"><button>Withdraw</button></a>
        </div>
    </div>
</body>

</html>