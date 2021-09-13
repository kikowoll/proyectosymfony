"use strict";

var URLS = 'http://localhost:8000/comparador',
    trailer = camion = furgon = coche = 0;
var comunidad1 = '',
    comunidad2 = '',
    provincia1 = '',
    provincia2 = '',
    com = '',
    pro = '',
    localidad1 = '',
    localidad2 = ''; // conttrola que haya un vehiculo minimo selecionado

$('.vehiculos').on('change', function () {
  trailer = parseInt($('#se-trailer').val());
  camion = parseInt($('#se-camion').val());
  furgon = parseInt($('#se-furgon').val());
  coche = parseInt($('#se-coche').val());
  var total = trailer + camion + furgon + coche;

  if (total < 1) {
    $('#btn-vehiculos').attr('disabled', true);
  } else {
    $('#btn-vehiculos').attr('disabled', false);
  }

  var fila1 = '',
      fila2 = '',
      fila3 = '',
      fila4 = ''; //trailer

  for (var i = 0; i < trailer; i++) {
    fila1 += '<img src="../img/c1.png" width="50">&nbsp;';
  }

  $('#coches-trailer').html(fila1); // camion

  for (var i = 0; i < camion; i++) {
    fila2 += '<img src="../img/c2.png" width="50">&nbsp;';
  }

  $('#coches-camion').html(fila2); //furgon

  for (var i = 0; i < furgon; i++) {
    fila3 += '<img src="../img/c3.png" width="50">&nbsp;';
  }

  $('#coches-furgon').html(fila3); //coches

  for (var i = 0; i < coche; i++) {
    fila4 += '<img src="../img/c4.png" width="50">&nbsp;';
  }

  $('#coches-coche').html(fila4);
}); // comunidad salida

$('#com-salida').on('change', function () {
  comunidad1 = $(this).val();
  com = $(this).val();
  provincia('salida');
  $('#btn-ciudad').attr('disabled', true);
}); //provincia salida

$('#pro-salida').on('change', function () {
  provincia1 = $(this).val();
  pro = $(this).val();
  localidad('salida');
  $('#btn-ciudad').attr('disabled', true);
}); //localidad salida

$('#loc-salida').on('change', function () {
  var local = $(this).find('option:selected').text();
  localidad1 = $(this).val();
  comunidad('llegada');
  $('#btn-ciudad').attr('disabled', true);
  $('#txt-procedencia').html(local + ' (' + provincia1 + ')');
  $('#local-salida').val(local);
}); // comunidad llegada

$('#com-llegada').on('change', function () {
  comunidad2 = $(this).val();
  com = $(this).val();
  provincia('llegada');
  $('#btn-ciudad').attr('disabled', true);
}); //provincia llegada

$('#pro-llegada').on('change', function () {
  provincia2 = $(this).val();
  pro = $(this).val();
  localidad('llegada');
  $('#btn-ciudad').attr('disabled', true);
}); //localidad llegada

$('#loc-llegada').on('change', function () {
  var local = $(this).find('option:selected').text();
  localidad2 = $(this).val();
  $('#btn-ciudad').attr('disabled', false);
  $('#txt-destino').html(local + ' (' + provincia2 + ')');
  $('#local-llegada').val(local);
});

function comunidad(ver) {
  var opcion = ver,
      fila = '';
  $.ajax({
    url: URLS + '/mostrarCom',
    type: 'post',
    dataType: 'json'
  }).done(function (response) {
    fila += '<option>Seleciona una comunidad</option>';
    $.each(response, function (index, data) {
      fila += '<option value="' + data.comunidad + '">' + data.comunidad + '</option>';
    });

    if (opcion == 'salida') {
      $('#com-salida').html(fila);
    } else {
      $('#com-llegada').html(fila);
    }
  }).fail(function (err) {
    console.log('Error al mostrar comunidades ' + err);
  });
}

function provincia(ver) {
  var opcion = ver,
      fila = '';
  $.ajax({
    url: URLS + '/mostrarPro',
    type: 'post',
    dataType: 'json',
    data: {
      datos: com
    }
  }).done(function (response) {
    fila += '<option>Seleciona una provincia</option>';
    $.each(response, function (index, data) {
      fila += '<option value="' + data.provincia + '">' + data.provincia + '</option>';
    });

    if (opcion == 'salida') {
      $('#pro-salida').html(fila);
    } else {
      $('#pro-llegada').html(fila);
    }
  }).fail(function (err) {
    console.log('Error al mostrar provincia ' + err);
  });
}

function localidad(ver) {
  var opcion = ver,
      fila = '';
  $.ajax({
    url: URLS + '/mostrarLoc',
    type: 'post',
    dataType: 'json',
    data: {
      datos: pro
    }
  }).done(function (response) {
    fila += '<option>Seleciona una localidad</option>';
    $.each(response, function (index, data) {
      fila += '<option value="' + data.latitud + ',' + data.longitud + '">' + data.municipio + '</option>';
    });

    if (opcion == 'salida') {
      $('#loc-salida').html(fila);
    } else {
      $('#loc-llegada').html(fila);
    }
  }).fail(function (err) {
    console.log('Error al mostrar localidad ' + err);
  });
}

comunidad('salida'); // funciones del mapa

function mapeo() {
  var sal = $('#loc-salida').val(),
      lle = $('#loc-llegada').val(),
      datoSa = sal.split(','),
      datoLg = lle.split(',');
  var tileProvided = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
  var myMap = L.map('myMapa').setView([40.42028, -3.70577], 4);
  L.tileLayer(tileProvided, {
    maxZoom: 18
  }).addTo(myMap);
  L.Routing.control({
    waypoints: [L.latLng(parseFloat(datoSa[0]), parseFloat(datoSa[1])), L.latLng(parseFloat(datoLg[0]), parseFloat(datoLg[1]))],
    routeWhileDragging: true,
    zoomControl: false
  }).addTo(myMap);
  $('.leaflet-right').css('display', 'none');
  $('.leaflet-left').css('display', 'none');
  setTimeout(function () {
    var ruta = $('.leaflet-routing-alternatives-container .leaflet-routing-alt h3').text(),
        repla = ruta.split(' ');
    kilo = parseFloat(repla[0]);
    $('#txt-kilometros').text(kilo + ' kms.');
    $('#kilos').val(kilo);
  }, 1000);
}

var lado = false;

function pasar() {
  if (!lado) {
    $('.conte-compara').css('margin-left', '-100%');
    lado = true;
  } else {
    $('.conte-compara').css('margin-left', '-200%');
    mapeo();
  }
}

function reseteo() {
  $('.conte-compara').css('margin-left', '0%');
  lado = false;
}