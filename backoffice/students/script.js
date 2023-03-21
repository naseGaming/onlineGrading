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

function showSubjectModal(type) {
    let title = ""

    if(type == "ADD") {
        clearFormData()
        title = "Add Student Form"
    }
    else {
        title = "Edit Student Form"
    }

    let data = {
        id: "student_modal",
        title: title
    }

    $("#student_modal_action").val(type)
    showModal(data)
}

function LoadSectionPerYear(app) {
    $("#student_section").html("")

    if(app.value != "") {
        GetData("../api/controllers/sections.php", "year=" + app.value)
        .then(response => {
            if(response.type == "success") {
                let row = `<option value = "">~Please Select a Section~</option>`
    
                for(let items in response.content) {
                    row += `<option value = "${response.content[items].id}">${response.content[items].section}</option>`
                }
    
                $("#student_section").html(row)
                $("#student_section").attr("disabled", false)
            }
            else {
                window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
            }
        })
    }
    else {
        $("#student_section").html(`<option value = "">~Please Select a Section~</option>`)
        $("#student_section").attr("disabled", true)
    }
}

function populateForm(data = {}) {
    $("#student_number").val(data.student_number)
    $("#first_name").val(data.first_name)
    $("#middle_name").val(data.middle_name)
    $("#last_name").val(data.last_name)
    $("#student_year_level").val(data.year).change()
    $("#student_section").val(data.student_section).change()
}

function getFormData() {
    const data = {
        action_type: $("#student_modal_action").val(),
        student_id: $("#student_id_for_edit").val(),
        student_number: $("#student_number").val(),
        first_name: $("#first_name").val(),
        middle_name: $("#middle_name").val(),
        last_name: $("#last_name").val(),
        student_year_level: $("#student_year_level").val(),
        student_section: $("#student_section").val()
    }

    data.first_name = data.first_name.charAt(0).toUpperCase() + data.first_name.slice(1)
    data.middle_name = data.middle_name.charAt(0).toUpperCase() + data.middle_name.slice(1)
    data.last_name = data.last_name.charAt(0).toUpperCase() + data.last_name.slice(1)

    return data;
}

function clearFormData() {
    $("#student_modal_action").val("")
    $("#student_id_for_edit").val("")
    $("#student_number").val("")
    $("#first_name").val("")
    $("#middle_name").val("")
    $("#last_name").val("")
    $("#student_year_level").val("")
    $("#student_section").val("")
}