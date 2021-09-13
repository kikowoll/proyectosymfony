var URLS = 'http://localhost:8000/comparador',
    trailer = camion = furgon = coche = 0
var comunidad1 = '',
    comunidad2 = '',
    provincia1 = '',
    provincia2 = '',
    com = '',
    pro = '',
    localidad1 = '',
    localidad2 = ''



comunidad('salida')
// comunidad salida
$('#com-salida').on('change', function() {
    comunidad1 = $(this).val()
    com = $(this).val()
    provincia('salida')
})

//provincia salida
$('#pro-salida').on('change', function() {
    provincia1 = $(this).val()
    pro = $(this).val()
    localidad('salida')
})

//localidad salida
$('#loc-salida').on('change', function() {
    localidad1 = $(this).val()
    comunidad('llegada')
})

// comunidad llegada
$('#com-llegada').on('change', function() {
    comunidad2 = $(this).val()
    com = $(this).val()
    provincia('llegada')
})

//provincia llegada
$('#pro-llegada').on('change', function() {
    provincia2 = $(this).val()
    pro = $(this).val()
    localidad('llegada')
})

//localidad llegada
$('#loc-salida').on('change', function() {
    localidad2 = $(this).val()
})
function comunidad(ver) {
    var opcion = ver,
    fila = ''
    $.ajax({
        url: URLS + '/mostrarCom',
        type: 'post',
        dataType: 'json'
    }).done(response => {
        fila += '<option>Seleciona una comunidad</option>'
        $.each(response, (index, data) => {
            fila += '<option value="'+ data.comunidad +'">'+ data.comunidad +'</option>'
        })
        if(opcion = 'salida') {
            $('#com-salida').html(fila)
        } else {
            $('#com-llegada').html(fila)
        }
    }).fail(err => {
        console.log('Error al mostrar comunidades ' + err);
    })
}

function provincia(ver) {
    var opcion = ver,
    fila = ''
    $.ajax({
        url: URLS + '/mostrarPro',
        type: 'post',
        dataType: 'json',
        data: {
            datos: com
        }
    }).done(response => {
        fila += '<option>Seleciona una provincia</option>'
        $.each(response, (index, data) => {
            fila += '<option value="'+ data.provincia +'">'+ data.provincia +'</option>'
        })
        if(opcion = 'salida') {
            $('#pro-salida').html(fila)
        } else {
            $('#pro-llegada').html(fila)
        }
    }).fail(err => {
        console.log('Error al mostrar provincia ' + err);
    })
}

function localidad(ver) {
    var opcion = ver,
    fila = ''
    $.ajax({
        url: URLS + '/mostrarLoc',
        type: 'post',
        dataType: 'json',
        data: {
            datos: pro
        }
    }).done(response => {
        fila += '<option>Seleciona una localidad</option>'
        $.each(response, (index, data) => {
            fila += '<option value="'+ data.latitud +','+ data.longitud +'">'+ data.municipio +'</option>'
        })
        if(opcion = 'salida') {
            $('#loc-salida').html(fila)
        } else {
            $('#loc-llegada').html(fila)
        }
    }).fail(err => {
        console.log('Error al mostrar localidad ' + err);
    })
}