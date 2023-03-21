var isProfileShown = false

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