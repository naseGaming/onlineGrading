<?php

$items = array(
    array(
        "name" => "Dashboard",
        "data-icon" => "fa-solid fa-house",
        "link" => "./?dashboard"
    ),
    array(
        "name" => "View Grades",
        "data-icon" => "fa-solid fa-book",
        "link" => "./?grades"
    ),
    array(
        "name" => "Settings",
        "data-icon" => "fa-solid fa-gear",
        "link" => "./?settings"
    ),
);
?>
    <?php
    foreach($items as $item) {
    ?>
        <button class = "sidebar_items transparent-b white-f" onclick = "navigate('<?php echo $item['link']; ?>');">
            <i class = "<?php echo $item['data-icon']; ?>"></i> <?php echo $item['name']; ?>
        </button>
    <?php
    }
    ?>