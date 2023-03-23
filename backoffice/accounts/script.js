const details = {
    url_page: 1,
    url: "../api/controllers/accounts.php",
    method: {
        edit: "editAccount(this);",
        delete: "deleteAccount(this);"
    },
    table_id: "tblAccounts",
    current_page: 1
}

$(() => {
    paginateTable(details)
    LoadSection()

    $("#frmBatchAccounts").on("submit", (e) => {
        e.preventDefault()

        let radio = $('input[name=action]:checked', '#frmBatchAccounts').val()

        let group_type = $("#group_type").val()
        let group_content = ""

        if(group_type == "2") {
            group_content = $("#user_type").val()
        }
        if(group_type == "3") {
            group_content = $("#year").val()
        }
        if(group_type == "4") {
            group_content = $("#section").val()
        }

        const data = {
            action_type: "batch",
            group_type: group_type,
            group_content: group_content == "" ? null : group_content
        }

        if(radio == "add") {
            PostData("../api/controllers/accounts.php", data)
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
                resetComboBox()
                closeModal()
            })
        }
    })
})

function showBatchModal() {
    resetComboBox()
    $("#group_type").val("")

    const data = {
        id: "account_batch_modal",
        title: "Batch Action Form"
    }

    showModal(data)
}

function LoadSection() {
    GetData("../api/controllers/sections.php")
    .then(response => {
        if(response.type == "success") {
            let row = `<option value = "">~Please Select a Section~</option>`

            for(let items in response.content) {
                row += `<option value = "${response.content[items].id}">${response.content[items].year} ${response.content[items].section}</option>`
            }

            $("#section").html(row)
        }
        else {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
    })
}

function groupTypeComboBox(app) {
    let data = app.value

    resetComboBox()

    switch(data) {
        case "2": {
            $("#user_type").attr("disabled", false)
            $("#user_type").attr("required", true)
            break;
        }
        case "3": {
            $("#year").attr("disabled", false)
            $("#year").attr("required", true)
            break;
        }
        case "4": {
            $("#section").attr("disabled", false)
            $("#section").attr("required", true)
            break;
        }
        default: {
            break;
        }
    }
}

function resetComboBox() {
    $("#user_type").attr("disabled", true)
    $("#year").attr("disabled", true)
    $("#section").attr("disabled", true)
    $("#user_type").attr("required", false)
    $("#year").attr("required", false)
    $("#section").attr("required", false)
}