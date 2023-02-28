var isProfileShown = false

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

function showProfile() {

    if(isProfileShown) {
        $("#profile_bar").slideUp();
        isProfileShown = false
    }
    else {
        $("#profile_bar").slideDown();
        isProfileShown = true
    }
}

function logout() {
    window.location.href = "../api/logout.php";
}