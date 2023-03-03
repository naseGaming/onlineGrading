var isProfileShown = false

function showSidebar() {
    let value = $("#btnMenu").html()

    if(value == '<i class="fa-solid fa-xmark"></i>&nbsp;&nbsp;Menu') {
        $("#btnMenu").html('<i class="fa-solid fa-bars"></i>&nbsp;&nbsp;Menu')
        $("#sidebar").hide("slide", { direction: "left" }, 500)
        $("#btnMenu").removeAttr("class")
        $("#btnMenu").attr("class", "transparent-b white-f")
    }
    else {
        $("#btnMenu").html('<i class="fa-solid fa-xmark"></i>&nbsp;&nbsp;Menu')
        $("#sidebar").show("slide", { direction: "left" }, 500)
        $("#btnMenu").removeAttr("class")
        $("#btnMenu").attr("class", "tertiary-b white-f")
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