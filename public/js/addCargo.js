var select

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
            if(cargo.nombre == "Director de área") {
                var areaRequest = new Request('/api/getAreasAll');
                fetch(areaRequest).then((response) => {
                    return response.json();
                }).then((response) => {
                    select = '<select name="area" id="area" class="form-control"><option disabled selected>Seleccione una area</option>';
                    response.forEach((item, i) => {
                        select = select + '<option value=' + item.id + '>' + item.nombre + '</option>';
                    });
                    select = select + '</select>';
                    $('#response').append(
                        '<label for="area" class="col-sm-3">Seleccione una área</label>' +
                        '<div class="form-group col-sm-5">' + select + '</div>'
                    );
                });
            }
        });
    });
});
