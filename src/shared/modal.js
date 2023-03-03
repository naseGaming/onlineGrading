function showModal(data = {}) {
    $("#" + data.id + " .modal-header p").html(data.title)
    $("#" + data.id).show()
}

function closeModal() {
    $(".modal").hide()
}