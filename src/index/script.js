$(() => {
    $.when(setNotification("src/notification-too"))
    .done(() => {

        $("#frmLogin").on("submit", (e) => {
            e.preventDefault()
            
            data = {
                type: "login",
                content: {
                    username: $("#txtUsername").val(),
                    password: $("#txtPassword").val()
                }
            }
            
            PostData("./api/controllers/accounts.php", data)
            .then(response => {
                if(response.type == "success") {
                    showNotification("Login successful!", response.type)

                    switch(response.role) {
                        case 0:
                            window.location.href = "./pages/admin";
                            break;
                        case 1:
                            window.location.href = "./pages/teacher";
                            break;
                        case 2:
                            window.location.href = "./pages/student";
                            break;
                        default:
                            window.location.href = "./pages/student";
                            break;
                    }
                }
                else if(response.type == "http_error") {  
                    window.location.href = "./error_pages/?code=" + response.code + "&message=" + response.message;
                }
                else {
                    showNotification(response.message, response.type)
                }
            })
        })
    })
})