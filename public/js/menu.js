var estado = false
$('#btn-menu').on('click', function () {
    if (!estado) {
        $(this).addClass('anima')
        $('#relleno').addClass('anima')
        $('.header-datos h3').addClass('anima')
        setTimeout(() => {
            $('#liston').addClass('anima')
        }, 1000);
        setTimeout(() => {
            $('#navi').addClass('anima')
            estado = true
        }, 2000);
    } else {
        $('#navi').removeClass('anima')
        setTimeout(() => {
            $('#liston').removeClass('anima')
        }, 1000);
        setTimeout(() => {
            $(this).removeClass('anima')
            $('#relleno').removeClass('anima')
            $('.header-datos h3').removeClass('anima')
            estado = false
        }, 2000);
    }
})