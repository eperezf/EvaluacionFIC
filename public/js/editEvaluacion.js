var prevHTML = $('#modificar').html()

function edit() {
    var inputNota = '<label for="evaluacion-input">Evaluación general del Comité:</label>'
    inputNota = inputNota + '<input class="ml-2" name="nota" type="number" step="0.1" min="1" max="7" value="' + $('#hiddenNota').val() + '">'

    var inputComentario = '<label for="comentario-input" class="col-form-label">Comentario:</label><br>'
    inputComentario = inputComentario + '<textarea name="comentario" placeholder="Ingrese su comentario aquí..." id="" cols="60" rows="5" value">' + $('#hiddenComentario').val() + '</textarea>'
    
    $('#modificarEvaluacion').html(inputNota)
    $('#modificarComentario').html(inputComentario)
    
    var buttons = '<button name="cm" id="cm" type="button" class="btn btn-secondary mt-2" onclick="cancel()">Cancelar</button>'
    buttons = buttons + '<button name="guardarModificacion" type="button" class="btn btn-primary ml-2 mt-2" data-toggle="modal" data-target="#exampleModalCenter">Guardar</button>'

    $('#modButtons').html(buttons)
    $('#saveEvaluacionBtn').attr('form', 'modificarForm')
}

function cancel() {
    console.log(prevHTML)
    $('#modificar').html(prevHTML)
}
