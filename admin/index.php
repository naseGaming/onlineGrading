<?php
    $contents = json_decode(file_get_contents("contents.json"), true);
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../design/colors.css" />
        <link rel="stylesheet" type="text/css" href="../design/admin.css" />
        <script src="https://kit.fontawesome.com/8b6b1fa9e8.js" crossorigin="anonymous"></script>
        <script src = "../src/jquery/jquery-3.1.1.min.js"></script>
        <script src = "../src/jquery/jquery-ui.min.js"></script>
        <script src = "../src/notification-too/notification-too.js"></script>
        <script src = "../src/shared/fetch.js"></script>
        <script src = "../src/index/script.js"></script>

        <?php
            foreach($contents as $content){
                echo "<script src='{$content['script']}'></script>";
            }
        ?>
    </head>
    <body>
		<div class = "navigation tertiary-b white-f" >
        <?php include $contents["navigation"]["path"] ?>
		</div>
    <div>
      <?php
        $key = array_keys($_GET);

        include $contents[$key[0]]["path"]
      ?>
    </div>
    </body>
</html>