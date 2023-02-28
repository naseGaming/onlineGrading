<?php
    require_once("api/session.php");
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="design/colors.css" />
        <link rel="stylesheet" type="text/css" href="design/index.css" />
        <script src="https://kit.fontawesome.com/8b6b1fa9e8.js" crossorigin="anonymous"></script>
        <script src = "src/jquery/jquery-3.1.1.min.js"></script>
        <script src = "src/jquery/jquery-ui.min.js"></script>
        <script src = "src/notification-too/notification-too.js"></script>
        <script src = "//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src = "src/shared/fetch.js"></script>
        <script src = "src/index/script.js"></script>
    </head>
    <body>
		<div class = "loginForm main-b" >
            <form id = "frmLogin">
                <h1 class = "white-f">Login</h1>
                <input type = "text" id = "txtUsername" placeholder = "Username" />
                <input type = "password" id = "txtPassword" placeholder = "Password"/>
                <input type = "submit" value = "Login" class = "tertiary-b white-f"/>
            </form>
		</div>
    </body>
</html>