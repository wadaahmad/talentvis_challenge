<?php

use controller\BalanceController;
use helper\Request;
use helper\RouterHelper;
use services\UserService;

$controller = new BalanceController;
$balance = $controller->getBalance(UserService::authUserId());
$challenge = Request::get('challenge');
$error = Request::get('err');

if (Request::post('credit')) {
    $execute = $controller->withdraw(Request::post('credit'), UserService::authUserId());
    if ($execute->code == 400) {
        return RouterHelper::redirect("?challenge=$challenge&case=balance&act=withdraw&err=$execute->data");
    }
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
        <div>Withdraw </div>
        <form action="" method="POST">
            <input type="number" name="credit" required/>
            <button type="submit">save</button>
            <div style="color:red;">
                <?php echo $error; ?>
            </div>
        </form>
    </div>
</body>

</html>