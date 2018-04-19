var $ = require('jquery');

require('bootstrap/dist/js/bootstrap.js');
require('select2');

import FontAwesome from './modules/FontAwesome';

$(document).ready(function() {
   	$('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    $('[data-select2]').each(function(){
    	$(this).select2({
    		tags: true
    	});
    });
});
