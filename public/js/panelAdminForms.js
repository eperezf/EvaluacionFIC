$(document).ready(function() {
    // Obtenemos el nombre de la actividad desde input hidden
    var activityType = $("#activityName").val();
    console.log(activityType)

    // Se obtiene cantidad inicial de formularios (1) y se muestra
    var formsQty = $("#numberForms").val()
    console.log(formsQty)
    printForms(activityType, formsQty)

    // Llama a la funcion de formularios cada vez que cambia la cantidad seleccionada de formularios a llenar
    $('#numberForms').change(function() {
        formsQty = $(this).val()
        console.log(formsQty)
        printForms(activityType, formsQty)
    })
})

function printForms(formType, quantity) {
    switch(formType) {
        case "Administración académica":
            console.log("OwO")
            break
        
        default:
            break
    }
}
