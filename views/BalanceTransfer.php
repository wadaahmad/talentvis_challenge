<?php

use controller\BalanceController;
use controller\UserController;
use helper\Request;
use helper\RouterHelper;
use services\UserService;

$controller = new BalanceController;
$balance = $controller->getBalance(UserService::authUserId());
$challenge = Request::get('challenge');
$error = Request::get('err');

$userController = new UserController;
$users = $userController->getOtherUser(UserService::authUserId());

if (Request::post('to') && Request::post('amount')) {
    $execute = $controller->Transfer(Request::post('amount'), UserService::authUserId(), Request::post('to'));
    if ($execute->code == 400) {
        RouterHelper::redirect("?challenge=$challenge&case=balance&act=transfer&err=$execute->data");
    }
    RouterHelper::redirect("?challenge=$challenge&case=balance&act=view");
}

?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div style="max-width: 250px;">
        <a href="?challenge=<?php echo $challenge; ?>&case=balance&act=view">
            <span>
                << Back</span>
        </a>
        <hr />
        <div>Transfer </div>
        <form action="" method="POST">
            <div style="display: flex; justify-content:space-between;">
                To
                <select name="to" required>
                    <option>Select recipient</option>
                    <?php
                    foreach ($users->data as $user) {
                        echo "<option value='$user->id'>$user->name</option>";
                    }
                    ?>
                </select>
            </div>
            <div style="display: flex; justify-content:space-between;">
                Amount
                <input type="number" name="amount" required />
            </div>
            <button type="submit">save</button>
            <div style="color:red;">
                <?php echo $error; ?>
            </div>
        </form>
    </div>
</body>

</html>