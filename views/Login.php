<?php

use controller\UserController;
use helper\RouterHelper;
use services\UserService;

$controller = new UserController;
$challenge = isset($_GET['challenge']) ? $_GET['challenge'] : '';
$error = isset($_GET['err']) ? $_GET['err'] : '';

if ($_POST['username'] && $_POST['password']) {
    $execute = $controller->login($_POST['username'], $_POST['password']);
    if ($execute->code == 401) {
        RouterHelper::redirect("?challenge=$challenge&case=user&act=login&err=$execute->data");
    };
}
if (UserService::isAuth())
    RouterHelper::redirect("?challenge=$challenge&case=balance&act=view")

?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div style="max-width: 280px;">
        <a href="/">
            << Dashboard </a>
                <hr />
                <div style="text-align: center; margin-bottom:10px;">Login </div>
                <form action="" method="POST">
                    <div style="display: flex; justify-content:space-between;">
                        Username
                        <input name="username" required />
                    </div>
                    <div style="display: flex; justify-content:space-between;">
                        Password
                        <input type="password" name="password" required />
                    </div>
                    <div style="text-align:center; margin-top:15px;">
                        <button type="submit" style="width: 80%;">Log me in</button>
                    </div>
                    <div style="color:red;">
                        <?php echo $error; ?>
                    </div>
                </form>
    </div>
</body>

</html>