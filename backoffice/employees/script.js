const details = {
    url_page: 1,
    url: "../api/controllers/employees.php",
    method: {
        edit: "editEmployee(this);",
        delete: "deleteEmployee(this);"
    },
    table_id: "tblEmployees",
    current_page: 1
}

$(() => {
    paginateTable(details)
    
    /*
    $("#frmTeacher").on("submit", (e) => {
        e.preventDefault()

        const data = getFormData()

        if(data.action_type == "ADD") {
            submitAddTeacher(data)
        }
        else {
            submitEditTeacher(data)
        }
    })
    */
})


function showEmployeeModal(type) {
    let title = ""

    if(type == "ADD") {
        clearFormData()
        title = "Add Employee Form"
    }
    else {
        title = "Edit Employee Form"
    }

    let data = {
        id: "employee_modal",
        title: title
    }

    $("#employee_modal_action").val(type)
    showModal(data)
}

function editEmployee(app) {
    const id = app.id

    GetData("../api/controllers/employees.php", "id=" + id)
    .then(response => {
        if(response.type == "success") {
            populateForm(response.content)

            $("#teacher_id_for_edit").val(id)
            showTeacherModal("EDIT")
        }
        else {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
    })
}

function deleteEmployee(app) {
    const id = app.id
    
    Swal.fire({
        title: 'Are you sure you want to delete this teacher?',
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
            
            DeleteData("../api/controllers/employees.php", data)
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

function submitAddTeacher(data = {}) {
    PostData("../api/controllers/employees.php", data)
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

function submitEditTeacher(data = {}) {
    PutData("../api/controllers/employees.php", data)
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
    $("#first_name").val(data.first_name)
    $("#middle_name").val(data.middle_name)
    $("#last_name").val(data.last_name)
}

function getFormData() {
    const data = {
        action_type: $("#teacher_modal_action").val(),
        teacher_id: $("#teacher_id_for_edit").val(),
        first_name: $("#first_name").val(),
        middle_name: $("#middle_name").val(),
        last_name: $("#last_name").val()
    }

    data.first_name = data.first_name.charAt(0).toUpperCase() + data.first_name.slice(1)
    data.middle_name = data.middle_name.charAt(0).toUpperCase() + data.middle_name.slice(1)
    data.last_name = data.last_name.charAt(0).toUpperCase() + data.last_name.slice(1)

    return data;
}

function clearFormData() {
    $("#teacher_modal_action").val("")
    $("#teacher_id_for_edit").val("")
    $("#first_name").val("")
    $("#middle_name").val("")
    $("#last_name").val("")
}
