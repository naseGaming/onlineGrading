$(() => {
    const details = {
        url_string: "type=viewSubjects",
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

    showModal(data)
}