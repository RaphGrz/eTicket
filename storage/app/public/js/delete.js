var current = -1;
var deleteForm = document.querySelector('#deleteForm');

function supprimer(id) {
    current = id;
}
function confirmer(url) {
    deleteForm.action = url + "/" + current;
    deleteForm.submit();
}