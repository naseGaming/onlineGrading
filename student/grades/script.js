$(() => {
    getYearLevel()
})

function getYearLevel() {
    GetData("../api/controllers/students.php", "getYearLevel")
    .then(response => {
        if(response.type == "success") {
            let data = ""

            if(response.content.year == "Grade 11" || response.content.year == "Grade 12") {
                $("#tblGrades_Senior").show()

                data = "tblGrades_Senior"
            }
            else {
                $("#tblGrades").show()

                data = "tblGrades"
            }

            renderGrade(data)
        }
        else {
            window.location.href = `./?error_pages&code=${response.code}&message=${response.message}`;
        }
    })
}

function renderGrade(id) {
}