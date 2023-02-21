data = {
    type: "login",
    content: {
        username: "admin",
        password: "1234"
    }
}

testGet(data)

function testGet(data = {}) {
    DeleteData("./api/controllers/accounts.php", data)
    .then(response => {
        console.log(response)
    })
}