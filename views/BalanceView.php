<?php

use controller\BalanceController;

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
        <b>Your balance</b>
        <h2><?php echo $balance->data; ?></h2>
        <div>
            <a href="?challenge=<?php echo $challenge; ?>&case=balance&act=deposit"><button>Deposit</button></a>
            <a href="?challenge=<?php echo $challenge; ?>&case=balance&act=withdraw"><button>Withdraw</button></a>
        </div>
    </div>
</body>

</html>