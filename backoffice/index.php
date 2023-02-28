<?php
    require_once("../api/session.php");

    $contents = json_decode(file_get_contents("contents.json"), true);
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../design/colors.css" />
        <link rel="stylesheet" type="text/css" href="../design/backoffice.css" />
        <script src="https://kit.fontawesome.com/8b6b1fa9e8.js" crossorigin="anonymous"></script>
        <script src = "../src/jquery/jquery-3.1.1.min.js"></script>
        <script src = "../src/jquery/jquery-ui.min.js"></script>
        <script src = "../src/shared/fetch.js"></script>
        <script src = "../src/backoffice/script.js"></script>

        <?php
            foreach($contents as $content){
                echo "<script src='{$content['script']}'></script>";
            }
        ?>
    </head>
    <body>
    <div class = "navbar main-b white-f">
      <button id = "btnMenu" class = "transparent-b white-f" onclick = "showSidebar();">
        <i class="fa-solid fa-bars"></i> Menu
      </button>
      <button id = "btnProfile" class = "menu-name transparent-b white-f" onclick = "showProfile();">
        <?php
          echo "Hi, " . $_SESSION["userName"];
        ?>
      </button>
    </div>
		<div class = "sidebar tertiary-b white-f" id = "sidebar" >
        <?php include $contents["navigation"]["path"] ?>
		</div>
    <div class = "content">
      <?php
        $key = array_keys($_GET);

        include $contents[$key[0]]["path"]
      ?>
    </div>
    </body>
</html>