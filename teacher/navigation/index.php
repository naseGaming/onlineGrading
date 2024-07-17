<?php
$items = array(
    array(
        "name" => "Dashboard",
        "data-icon" => "fa-solid fa-house",
        "link" => "./?dashboard"
    ),
    array(
        "name" => "Submit Grades",
        "data-icon" => "fa-solid fa-book",
        "link" => "./?submit_grades"
    ),
    array(
        "name" => "Settings",
        "data-icon" => "fa-solid fa-gear",
        "link" => "./?settings"
    ),
);
?>
    <button id = "btnMenuSide" class = "sidebar_items transparent-b black-f" onclick = "hideSideBar();" style = "height:70px; font-size: 1.2em;">
        <i class="fa-solid fa-xmark"></i>&nbsp;&nbsp;Menu
    </button>
<?php
    foreach($items as $item) {
?>
        <button class = "sidebar_items transparent-b black-f" onclick = "navigate('<?php echo $item['link']; ?>');">
            <i class = "<?php echo $item['data-icon']; ?>"></i> <?php echo $item['name']; ?>
        </button>
<?php
    }
?>