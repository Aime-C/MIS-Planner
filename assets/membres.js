import $ from 'jquery';
$(document).ready(function () {

    // Ouvre la popup
    $('.idbtndeletemembre').on('click', function (e) {
        e.preventDefault();
        confirmExpulsion($(this));
    });


});

function confirmExpulsion(objButton) {
    let confirmAction = null;

    const idMembre = objButton.data('idmembre');

    const actionUrl = '/MIS-planner/public/membre/del/'+idMembre; // URL à exécuter sur "Oui"
    confirmAction = () => {
        window.location.href = actionUrl;
    };

    $('#confirmModalExpulsion').removeClass('hidden');

    // Clique sur "Non"
    $('#confirmNo').on('click', function () {
        $('#confirmModalExpulsion').addClass('hidden');
        confirmAction = null;
    });

    // Clique sur "Oui"
    $('#confirmYes').on('click', function () {
        if (confirmAction) confirmAction();
    });
}