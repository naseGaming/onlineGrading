$(() => {
	let url = window.location.search.substring(1)
	let urlData = url.split("?")
	let urlMessage = url.split("&")

    let error_code = urlMessage[0].split("=")
    let error_text = urlMessage[1].split("=")

    console.log(error_code)

    $("#error_code").html(error_code[1])
    $("#error_text").html(error_text[1].replace("%20", " "))
})