var interval

function createLink(hrefTag, idSelect) {
    var linkArray = $(hrefTag).prop("href").split("/")
    $(hrefTag).attr("href", linkArray[0] + "//" + linkArray[2] + "/" + linkArray[3] + "/" + idSelect)
}

$(document).ready(() => {
    $("#select-subarea").on('change', function() {
        console.log($(this).val())
        var idSubarea = $(this).val()
        createLink("#descargar", idSubarea)
    })
    
    $('#ModalExcelInvestigacion').on('hidden.bs.modal', function (e) {
        $('strong').hide()
        $('#importInvestigacionBtn').attr("disabled", true)
        $('#investigacionFile').val("")
    })

    $('#investigacionFile').on("change", function() {
        if($('#investigacionFile').val() !== "") {
            $('strong').show()
            $('#importInvestigacionBtn').attr("disabled", false)
        } else {
            $('strong').hide()
            $('#importInvestigacionBtn').attr("disabled", true)
        }
    })

    $('#cancelarImportInvestigacion').click(function() {
        $('strong').hide()
        $('#investigacionFile').val("")
    })

    $('#selectInvestigacionExport').on('change', function() {
        console.log($(this).val())
        var idTipoactividad = $(this).val()
        createLink("#descargarInvestigacion", idTipoactividad)
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