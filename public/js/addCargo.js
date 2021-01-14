$(document).ready(()=>{
  $('#tipoActividad').on('change', function (){
    console.log($(this).val());
    var idTipoActividad = $(this).val()
    var request = new Request('/api/getCargoTipoActividad/'+idTipoActividad)
    fetch(request).then((response)=>{
      return response.json();
    }).then((response)=>{
      console.log(response);
      $('#cargo').empty()
      response.forEach((item, i) => {
        $('#cargo').append('<option value="'+item.id+'">'+item.nombre+'</option>').removeAttr("disabled");
      });
    })
  })
})
