$(() => {
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

    paginateTable(details)
    loadTeacherComboBox()
})

function showSubjectModal(type) {
    let title = ""

    if(type == "add") {
        title = "Add Subject Form"
    }
    else if(type == "edit") {
        title = "Edit Subject Form"
    }
    else {
        title = "Delete Subject Form"
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
            let row = `<option value = "0">~Please Select a Teacher~</option>`

            for(let items in response.content) {
                row += `<option value = "${response.content[items].username}">${response.content[items].first_name} ${response.content[items].middle_name} ${response.content[items].last_name}</option>`
            }

            $("#subject_teacher").html(row)
        }
        else {
            window.location.href = "./?error_pages&code=" + response.code + "&message=" + response.message;
        }
    })
}

function editSubject(app) {
    const id = app.id

    GetData("../api/controllers/subjects.php", "id=" + id)
    .then(response => {
        if(response.type == "success") {
            response.content

            showSubjectModal("edit")
        }
        else {
            window.location.href = "./?error_pages&code=" + response.code + "&message=" + response.message;
        }
    })
}

function deleteSubject(app) {
    const id = app.id

    GetData("../api/controllers/subjects.php", "id=" + id)
    .then(response => {
        if(response.type == "success") {
            response.content

            showSubjectModal("delete")
        }
        else {
            window.location.href = "./?error_pages&code=" + response.code + "&message=" + response.message;
        }
    })
}

function populateForm(data = {}) {
    $("#subject_code").val(data.code)
    $("#subject_description").val(data.description)
    $("#subject_year").val(data.year).change()
    $("#subject_teacher").val(data.teacher).change()

    console.log($("#subject_teacher").val())
}