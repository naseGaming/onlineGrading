const details = {
    url_page: 1,
    url: "../api/controllers/students.php",
    method: {
        edit: "editStudent(this);",
        delete: "deleteStudent(this);"
    },
    table_id: "tblStudents",
    current_page: 1
}

$(() => {
    paginateTable(details)
})

function exportTemplate() {
    window.open("../api/export/?type=students");
}