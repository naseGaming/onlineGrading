

function showSidebar() {
    let value = $("#btnMenu").html()

    if(value == '<i class="fa-solid fa-xmark"></i> Menu') {
        $("#btnMenu").html('<i class="fa-solid fa-bars"></i> Menu')
        $("#sidebar").hide("slide", { direction: "left" }, 500)
    }
    else {
        $("#btnMenu").html('<i class="fa-solid fa-xmark"></i> Menu')
        $("#sidebar").show("slide", { direction: "left" }, 500)
    }
}