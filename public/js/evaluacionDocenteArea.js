$(document).ready(() => {
    $("#select-subarea").on('change', function() {
        console.log($(this).val())
        var idSubarea = $(this).val()
        var linkArray = $("#descargar").prop("href").split('/')
        var link = linkArray[0] + "//" + linkArray[2] + "/" + linkArray[3] + "/" + idSubarea
        $("#descargar").attr("href", link)
    })
})