$(() => {
	let url = window.location.search.substring(1)
	let urlMessage = url.split("&")

    let error_code = urlMessage[1].split("=")
    let error_text = urlMessage[2].split("=")

    let error_code_to_display = error_code[1].split("")
    let render = ""
    let message = ""

    for(let i = 0; i < error_code_to_display.length; i++) {
        render += `<i class="fa-solid fa-${error_code_to_display[i]}"></i> `
    }
    
    $("#error_code").html(render)
    switch(parseInt(error_code[1])) {
        case 403: {
            message = "Houston, we don't have enough clearance for that over."
            break
        }
        case 404: {
            message = "Houston, we cannot find the web page you're requesting over."
            break
        }
        case 405: {
            message = "Houston, we are not allowed to do that method over."
            break
        }
        case 500: {
            message = "ISS, standby. We may have a problem here."
            break
        }
        default: {
            message = error_text[1].replace("%20", " ")
            break
        }
    }

    $("#error_text").html(message)
})