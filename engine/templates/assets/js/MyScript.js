//    Выравнивание блока по высоте (Users)
$(document).ready(function () {
    var main = $('#main-height').height();
    var child = $('#child-height').height(main - 40);
});

//        Выбор прав доступа (style)
$('.select-access').on('click', function() {
    $('.select-access-container').animate({'height': '120px'}, 300);
    $('.select-access').addClass('active');
});

$('#select-access li').on('click', function() {
    var region = $(this).text();
    $('#select-assets li').each(function () { $(this).removeClass('act-access'); });
    $(this).addClass('act-access');
    $('.select-access').text(region);
    $('.select-access').attr('data-value-assets');
    $('.select-access-container').animate({'height': '0'}, 300);
    $('.select-access').removeClass('active');
});

//        Выбор прав доступа (style)
$('.select-area').on('click', function(){
    $('.select-area-container').animate({'height': '120px'}, 300);
    $('.select-area').addClass('active');
});

$('#select-area li').on('click', function(){
    var region = $(this).text();
    $('#select-area li').each(function () { $(this).removeClass('act-area'); });
    $(this).addClass('act-area');
    $('.select-area').text(region);
    $('.select-area-container').animate({'height': '0'}, 300);
    $('.select-area').removeClass('active');
});
//  Pop up с сообшениями об ошибках
function popUpMessage (text) {
    var time = 3500;
    var pstime = time + 500;
    $('#mess-text').text(text);
    $('.popup-message').addClass('mess-show');
    $('.popup-message .time-line').animate({'width':'0%'}, time, function () {$(this).css('width', '100%')});
    setTimeout(function () {
        $('.popup-message').addClass('mess-hide');
    } ,time);
    setTimeout(function () {
        $('.popup-message').removeClass('mess-hide mess-show');
    }, pstime);
}
//  Закрыть PopUp
$('.close-message img').on('click', function () {
    $('.popup-message').removeClass('mess-hide mess-show');
});

//  Закрытие окна после регистрации
$('#step5 input').on('click', function () {
    $('.tab-group li:eq(1)').removeClass('active');
    $('.tab-group li:eq(0)').addClass('active');
    $('#authorization').addClass('active-tab');
    $('#registration').removeClass('active-tab');
});

// Поиск пользователей
$('#user-search').on('submit', function (e) {
    e.preventDefault();
    var searchText = $('#search').val();
    var lenght = searchText.length;
    $('.tbl-all-users tr td span').each(function () {
        var text = $(this).text();
        var subText = text.substring(0, lenght);
        $(this).parent().parent().css({'position':'relative', 'zIndex': '1'});
        if (subText.toUpperCase() != searchText.toUpperCase()) {
            $(this).parent().parent().css({'position':'absolute', 'zIndex': -1});
        }
    });
});

// Закрыть меню планшета
$('#close-menu-tablet').on('click', function () {
    $('.pl-menu').removeClass('tablet-active');
});

$('.tablet-mini-menu').on('click', function () {
    $('.pl-menu').addClass('tablet-active');
});

//  Стрелочка при наведении на подьзователей
$('.arrow-left').hover(function () {
    //$(this).append('bgeskldjg').css({'position':'absolute'});
});