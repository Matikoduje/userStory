document.addEventListener('DOMContentLoaded', function () {

    var adressForm = document.querySelector('#adressForm');
    var btnAdress = document.querySelector('#btnAdress');

    btnAdress.addEventListener('click', function (e) {
        if (adressForm.style.display === 'none') {
            adressForm.style.display = 'block';
        } else {
            adressForm.style.display = 'none';
        }
    })

});