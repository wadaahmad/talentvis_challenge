<?php

use controller\UserController;
use helper\RouterHelper;
use services\UserService;

$controller = new UserController;

if (isset($_POST['logout'])) {
    $controller->logout();
    RouterHelper::redirect('?challenge=3&case=user&act=login');
}

?>
<?php if (UserService::isAuth()) { ?>
    <hr/>
    <form action="" method="POST">
        <span> <?php echo UserService::authUser()->name ?> </span>
        <button name="logout" type="submit"> Logout</button>
    </form>
<?php } ?>