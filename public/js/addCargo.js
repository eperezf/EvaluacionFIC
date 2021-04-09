$(document).ready(() => {
    $('#tipoActividad').on('change', function() {
        var idTipoActividad = $(this).val();
        var request = new Request('/api/getCargoTipoActividad/'+idTipoActividad);
        fetch(request).then((response) => {
            return response.json();
        }).then((response) => {
            $('#cargo').empty();
            $('#response').html("");
            $('#cargo').append('<option disabled selected>Seleccione un cargo</option>');
            response.forEach((item, i) => {
                $('#cargo').append('<option value="'+item.id+'">'+item.nombre+'</option>').removeAttr("disabled");
            });
        });
    });

    $('#cargo').on('change', function() {
        var idCargo = $(this).val();
        var cargoRequest = new Request('/api/getCargo/' + idCargo);
        fetch(cargoRequest).then((response) => {
            return response.json();
        }).then((response) => {
            var cargo = response[0];
            $('#response').html("");
            var request;
            var name;
            var message;
            console.log(cargo.nombre);
            switch(cargo.nombre){
                case "Director de área":
                    var areaRequest = new Request('/api/getAreasAll');
                    name = "area";
                    message = "Selecciona una área";
                    request = areaRequest; 
                break;

                case "Director de subarea":
                    var subareaRequest = new Request('/api/getSubareasAll');
                    name = "subarea";
                    message = "Selecciona una subarea";
                    request = subareaRequest; 
                break;
                
                case "Subdirector de docencia":
                    var asignaturaRequest = new Request('/api/getAsignaturasAll');
                    name = "asignatura";
                    message = "Seleccione una asignatura";
                    request = asignaturaRequest;
                break;

                case "Director de docencia":
                    var asignaturaRequest = new Request('/api/getAsignaturasAll');
                    name = "asignatura";
                    message = "Seleccione una asignatura";
                    request = asignaturaRequest;
                break;

                default:
                    //
                break;
            }
            fetch(request).then((response) => {
                return response.json();
            }).then((response) => {
                var select = '<select name="'+ name +'" id="' + name + '" class="form-control"><option disabled selected>' + message + '</option>';
                response.forEach((item, i) => {
                    select = select + '<option value=' + item.id + '>' + item.nombre + '</option>';
                });
                select = select + '</select>';
                $('#response').append(
                    '<label for="' + name + '" class="col-sm-3">' + message + '</label>' +
                    '<div class="form-group col-sm-5">' + select + '</div>'
                );
            });
        });
    });
});
