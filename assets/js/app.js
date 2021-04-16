import Places from 'places.js'
import Map from './modules/map'
import 'slick-carousel'
import 'slick-carousel/slick/slick.css'
import 'slick-carousel/slick/slick-theme.css'

Map.init()

let inputAddress = document.querySelector('#property_address')
if (inputAddress !== null) {
    let place = Places({
        container: inputAddress
    })
    place.on('change', e => {
        document.querySelector('#property_city').value = e.suggestion.city
        document.querySelector('#property_postal_code').value = e.suggestion.postcode
        document.querySelector('#property_lat').value = e.suggestion.latlng.lat
        document.querySelector('#property_lng').value = e.suggestion.latlng.lng
    })
}

let inputAddress2 = document.querySelector('#rent_address')
if (inputAddress2 !== null) {
    let place = Places({
        container: inputAddress2
    })
    place.on('change', e => {
        document.querySelector('#rent_city').value = e.suggestion.city
        document.querySelector('#rent_postal_code').value = e.suggestion.postcode
        document.querySelector('#rent_lat').value = e.suggestion.latlng.lat
        document.querySelector('#rent_lng').value = e.suggestion.latlng.lng
    })
}

let inputAddress3 = document.querySelector('#appartement_a_address')
if (inputAddress3 !== null) {
    let place = Places({
        container: inputAddress3
    })
    place.on('change', e => {
        document.querySelector('#appartement_a_city').value = e.suggestion.city
        document.querySelector('#appartement_a_postal_code').value = e.suggestion.postcode
        document.querySelector('#appartement_a_lat').value = e.suggestion.latlng.lat
        document.querySelector('#appartement_a_lng').value = e.suggestion.latlng.lng
    })
}

let inputAddress4 = document.querySelector('#appartement_b_address')
if (inputAddress4 !== null) {
    let place = Places({
        container: inputAddress4
    })
    place.on('change', e => {
        document.querySelector('#appartement_b_city').value = e.suggestion.city
        document.querySelector('#appartement_b_postal_code').value = e.suggestion.postcode
        document.querySelector('#appartement_b_lat').value = e.suggestion.latlng.lat
        document.querySelector('#appartement_b_lng').value = e.suggestion.latlng.lng
    })
}

let searchAddress = document.querySelector('#search_address')
if (searchAddress !== null) {
    let place = Places({
        container: searchAddress
    })
    place.on('change', e => {
        document.querySelector('#lat').value = e.suggestion.latlng.lat
        document.querySelector('#lng').value = e.suggestion.latlng.lng
    })
}

//Get the button
let mybutton = document.getElementById("back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
    ) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

let $ = require('jquery')
require('../css/app.css');
require('../css/blog.css');
require('select2');

$(document).ready(function() {
    $("#dtBox").DateTimePicker();
});

$('[data-slider]').slick({
    dots: true,
    arrows: true
})

$("[id*=blog_smallContent]").MaxLength({
    MaxLength: 135,
    DisplayCharacterCount: false
});

$('select').select2()
$('appartement_a_heat').select2()
$('appartement_b_heat').select2()
$('property_heat').select2()
$('rent_heat').select2()
let $contactButton = $('#contactButton')
$contactButton.click(e => {
    e.preventDefault();
    $('#contactForm').slideDown();
    $contactButton.slideUp();
})

let $display_date = $('#display_date');
$display_date.click(e => {
    e.preventDefault();
    $('#display-2').fadeIn();
    $('#display-1').fadeOut();
    $('#display_date').fadeOut();
    $('#display').fadeIn();
})

// Suppression des éléments
document.querySelectorAll('[data-delete]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault()
        fetch(a.getAttribute('href'), {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ '_token': a.dataset.token })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    a.parentNode.parentNode.removeChild(a.parentNode)
                } else {
                    alert(data.error)
                }
            })
            .catch(e => alert(e))
    })
})

if (localStorage.getItem("cookie-consent") === null) {
    $('#cookie').modal({ backdrop: 'static', keyboard: false, show: true });
    $("#cookieConsent").click(function() {
        localStorage.setItem("cookie-consent", "accord-ok")
        $('#cookie').modal({ backdrop: 'static', keyboard: false, show: false });
    });
}


$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');