var timer;
var lista;
var string;
var select;

$(document).ready(()=>{
  console.log(idtipoactividad);
  var request = new Request('/api/getCargoTipoActividad/' + idtipoactividad);
  fetch(request).then(function(response){return response.json();}).then(function(res)
  {
    select = '<select class="form-control col-sm-7 mr-1" requiered="true" name="cargo[]" id="cargo[]"><option disabled selected>Seleccione un cargo</option>'
    res.forEach((item, i) => {
      select = select + '<option value='+item.id+'>'+item.nombre+'</option>'
    });
    select = select + '</select>'

  });
})

$(tag).on('input', function( event )
{
  string = $(tag).val();
  if (string != "")
  {
    clearTimeout(timer);
    timer = setTimeout(getData(tag), 500);
  }
});

function getData(customTag)
{
  if ($(customTag).val() == "")
  {
    string = "0";
  }
  var request = new Request('/api/' + ruta + '/' + string);
  fetch(request).then(function(response){return response.json();}).then(function(res)
  {
    updateSuggestions(res, customTag);
  });
}

function updateSuggestions(response, customTag)
{
  lista = response;
  $("#sugerencias").empty();
  if(!lista[0])
  {
    $('#sugerencias').append('<h5 class="col-8">No hay resultados</h5>');
  }
  colors = ["light", "white"];
  switch(customTag)
  {
    case "#usuario":
      lista.forEach((user, i) =>
      {
        if(!$('#' + user.id).length)
        {
          $('#sugerencias').append(
            '<div class="row bg-' + colors[i%2] + ' rounded col-11 pb-1 pt-1">' +
            '<h5 class="col-10">' + user.nombres + ' ' + user.apellidoPaterno + ' ' + user.apellidoMaterno + '</h5>' +
            '<button class="btn btn-primary col-2" type="button" onclick="addUser(' + "'" + user.nombres + "'" + ',' + "'" + user.apellidoPaterno + "'" + ',' + "'" + user.apellidoMaterno + "'" + "," + user.id + ')"><i class="fas fa-plus"></i></button>' +
            '</div>'
          );
        }
      });
      break;
    default:
      break;
  }
}

function addUser(nombre, apellidoPaterno, apellidoMaterno, id)
{
  $("#sugerencias").html("");
  $("#usuario").val("");
  $("#usuarios-añadidos").append(
    '<div class="row rounded col-11 pb-1 pt-1" id="' + id + '">' +
      '<h5 class="col-10">' + nombre + ' ' + apellidoPaterno + ' ' + apellidoMaterno + '</h5>' +select+
      '<button class="btn btn-danger col-2" type="button" onclick="deleteUser(' + id + ')"><i class="fas fa-trash"></i></button>' +
      '<input id="user-' + id + '" name="user[]" hidden value="' + id + '"' +
    '</div>'
  )
}

function deleteUser(id)
{
  document.getElementById(id).remove();
  getData(tag);
}
