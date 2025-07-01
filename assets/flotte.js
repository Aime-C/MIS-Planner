import $ from 'jquery';

$(document).ready(function () {
    $('#idsortisreleased').attr('checked', 'checked');
    showHideIsReleased();
    $('#idsortisreleased').on('change', function () {
        showHideIsReleased();
    })
});

function showHideIsReleased() {
    $('.cardflotte').each(function (index) {
        const isReleased = $(this).data('released');
        if (isReleased == 0) {
            if ( $('#idsortisreleased').is(':checked')) {
                $(this).css("display", "flex");
            } else {
                $(this).css("display", "none");
            }
        }
    });
}
