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
})

function showSubjectModal(type) {
    let title = ""

    if(type == "add") {
        title = "Add Subject Form"

        $("#subject_modal_action").val("add")
    }

    let data = {
        id: "subject_modal",
        title: title
    }

    loadTeacherComboBox()
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