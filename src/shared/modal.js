$(() => {
    let existing = $("body").html()

    existing += "<div class = 'loading'></div>"

    $("body").html(existing)

    $(".loading").click(() => {
        closeModal()
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
    $.when($(".loading").hide())
    .done(() => {
        $(".modal").slideUp()
    })
}