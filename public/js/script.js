/*global $ */
/*jslint browser: true */

var APP = {};

APP.populateTable = function (response) {
    var items = response.data,
        $table = $("#review-table"),
        row = '';

    $table.find('tbody').empty();
    items.forEach(function (item) {
        var link = '',
            rowClass = '',
            reviewButton = '';

        if (item.link) {
            link = ' <a class="to-material" href="' + item.link + '" target="_blank">(LINK)';
        }

        if (item.is_due) {
            rowClass = 'success';
            reviewButton = '<button type="button" class="mark-reviewed-btn btn btn-xs btn-success"><span class="hidden-xs">Mark</span> reviewed</button>';
        } else if (item.mastered === "1") {
            rowClass = 'info';
        }

        var rowTitleAttribute = '';
        if (item.comment) {
            rowTitleAttribute = ' title="' + item.comment + '"';
        }

        row = '<tr data-id="' + item.id + '" class="' + rowClass + '" ' + rowTitleAttribute + '>' +
            '<td class="edit-item">' + item.description + link + '</a></td>' +
            '<td class="edit-item">' + item.next_review_date + '</td>' +
            '<td>' + reviewButton + '</td>' +
            '</tr>';

        $table.find('tbody').append(row);
    });
};

APP.initReviewTable = function () {
    $.get('/api/review', APP.populateTable).then(function () {
        // animated flash message
        $('#flash').hide().slideDown().delay(500).slideUp();

        // Turn table rows to links -  more natural behavior for hover
        $('.table a.to-review').css('pointer-events', 'none');
        $('.table > tbody > tr > td.edit-item').css('cursor', 'pointer');
        $('.table > tbody > tr a.to-material').css('cursor', 'pointer');

        // Turn table rows to links;
        $('.table > tbody > tr > td.edit-item').click( function () {
            var id = $(this).parent().data('id');
            window.location.href = '/review/' + id;
        });

        $('a.to-material').click(function(event) {
            event.stopPropagation();
            event.preventDefault();
            var url = $(this).attr('href');
            window.open(url);
        });

        $(".mark-reviewed-btn").off('click');
        $(".mark-reviewed-btn").on('click', function () {
            var id = $(this).closest('tr').data('id');
            $.post('/review/' + id + '/mark-reviewed').done(function () {
                APP.initReviewTable();
            });
        });

    });
};

// mark as reviewed from "show" page
APP.reviewFromItemPage = function () {
    var $btn = $('#mark-reviewed-btn');
    $btn.on('click', function (e) {
        e.preventDefault();
        var id = $('#review_item_id').val();
        if (id) {
            $.post('/review/' + id + '/mark-reviewed').done(function () {
                window.location.reload();
            });
        }
    })
};

APP.init = function () {
    if ($("#review-table").length) {
        APP.initReviewTable();
    }
    if ($("#mark-reviewed-btn").length) {
        APP.reviewFromItemPage();
    }
};

$(document).ready(function() {
    APP.init();
});
