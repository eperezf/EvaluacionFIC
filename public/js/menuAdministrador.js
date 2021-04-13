var interval

function createLink(hrefTag, idSelect) {
    var linkArray = $(hrefTag).prop("href").split("/")
    $(hrefTag).attr("href", linkArray[0] + "//" + linkArray[2] + "/" + linkArray[3] + "/" + idSelect)
}

$(document).ready(() => {
    // Evaluacion Desempeño
    $("#select-subarea").on('change', function() {
        console.log($(this).val())
        var idSubarea = $(this).val()
        createLink("#descargar", idSubarea)
    })

    // Investigacion
    $('#selectInvestigacionImport, #investigacionFile').on('change', function() {
        if(($('#selectInvestigacionImport').val() !== null) && ($('#investigacionFile').val() !== "")) {
            $('#collapseConfirmacionInvestigacion').collapse('show')
            $('#importInvestigacionBtn').attr("disabled", false)
        } else {
            $('#collapseConfirmacionInvestigacion').collapse('hide')
            $('#importInvestigacionBtn').attr("disabled", true)
        }
    })

    $('#ModalExcelInvestigacion').on('hidden.bs.modal', function (e) {
        $('#collapseConfirmacionInvestigacion').collapse('hide')
        $('#importInvestigacionBtn').attr("disabled", true)
        $('#selectInvestigacionExport').val("Seleccione un tipo de investigación")
        $('#selectInvestigacionImport').val("Seleccione un tipo de investigación")
        $('#investigacionFile').val("")
    })

    $('#selectInvestigacionExport').on('change', function() {
        console.log($(this).val())
        var idTipoactividad = $(this).val()
        createLink("#descargarInvestigacion", idTipoactividad)
    })

    // Encuesta Docente
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