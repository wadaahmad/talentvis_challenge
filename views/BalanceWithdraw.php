<?php

use controller\BalanceController;
use helper\RouterHelper;

$controller = new BalanceController;
$balance = $controller->getBalance();
$challenge = isset($_GET['challenge']) ? $_GET['challenge'] : '';
$error = isset($_GET['err']) ? $_GET['err'] : '';

if ($_POST['credit']) {
    $execute = $controller->withdraw($_POST['credit']);
    if ($execute->code == 400) {
        RouterHelper::redirect("?challenge=$challenge&case=balance&act=withdraw&err=$execute->data");
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
            <input name="credit" />
            <button type="submit">save</button>
            <div style="color:red;">
                <?php echo $error; ?>
            </div>
        </form>
    </div>
</body>

</html>