$(() => {
    let data = "type=viewSubjects";

    GetData("../api/controllers/subjects.php", data)
    .then(response => {
        if(response.type == "success") {
            let row = "";

            for(let items in response.content) {
                row += `<tr>
                    <td>
                        ${response.content[items].description}
                    </td>
                    <td>
                        ${response.content[items].year}
                    </td>
                    <td>
                        <button id = "${response.content[items].id}" onclick = "editSubject(this);"></button><button></button>
                    </td>
                </tr>`
            }

            $("#tblSubjects").html(row)
        }
    })
})