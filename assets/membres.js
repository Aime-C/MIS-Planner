import $ from 'jquery';
$(document).ready(function () {

    // Ouvre la popup
    $('.idbtndeletemembre').on('click', function (e) {
        e.preventDefault();
        confirmExpulsion($(this));
    });

    $('#idAddMemberButton').on('click', function (e) {
        e.preventDefault();
        newMemberChoice();
    });


});

function newMemberChoice() {
    var actionUrl = null;

    $('#idNewMemberChoice').removeClass('hidden');

    $('#idNewMemberButton').on('click', function () {
        $('#idNewMemberChoice').addClass('hidden');
        // actionUrl = '/MIS-planner/public/membre/add';
        actionUrl = '/membre/add';
        window.location.href = actionUrl;
    });

    $('#idReintegrerMembreButton').on('click', function () {
        // actionUrl = '/MIS-planner/public/membre/addold';
        actionUrl = '/membre/addold';
        window.location.href = actionUrl;
    });

}

function confirmExpulsion(objButton) {
    let confirmAction = null;

    const idMembre = objButton.data('idmembre');

    // const actionUrl = '/MIS-planner/public/membre/del/'+idMembre; // URL à exécuter sur "Oui"
    const actionUrl = '/membre/del/'+idMembre; // URL à exécuter sur "Oui"
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