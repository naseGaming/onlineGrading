async function GetData(link, params = "") {
    const response = await fetch(link + "?" + params, {
        method: "GET", // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            "Content-type": "application/json"
        },
    })

    if(response.status != 200) {
        result = {
            type: "http_error",
            code: response.status,
            message: response.statusText
        }

        return result
    }
    else {
        return response.json()
    }
}

async function PostData(link, data = {}) {
    const response = await fetch(link, {
        method: "post", // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            "Content-type": "application/json"
        },
        body: JSON.stringify(data)
    })

    if(response.status != 200) {
        result = {
            type: "http_error",
            code: response.status,
            message: response.statusText
        }

        return result
    }
    else {
        return response.json()
    }
}

async function PutData(link, data = {}) {
    const response = await fetch(link, {
        method: "put", // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            "Content-type": "application/json"
        },
        body: JSON.stringify(data)
    })

    if(response.status != 200) {
        result = {
            type: "http_error",
            code: response.status,
            message: response.statusText
        }

        return result
    }
    else {
        return response.json()
    }
}

async function DeleteData(link, data = {}) {
    const response = await fetch(link, {
        method: "delete", // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            "Content-type": "application/json"
        },
        body: JSON.stringify(data)
    })

    if(response.status != 200) {
        result = {
            type: "http_error",
            code: response.status,
            message: response.statusText
        }

        return result
    }
    else {
        return response.json()
    }
}