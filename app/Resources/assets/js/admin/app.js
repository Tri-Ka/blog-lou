// css

require('../../sass/admin/style.scss');

// js

var $ = require('jquery');

require('bootstrap-sass');

$(document).ready(function() {
   	$('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});
});
