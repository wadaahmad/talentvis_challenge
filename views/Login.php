<?php

use controller\UserController;
use helper\Request;
use helper\RouterHelper;
use services\UserService;

$controller = new UserController;
$challenge = Request::get('challenge');
$error = Request::get('err');

// show user for testing purpose
$users = $controller->get();

if (Request::post('username') && Request::post('password')) {
    $execute = $controller->login(Request::post('username'), Request::post('password'));
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
                <div style="background-color: #c4e9f4; padding:10px;">
                    <div style="margin-bottom: 10px;">Expose Users For testing purpose</div>
                    <?php
                    foreach ($users->data as $user) {
                        echo "$user->name<br/>
                        username: $user->username<br/>
                        password: $user->password<br/>
                        ";
                    }
                    ?>
                </div>
    </div>
</body>

</html>