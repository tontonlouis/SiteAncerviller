/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import $ from 'jquery';

import Map from './modules/map'
import Meteo from './modules/meteo'



Map.init();
Meteo.init();

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
