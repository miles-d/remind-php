$(document).ready(function() {
    // animated flash message
    $('#flash').hide().slideDown().delay(2000).slideUp();

    // Turn table rows to links -  more natural behavior for hover
    $('.table a.to-review').css('pointer-events', 'none');
    $('.table > tbody > tr').css('cursor', 'pointer');
    $('.table > tbody > tr a.to-material').css('cursor', 'pointer');

    // Turn table rows to links;
    $('.table > tbody > tr').click( function(event) {
        var a = $(this).children(':first-child').children(':first-child')
        window.location.href = a.attr('href');
    });

    $('a.to-material').click(function(event) {
      event.stopPropagation();
      event.preventDefault();
      var url = $(this).attr('href');
      window.open(url);
    });
});
