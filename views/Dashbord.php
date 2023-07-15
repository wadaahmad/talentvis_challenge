<?php

use helper\Request;
use services\UserService;

// Auto logout when go to dashboard
UserService::logout();
if (Request::post('reset'))
    session_destroy();
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div style="max-width: 300px; text-align:center;">
        <h3>DASHBOARD</h3>
        
        <div>
            <a href="?challenge=1&case=balance&act=view">
                <button>Challenge 1</button>
            </a>
            <a href="?challenge=2&case=balance&act=view">
                <button>Challenge 2</button>
            </a>
            <a href="?challenge=3&case=user&act=login">
                <button>Challenge 2</button>
            </a>
        </div>
        <div style="background-color: #f2c0c0; padding:10px; margin-top:20px;">
            <form method="POST" action="">
                Clear data, all transaction data will remove <button name="reset" value="reset" type="submit">Reset Data now</button>
            </form>
        </div>
    </div>
</body>

</html>