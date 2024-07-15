async function renderCards(data = {}) {
    GetData(data.url, "type=card")
    .then(response => {
        let render = ""
        if(response.type == "success") {
            for(let items in response.content) {
                render += "<div class='cards'>"
                render += `<div class='cards-title'>${response.content[items].title}</div>`
                render += `<div class='cards-desc'>${response.content[items].desc}</div>`
                if(data.button) {
                    render += `<div class='cards-btn'><button>View</button></div>`
                }
                render += "</div>"
            }
        }

        $(`#${data.id}`).html(render)
    })
}