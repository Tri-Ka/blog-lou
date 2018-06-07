var $ = require('jquery');

var Tether = require('tether/dist/js/tether.js');
var bootstrap = require('bootstrap/dist/js/bootstrap.js');
var tinymce = require('tinymce');

import FontAwesome from './modules/FontAwesome';
import { MasonryClass } from './modules/MasonryClass';

$(document).ready(function() {
   	$('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    new MasonryClass();

    $('[data-load-later').each(function(index, element){
        $(element).attr("src", $(element).attr("data-src"));
    });

    console.log('ok');

    tinymce.init({ selector:'[data-tinymce]' });
});
