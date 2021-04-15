var interval

function createLink(hrefTag, idSelect) {
    var linkArray = $(hrefTag).prop("href").split("/")
    $(hrefTag).attr("href", linkArray[0] + "//" + linkArray[2] + "/" + linkArray[3] + "/" + idSelect)
}

$(document).ready(() => {
    // Evaluacion Desempeño
    $("#select-subarea").on('change', function() {
        var idSubarea = $(this).val()
        createLink("#descargarEvalDesempeno", idSubarea)
        if($(this).val() !== null) {
            $("#descargarEvalDesempeno").attr("hidden", false)
        } else {
            $("#descargarEvalDesempeno").attr("hidden", true)
        }
    })

    $("#evalDesempenoFile").on('change', function() {
        if($(this).val() !== "") {
            $("#collapseConfirmacionEvalDesempeno").collapse("show")
            $("#importEvalDesempenoBtn").attr("disabled", false)
        } else {
            $("#collapseConfirmacionEvalDesempeno").collapse("hide")
            $("#importEvalDesempenoBtn").attr("disabled", true)
        }
    })

    $("#ModalExcelSuperior").on("hidden.bs.modal", function() {
        $("#collapseConfirmacionEvalDesempeno").collapse("hide")
        $("#select-subarea").val("Seleccione una Subarea")
        $("#importEvalDesempenoBtn").attr("disabled", true)
        $("#evalDesempenoFile").val("")
        $("#descargarEvalDesempeno").attr("hidden", true)
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
        $("#descargarInvestigacion").attr("hidden", true)
    })

    $('#selectInvestigacionExport').on('change', function() {
        var idTipoactividad = $(this).val()
        createLink("#descargarInvestigacion", idTipoactividad)
        if($(this).val() !== null) {
            $("#descargarInvestigacion").attr("hidden", false)
        } else {
            $("#descargarInvestigacion").attr("hidden", true)
        }
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

    $('#importPassword').on("input", function() {
        if($(this).val()) {
            $('#importEncuestaBtn').attr("disabled", false)
        } else {
            $('#importEncuestaBtn').attr("disabled", true)
        }
    })

    //Administración Académica
    $('#administracionAcademicaFile').on('change', function() {
        if(($(this).val() !== "")) {
            $('#collapseConfirmacionAdministracionAcademica').collapse('show')
            $('#importAdministracionAcademicaBtn').attr("disabled", false)
        } else {
            $('#collapseConfirmacionAdministracionAcademica').collapse('hide')
            $('#importAdministracionAcademicaBtn').attr("disabled", true)
        }
    })

    $('#ModalExcelAdministracionAcademica').on('hidden.bs.modal', function (e) {
        $('#collapseConfirmacionAdministracionAcademica').collapse('hide')
        $('#importAdministracionAcademicaBtn').attr("disabled", true)
        $('#administracionAcademicaFile').val("")
    })

    //Vinculación con el Medio
    $('#vinculacionFile').on('change', function() {
        if(($(this).val() !== "")) {
            $('#collapseConfirmacionVinculacion').collapse('show')
            $('#importVinculacionBtn').attr("disabled", false)
        } else {
            $('#collapseConfirmacionVinculacion').collapse('hide')
            $('#importVinculacionBtn').attr("disabled", true)
        }
    })

    $('#ModalExcelVCM').on('hidden.bs.modal', function (e) {
        $('#collapseConfirmacionVinculacion').collapse('hide')
        $('#importVinculacionBtn').attr("disabled", true)
        $('#vinculacionFile').val("")
    })

})