$(document).ready(function () {
    $('.remove-link').on('click', function (e) {
        if (! confirm("Czy na pewno usunąć?")) {
            e.preventDefault();
        }
    });

    if ($(".rich-editor").length) {
        tinymce.init({
            selector: ".rich-editor"
            , relative_urls: false
            , convert_urls: false
            , language: 'pl'
            , plugins: [
                "advlist autolink lists link charmap anchor",
                "searchreplace visualblocks code",
                "insertdatetime table contextmenu paste"
            ]
            , toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link"
        });
    }
});
