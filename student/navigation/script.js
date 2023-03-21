function navigate(link) {
    window.location.href = link
}

function showSidebar() {
    $("#btnMenu").hide()
    $.when($(".loading").show())
    .done(() => {
        $("#sidebar").show("slide", { direction: "left" }, 500)
    })
}

function hideSideBar() {
    $("#btnMenu").show()
    $.when($(".loading").hide())
    .done(() => {
        $("#sidebar").hide("slide", { direction: "left" }, 500)
    })
}