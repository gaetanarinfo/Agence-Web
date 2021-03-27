/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
let $ = require('jquery');
import './styles/app.css';
import 'select2'

$('select').select2({
    theme: 'bootstrap4',
});

// start the Stimulus application
import './bootstrap';

console.log('Hello Webpack Encore! Edit me!');