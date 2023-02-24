$(() => {
    let data = "type=viewSubjects";

    GetData("../api/controllers/subjects.php", data)
    .then(response => {
        console.log(response)
    })
})