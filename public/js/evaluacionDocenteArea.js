$(document).ready(() => {
    $("#select-area").on('change', function() {
        console.log($(this).val())
        var idArea = $(this).val()
        $("#descargar").attr("href", "http://127.0.0.1/evaluacionDocenteExport/" + idArea)
    })
})