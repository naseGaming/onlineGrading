$(() => {
    let data = "type=viewSubjects";

    GetData("../api/controllers/subjects.php", data)
    .then(response => {
        if(response.type == "success") {
            let row = "";

            for(let items in response.content) {
                row += `<tr>
                    <td>
                        ${response.content[items].code}
                    </td>
                    <td>
                        ${response.content[items].description}
                    </td>
                    <td>
                        ${response.content[items].year}
                    </td>
                    <td>
                        ${response.content[items].teacher}
                    </td>
                    <td>
                        <button id = "${response.content[items].id}" class = "table_button blue-b white-f onclick = "editSubject(this);">
                            Edit
                        </button>
                        <button id = "${response.content[items].id}" class = "table_button red-b white-f onclick = "deleteSubject(this);">
                            Delete
                        </button>
                    </td>
                </tr>`
            }

            $("#tblSubjects").html(row)
        }
    })
})