const MAX_PAGE_COUNT = 10

async function paginateTable(data = {}) {
    var row = "";
    GetData(data.url, "page=" + data.url_page)
    .then(response => {
        if(response.type == "success") {
            let id = "";
            for(let items in response.content) {
                row += `<tr>`

                Object.keys(response.content[items]).forEach(function(key) {
                    var value = response.content[items][key];

                    if(key == "id") {
                        id = value
                    }
                    else {
                        row += `
                        <td>
                            ${value}
                        </td>`
                    }
                });

                if(data.method != "") {
                    row += `
                        <td>
                            <button id = "${id}" class = "table_button green-b white-f" onclick = "${data.method.edit}")">
                                Edit
                            </button>
                            <button id = "${id}" class = "table_button red-b white-f" onclick = "${data.method.delete}">
                                Delete
                            </button>
                        </td>
                    </tr>`
                }
                else {
                    row += `</tr>`
                }
            }

            $("#" + data.table_id + " tbody").html(row)
            renderPageButtons(response.length, data.table_id, data.current_page, data)
        }
        else if(response.type == "empty") {
            row += `
            <tr>
                <td colspan = ${response.length} style = "text-align: center;">
                    ${response.message}
                </td>
            </tr>`

            $("#" + data.table_id + " tbody").html(row)
        }
        else {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
    })
}

function nextPage(page, data) {
    let details = data

    details.url_page = page
    details.current_page = page

    paginateTable(details)
}

function renderPageButtons(length, page_id, current_page, data = {}) {
    if(length > MAX_PAGE_COUNT) {
        length = length / MAX_PAGE_COUNT
        if(length % 1 != 0) {
            length = parseInt(length)
            length++
        }
    }
    else {
        length = 1
    }
    
    data = JSON.stringify(data)
    currentPage = parseInt(current_page)
    const range = 4
    let page = ""
    //checks if previous and last will display
    if(current_page > 1) {
        page += `<button onClick = 'nextPage(1, ${data});'><i class="fas fa-angle-double-left"></i></button>`

        let previous = current_page - 1

        page += `<button onClick = 'nextPage(${previous}, ${data});'><i class="fas fa-angle-left"></i></button>`
    }
    //checks current pages to show 1, 2, 3...
    for(let j = (current_page - range); j < (current_page + range); j++) {
        if((j > 0) && (j <= length)) {
            if(j == current_page) {
                page += `<button class = "page-active" onClick = 'nextPage(${j}, ${data});' disabled>` + j + `</button>`
            }
            else {
                page += `<button onClick = 'nextPage(${j}, ${data});'>` + j + `</button>`
            }
        }
    }
    //checks if total pages are greater than 1
    if(length > 1) {
        if(current_page != length) {
            let next = current_page + 1
    
            page += `<button onClick = 'nextPage(${next}, ${data});'><i class="fas fa-angle-right"></i></button>`
    
            page += `<button onClick = 'nextPage(${length}, ${data});'><i class="fas fa-angle-double-right"></i></button>`
        }
    }

    $("#" + page_id + "-page").html(page)
}