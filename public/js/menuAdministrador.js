var interval

$(document).ready(() => {
    $("#select-subarea").on('change', function() {
        console.log($(this).val())
        var idSubarea = $(this).val()
        var linkArray = $("#descargar").prop("href").split('/')
        var link = linkArray[0] + "//" + linkArray[2] + "/" + linkArray[3] + "/" + idSubarea
        $("#descargar").attr("href", link)
    })

    $('#ModalExcelEncuesta').on('hidden.bs.modal', function (e) {
        $('#collapseConfirmacion').collapse('hide')
        $('#importEncuestaBtn').attr("disabled", true)
        $('#importPassword').val("")
        $('#encuestaDocenteFile').val("")
    })

    $('#encuestaDocenteFile').on("change", function() {
        if($('#encuestaDocenteFile').val() !== "") {
            $('#collapseConfirmacion').collapse('show')
        } else {
            $('#collapseConfirmacion').collapse('hide')
            $('#importEncuestaBtn').attr("disabled", true)
            $('#importPassword').val("")
        }
    })

    $('#cancelarImportEncuesta').click(function() {
        $('#collapseConfirmacion').collapse('hide')
        $('#encuestaDocenteFile').val("")
        $('#importPassword').val("")
    })

    $('#importPassword').on("input", function() {
        if($(this).val()) {
            $('#importEncuestaBtn').attr("disabled", false)
        } else {
            $('#importEncuestaBtn').attr("disabled", true)
        }
    })
})