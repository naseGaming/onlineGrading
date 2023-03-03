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
        <script src = "//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src = "src/shared/fetch.js"></script>
        <script src = "src/index/script.js"></script>
    </head>
    <body>
		<div class = "loginForm" >
            <form id = "frmLogin">
                <div class = "header">
                    <h1>Welcome to St.Mark's College Grade Portal</h1>
                </div>
                <div class = "form_group">
                    <label>Username</label>
                    <div class = "input_group">
                        <input type = "text" id = "txtUsername">
                        <div class = "input_icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>
                </div>
                <div class = "form_group">
                    <label>Password</label>
                    <div class = "input_group">
                        <input type = "password" id = "txtPassword">
                        <div class = "input_icon">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                    </div>
                </div>
                <input type = "submit" value = "Login" class = "main-b white-f"/>
            </form>
		</div>
    </body>
</html>