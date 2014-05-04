$(document).ready(function () {
    $('.remove-link').on('click', function (e) {
        if (! confirm("Czy na pewno usunąć?")) {
            e.preventDefault();
        }
    });
});
