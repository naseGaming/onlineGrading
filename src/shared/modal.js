$(() => {
    let existing = $("body").html()

    existing += "<div class = 'loading'></div>"

    $("body").html(existing)

    $(".loading").click(() => {
        closeModal()
        hideSideBar()
    })

    $(document).on("keyup", (event) => {
        if(event.key == "Escape") {
            closeModal()
            hideSideBar()
        }
    })
})

function showModal(data = {}) {
    $("#" + data.id + " .modal-header p").html(data.title)
    $.when($(".loading").show())
    .done(() => {
        $("#" + data.id).slideDown()
    })
}

function closeModal() {
    $.when($(".modal").slideUp())
    .done(() => {
        $(".loading").hide()
    })
}