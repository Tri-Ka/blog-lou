window.$ = require('jquery');
window.jQuery = require('jquery');

require('jquery-ui');
global.Tether = require('tether');
require('bootstrap');

// Init elements
$(document).ready( function() {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});
});
