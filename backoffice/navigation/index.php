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
    ),
    array(
        "name" => "Sections",
        "data-icon" => "fa-solid fa-people-group",
        "link" => "./?sections"
    ),
    array(
        "name" => "Accounts",
        "data-icon" => "fa-solid fa-user",
        "link" => "./?accounts"
    )
);
?>
    <button id = "btnMenuSide" class = "sidebar_items transparent-b white-f" onclick = "hideSideBar();" style = "height:70px; font-size: 1.2em;">
        <i class="fa-solid fa-xmark"></i>&nbsp;&nbsp;Menu
    </button>
    <?php
        foreach($items as $item) {
    ?>
        <button class = "sidebar_items transparent-b white-f" onclick = "navigate('<?php echo $item['link']; ?>');">
            <i class = "<?php echo $item['data-icon']; ?>"></i> <?php echo $item['name']; ?>
        </button>
    <?php
        }
    ?>