$(() => {
    getGrades()
})

function getGrades() {
    let row = ""

    GetData("../api/controllers/grades.php")
    .then(response => {
        if(response.type == "success") {
            for(let items in response.content) {
                row += `<tr>`
                Object.keys(response.content[items]).forEach(function(key) {
                    var value = response.content[items][key];
    
                    if(key != "description") {
                        if(value > 79) {
                            row += `
                            <td class = "high_pass">
                                ${value}
                            </td>`
                        }
                        else if(value < 80 && value > 74) {
                            row += `
                            <td class = "passing">
                                ${value}
                            </td>`
                        }
                        else if(value == "N/A") {
                            row += `
                            <td>
                                ${value}
                            </td>`
                        }
                        else {
                            row += `
                            <td class = "failed">
                                ${value}
                            </td>`
                        }
                    }
                    else {
                        row += `
                        <td>
                            ${value}
                        </td>`
                    }
                });
                row += `</tr>`
            }

            $("#tblGrades tbody").html(row)
        }
        else if(response.type == "empty") {
            row += `
            <tr>
                <td colspan = "6">
                    You have no subjects this year
                </td>
            </tr>`

            $("#tblGrades tbody").html(row)
        }
        else {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
    })
}

function getGradeByYear(app) {
    let year = app.value
    let row = ""

    if(year == "" || year == null) {
        getGrades()
        return
    }

    GetData("../api/controllers/grades.php", "year=" + year)
    .then(response => {
        if(response.type == "success") {
            for(let items in response.content) {
                row += `<tr>`
                Object.keys(response.content[items]).forEach(function(key) {
                    var value = response.content[items][key];
    
                    if(key != "description") {
                        if(value > 79) {
                            row += `
                            <td class = "high_pass">
                                ${value}
                            </td>`
                        }
                        else if(value < 80 && value > 74) {
                            row += `
                            <td class = "passing">
                                ${value}
                            </td>`
                        }
                        else if(value == "N/A") {
                            row += `
                            <td>
                                ${value}
                            </td>`
                        }
                        else {
                            row += `
                            <td class = "failed">
                                ${value}
                            </td>`
                        }
                    }
                    else {
                        row += `
                        <td>
                            ${value}
                        </td>`
                    }
                });
                row += `</tr>`
            }

            $("#tblGrades tbody").html(row)
        }
        else if(response.type == "empty") {
            row += `
            <tr>
                <td colspan = "6">
                    You have no subjects this year
                </td>
            </tr>`

            $("#tblGrades tbody").html(row)
        }
        else {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
    })
}