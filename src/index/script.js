var isUsernameFocus = false
var usernameFocusTimer = ""

$(() => {
    $("#frmLogin").on("submit", (e) => {
        e.preventDefault()
        
        data = {
            username: $("#txtUsername").val(),
            password: $("#txtPassword").val()
        }
        
        PostData("./api/controllers/login.php", data)
        .then(response => {
            if(response.type == "success") {
                Swal.fire({
                    icon: response.type,
                    title: "Login Success!",
                })
                Swal.showLoading()

                setTimeout(() => {
                    switch(response.role) {
                        case 0:
                            window.location.href = "./backoffice/?dashboard";
                            break;
                        case 1:
                            window.location.href = "./teacher";
                            break;
                        case 2:
                            window.location.href = "./student";
                            break;
                        default:
                            window.location.href = "./error_pages/?code=403&message=Permission Denied";
                            break;
                    }
                }, 2000)
            }
            else if(response.type == "http_error") {
                window.location.href = "./error_pages/?code=" + response.code + "&message=" + response.message;
            }
            else {
                Swal.fire({
                    icon: response.type,
                    title: "Login Failed!",
                    text: response.message,
                })
            }
        })
    })
})