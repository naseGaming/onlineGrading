const details = {
    url_page: 1,
    url: "../api/controllers/grades.php",
    table_id: "tblViewGrades",
    current_page: 1
}

$(() => {
    details.additional_information = window.location.search.split("&")[1]
    paginateTable(details)

    GetData(`../api/controllers/subjects.php?${details.additional_information}`)
    .then(response => {
        let render = "<option value=0>All</option>"

        for(items in response.content) {
            render += `<option value="${response.content[items].code}">${response.content[items].description}</option>`
        }

        $("#slct_subject").html(render)
    })
})

function filterBySubject(app) {
    if(app.value > 0) {
        details.additional_information = window.location.search.split("&")[1] + "&subject=" + app.value
    }
    else {
        details.additional_information = window.location.search.split("&")[1]
    }
    paginateTable(details)
}