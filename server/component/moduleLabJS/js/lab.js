$(document).ready(function () {
    initLabsTable();
});

function initLabsTable() {
    var table = $('#labs-js').DataTable({
        "order": [[0, "asc"]]
    });

    table.on('click', 'tr[id|="labs-js-url"]', function (e) {
        var ids = $(this).attr('id').split('-');
        document.location = window.location + '/update/' + parseInt(ids[3]);
    });
}