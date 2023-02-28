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