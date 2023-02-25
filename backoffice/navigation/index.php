<?php

$items = array(
    array(
        "name" => "Dashboard",
        "data-icon" => "fa-solid fa-house",
        "link" => "./?dashboard"
    ),
    array(
        "name" => "Subjects",
        "data-icon" => "fa-solid fa-book",
        "link" => "./?subjects"
    ),
    array(
        "name" => "Students",
        "data-icon" => "fa-solid fa-graduation-cap",
        "link" => "./?students"
    ),
    array(
        "name" => "Teachers",
        "data-icon" => "fa-solid fa-chalkboard-user",
        "link" => "./?teachers"
    )
);
?>
<html>
    <?php
    foreach($items as $item) {
    ?>
        <button class = "sidebar_items transparent-b white-f" onclick = "navigate('<?php echo $item['link']; ?>');">
            <i class = "<?php echo $item['data-icon']; ?>"></i> <?php echo $item['name']; ?>
        </button>
    <?php
    }
    ?>
</html>