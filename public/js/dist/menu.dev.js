"use strict";

var estado = false;
$('#btn-menu').on('click', function () {
  var _this = this;

  if (!estado) {
    $(this).addClass('anima');
    $('#relleno').addClass('anima');
    $('.header-datos h3').addClass('anima');
    setTimeout(function () {
      $('#liston').addClass('anima');
    }, 1000);
    setTimeout(function () {
      $('#navi').addClass('anima');
      estado = true;
    }, 2000);
  } else {
    $('#navi').removeClass('anima');
    setTimeout(function () {
      $('#liston').removeClass('anima');
    }, 1000);
    setTimeout(function () {
      $(_this).removeClass('anima');
      $('#relleno').removeClass('anima');
      $('.header-datos h3').removeClass('anima');
      estado = false;
    }, 2000);
  }
});