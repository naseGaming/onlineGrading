<?php
    require_once("../api/session.php");

    $key = array_keys($_GET);
    //$contents = json_decode(file_get_contents("contents.json"), true);
?>

<!DOCTYPE html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../design/colors.css" />
        <link rel="stylesheet" type="text/css" href="../design/error_pages.css" />
        <link rel="stylesheet" type="text/css" href="../design/template.css" />
        <link rel="stylesheet" type="text/css" href="../design/backoffice.css" />
        <script src="https://kit.fontawesome.com/8b6b1fa9e8.js" crossorigin="anonymous"></script>
        <script src = "../src/jquery/jquery-3.1.1.min.js"></script>
        <script src = "../src/jquery/jquery-ui.min.js"></script>
        <script src = "../src/shared/fetch.js"></script>
        <script src = "../src/shared/pagination.js"></script>
        <script src = "../src/shared/modal.js"></script>
        <script src = "../src/backoffice/script.js"></script>
        <script src = "navigation/script.js"></script>
        <?php
            if(count($key) == 0 ) {
                echo "<script>window.location.href = './?dashboard'</script>";
            }
            else {
                echo "<script src='$key[0]/script.js'></script>";
            }
        ?>
    </head>
    <body>
        <div class = "navbar main-b white-f">
        <button id = "btnMenu" class = "transparent-b white-f" onclick = "showSidebar();">
            <i class="fa-solid fa-bars"></i>&nbsp;&nbsp;Menu
        </button>
        <button id = "btnProfile" class = "menu-name transparent-b white-f" onclick = "showProfile();">
            <?php
                echo "Hi, " . $_SESSION["userName"] . "&nbsp;&nbsp;&nbsp;<i class='fa-solid fa-caret-down'></i>";
            ?>
        </button>
        </div>
		<div class = "sidebar tertiary-b white-f" id = "sidebar" >
            <?php include "navigation/index.php"; ?>
		</div>
        <div class = "profile_bar tertiary-b white-f" id = "profile_bar" >
            <button class = "tertiary-b white-f" onclick = "logout();">Logout <i class="fa-solid fa-power-off"></i></button>
        </div>
        <div class = "content">
        <?php
            if(count($key) == 0 ) {
                include "dashboard/index.html";
            }
            else {
                $content = $key[0]."/index.html";

                if(!file_exists($content)){
                    echo "<script>window.location.href = './?error_pages&code=404&message=Not%20Found'</script>";
                    return;
                }

                require($content);
            }
        ?>
        </div>
        <footer>
            2023 &copy; Grading Portal by Roland Christian Regacho
        </footer>
    </body>
</html>