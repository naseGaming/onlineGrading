const details = {
    url_page: 1,
    url: "../api/controllers/accounts.php",
    method: {
        edit: "editAccount(this);",
        delete: "deleteAccount(this);"
    },
    table_id: "tblAccounts",
    current_page: 1
}

$(() => {
    paginateTable(details)
})