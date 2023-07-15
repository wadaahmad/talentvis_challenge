<?php

use controller\BalanceController;
use helper\Request;
use helper\RouterHelper;
use services\UserService;

$controller = new BalanceController;
$balance = $controller->getBalance(UserService::authUserId());
$challenge = Request::get('challenge');

if (Request::post('debit')) {
    $controller->deposit(Request::post('debit'), UserService::authUserId());
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
            <span>
                << Back</span>
        </a>
        <hr />
        <div>Deposit </div>
        <form action="" method="POST">
            <input type="number" name="debit" required />
            <button type="submit">save</button>
        </form>
    </div>
</body>

</html>