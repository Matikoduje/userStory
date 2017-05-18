document.addEventListener('DOMContentLoaded', function () {

    var adressForm = document.querySelector('#adressForm');
    var btnAdress = document.querySelector('#btnAdress');
    var emailForm = document.querySelector('#emailForm');
    var btnEmail = document.querySelector('#btnEmail');
    var phoneForm = document.querySelector('#phoneForm');
    var btnPhone = document.querySelector('#btnPhone');

    btnAdress.addEventListener('click', function (e) {
        if (adressForm.style.display === 'none') {
            adressForm.style.display = 'block';
        } else {
            adressForm.style.display = 'none';
        }
    })

    btnEmail.addEventListener('click', function (e) {
        if (emailForm.style.display === 'none') {
            emailForm.style.display = 'block';
        } else {
            emailForm.style.display = 'none';
        }
    })

    btnPhone.addEventListener('click', function (e) {
        if (phoneForm.style.display === 'none') {
            phoneForm.style.display = 'block';
        } else {
            phoneForm.style.display = 'none';
        }
    })

});