const details = {
    url: "../api/controllers/sections.php",
    id: "dashboard-card-teacher",
    button: true,
    action: ".?view_grades&section="
}

$(() => {
    renderCards(details)
})