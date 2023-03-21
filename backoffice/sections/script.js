const details = {
    url_page: 1,
    url: "../api/controllers/sections.php",
    method: {
        edit: "editSection(this);",
        delete: "deleteSection(this);"
    },
    table_id: "tblSections",
    current_page: 1
}

$(() => {
    paginateTable(details)
    
    $("#frmSection").on("submit", (e) => {
        e.preventDefault()

        const data = getFormData()

        if(data.action_type == "ADD") {
            submitAddSection(data)
        }
        else {
            submitEditSection(data)
        }
    })
})

function showSectionModal(type) {
    let title = ""

    if(type == "ADD") {
        clearFormData()
        title = "Add Subject Form"
    }
    else {
        title = "Edit Subject Form"
    }

    let data = {
        id: "section_modal",
        title: title
    }

    $("#section_modal_action").val(type)
    showModal(data)
}

function editSection(app) {
    const id = app.id

    GetData("../api/controllers/sections.php", "id=" + id)
    .then(response => {
        if(response.type == "success") {
            populateForm(response.content)

            $("#section_id_for_edit").val(id)
            showSectionModal("EDIT")
        }
        else {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
    })
}

function deleteSection(app) {
    const id = app.id
    
    Swal.fire({
        title: 'Are you sure you want to delete this section?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
          actions: 'my-actions',
          confirmButton: 'order-1',
          denyButton: 'order-2',
        }
      }).then((result) => {
        if (result.isConfirmed) {
        
            data = {
                type: "DELETE",
                id: id
            }
            
            DeleteData("../api/controllers/sections.php", data)
            .then(response => {
                if(response.type == "success") {
                    Swal.fire({
                        icon: response.type,
                        text: response.message,
                    })
                    paginateTable(details)
                }
                else if(response.type == "http_error") {
                    window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
                }
                else {
                    Swal.fire({
                        icon: response.type,
                        text: response.message,
                    })
                }
            })

        }
    })
}

function submitAddSection(data = {}) {
    PostData("../api/controllers/sections.php", data)
    .then(response => {
        if(response.type == "success") {
            Swal.fire({
                icon: response.type,
                text: response.message,
            })
            paginateTable(details)
        }
        else if(response.type == "http_error") {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
        else {
            Swal.fire({
                icon: response.type,
                text: response.message,
            })
        }
        clearFormData()
        closeModal()
    })
}

function submitEditSection(data = {}) {
    PutData("../api/controllers/sections.php", data)
    .then(response => {
        if(response.type == "success") {
            Swal.fire({
                icon: response.type,
                text: response.message,
            })
            paginateTable(details)
        }
        else if(response.type == "http_error") {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
        else {
            Swal.fire({
                icon: response.type,
                text: response.message,
            })
        }
        clearFormData()
        closeModal()
    })
}

function populateForm(data = {}) {
    $("#section_name").val(data.section_name)
    $("#year_level").val(data.section_year).change()
}

function getFormData() {
    return data = {
        action_type: $("#section_modal_action").val(),
        section_id: $("#section_id_for_edit").val(),
        section_name: $("#section_name").val(),
        section_year: $("#year_level").val(),
    }
}

function clearFormData() {
    $("#section_modal_action").val("")
    $("#section_id_for_edit").val("")
    $("#section_name").val("")
    $("#year_level").val("")
}