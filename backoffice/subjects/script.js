const details = {
    url_page: 1,
    url: "../api/controllers/subjects.php",
    method: {
        edit: "editSubject(this);",
        delete: "deleteSubject(this);"
    },
    table_id: "tblSubjects",
    current_page: 1
}

$(() => {
    paginateTable(details)
    loadTeacherComboBox()
    
    $("#frmSubject").on("submit", (e) => {
        e.preventDefault()

        const data = getFormData()

        if(data.action_type == "ADD") {
            submitAddSubject(data)
        }
        else {
            submitEditSubject(data)
        }
    })
})

function showSubjectModal(type) {
    let title = ""

    if(type == "ADD") {
        clearFormData()
        title = "Add Subject Form"
    }
    else {
        title = "Edit Subject Form"
    }

    let data = {
        id: "subject_modal",
        title: title
    }

    $("#subject_modal_action").val(type)
    showModal(data)
}

function loadTeacherComboBox() {
    GetData("../api/controllers/teachers.php", "")
    .then(response => {
        if(response.type == "success") {
            let row = `<option value = "">~Please Select a Teacher~</option>`

            for(let items in response.content) {
                row += `<option value = "${response.content[items].username}">${response.content[items].first_name} ${response.content[items].middle_name} ${response.content[items].last_name}</option>`
            }

            $("#subject_teacher").html(row)
        }
        else {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
    })
}

function editSubject(app) {
    const id = app.id

    GetData("../api/controllers/subjects.php", "id=" + id)
    .then(response => {
        if(response.type == "success") {
            populateForm(response.content)

            $("#subject_id_for_edit").val(id)
            showSubjectModal("EDIT")
        }
        else {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
    })
}

function deleteSubject(app) {
    const id = app.id
    
    Swal.fire({
        title: 'Are you sure you want to delete this subject?',
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
            
            DeleteData("../api/controllers/subjects.php", data)
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

function submitAddSubject(data = {}) {
    PostData("../api/controllers/subjects.php", data)
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

function submitEditSubject(data = {}) {
    PutData("../api/controllers/subjects.php", data)
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
    $("#subject_code").val(data.code)
    $("#subject_description").val(data.description)
    $("#subject_year").val(data.year).change()
    $("#subject_teacher").val(data.teacher).change()
}

function getFormData() {
    const data = {
        action_type: $("#subject_modal_action").val(),
        subject_id: $("#subject_id_for_edit").val(),
        subject_code: $("#subject_code").val(),
        subject_description: $("#subject_description").val(),
        subject_year: $("#subject_year").val(),
        subject_teacher: $("#subject_teacher").val()
    }

    return data;
}

function clearFormData() {
    $("#subject_modal_action").val("")
    $("#subject_id_for_edit").val("")
    $("#subject_code").val("")
    $("#subject_description").val("")
    $("#subject_year").val("")
    $("#subject_teacher").val("")
}