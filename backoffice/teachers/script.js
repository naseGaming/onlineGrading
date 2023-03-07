const details = {
    url_page: 1,
    url: "../api/controllers/teachers.php",
    method: {
        edit: "editTeacher(this);",
        delete: "deleteTeacher(this);"
    },
    table_id: "tblTeachers",
    current_page: 1
}

$(() => {
    paginateTable(details)
})