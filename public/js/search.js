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
      $('#sugerencias').append('<div>No hay resultados</div>');
    }
    lista.forEach((item, i) =>
    {
      $('#sugerencias').append('<div>'+item.nombre+'</div>');
    });
  });
}
