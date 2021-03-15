$(document).ready(() => {
    $('#modificarButton').click(function() {
        
        var inputNota = '<label for="evaluacion-input">Evaluación general del Comité:</label>'
        inputNota = inputNota + '<input name="nota" type="number" step="0.1" min="1" max="7" value="' + $('#hiddenNota').val() + '">'

        var inputComentario = '<label for="comentario-input" class="col-form-label">Comentario:</label><br>'
        inputComentario = inputComentario + '<textarea name="comentario" placeholder="Ingrese su comentario aquí..." id="" cols="60" rows="10" value">' + $('#hiddenComentario').val() + '</textarea>'
       
        $('#modificarEvaluacion').html(inputNota)
        $('#modificarComentario').html(inputComentario)

        var button = '<button name="agregarComentario" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Guardar</button>'
        $('#modButton').html(button)

        $('#saveEvaluacionBtn').attr('form', 'modificarForm')
    })
})