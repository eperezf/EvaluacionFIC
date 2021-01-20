var timer;
var lista;
var string;
$( "#search" ).on('input', function( event )
{
  string = $("#search").val();
  if (string != "")
  {
    clearTimeout(timer);
    timer = setTimeout(alertFunc, 500);
  }
});

function alertFunc()
{
  if ($("#search").val() == "")
  {
    string = "0";
  }
  var request = new Request('/api/'+ruta+'/'+string);
  fetch(request).then(function(response) {
    return response.json();
  }).then(function(res)
  {
    lista = res;
    $("#sugerencias").empty();
    if(!lista[0])
    {
      $('#sugerencias').append('<h5 class="col-8">No hay resultados</h5>');
    }
    lista.forEach((item, i) =>
    {
      if (item.seccion) {
        item.nombre = item.seccion
      }
      if (item.titulo) {
        item.nombre = item.titulo
      }
      $('#sugerencias').append(
      '<div class="row p-1 bg-light rounded">' +
        '<h5 class="col-8">'+item.nombre+'</h5>' +
        '<a href="/panelAdministracion/' + ruta2 + '/' + item.id + '" class="btn btn-secondary col-2">Modificar</a>' +
        '<a href="" class="btn btn-danger col-2">Eliminar</a>' +
      '</div>'
      );
    });
  });
}
