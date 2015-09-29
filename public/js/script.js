$(document).ready(function() {
    // animated flash message
    $('#flash').hide().slideDown().delay(2000).slideUp();

    // Turn table rows to links -  more natural behavior for hover
    $('.table a').css('pointer-events', 'none');
    $('.table > tbody > tr').css('cursor', 'pointer');

    // Turn table rows to links;
    $('.table > tbody > tr').click( function() {
        var a = $(this).children(':first-child').children(':first-child')
        window.location.href = a.attr('href');
    });
});
