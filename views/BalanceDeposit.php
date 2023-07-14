<?php

use controller\BalanceController;
use helper\RouterHelper;

$controller = new BalanceController;
$balance = $controller->getBalance();
$challenge = isset($_GET['challenge']) ? $_GET['challenge'] : '';

if ($_POST['debit']) {
    $controller->deposit($_POST['debit']);
    RouterHelper::redirect("?challenge=$challenge&case=balance&act=view");
}

?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div>
        <a href="?challenge=<?php echo $challenge; ?>&case=balance&act=view">
            <button>
                << Back</button>
        </a>
        <div>Deposit </div>
        <form action="" method="POST">
            <input name="debit" />
            <button type="submit">save</button>
        </form>
    </div>
</body>

</html>