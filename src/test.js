data = {
    type: "login",
    content: {
        username: "admin",
        password: "1234"
    }
}

testGet(data)

function testGet(data = {}) {
    apiLink("./api/controllers/accounts.php", "post", data)
    .then(response => {
        if(response.status == 404) {
            console.log("Function not found!")
        }
        else {
            console.log(response.json)
        }
    })
}

async function apiLink(link, method, data = {}) {
    const response = await fetch(link, {
        method: method, // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            "Content-type": "application/json"
        },
        body: JSON.stringify(data)
    })

    return response
}

async function apiLinkGet(link, params = "") {
    const response = await fetch(link + "?" + params, {
        method: "GETs", // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            "Content-type": "application/json"
        },
    })

    return response
}